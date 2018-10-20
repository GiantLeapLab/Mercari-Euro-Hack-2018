// import * as cocoSsd from '@tensorflow-models/coco-ssd'
import { keys } from 'lodash'
import * as cocoSsd from './cocoSsd'
import Camera from './Camera'
import { fetchPost, postSubmit } from './transport'
import {
  VIDEO_PIXELS,
  STATUS_PLAYED,
  STATUS_PAUSED,
} from './constants'

//import './app.scss'

export default class App {

  modelLoaded = false

  status = STATUS_PAUSED

  camera = null

  ratio = 1

  rects = {}

  detectedItems = {}

  threshold = 50

  playPauseBtn      = document.querySelector('#play-pause-btn')
  predictionsListEl = document.querySelector('#predictions')
  emptyMessageEl    = document.querySelector('#empty')
  snapshotsEl       = document.querySelector('#snapshots')
  rectsContainerEl  = document.querySelector('#rect-container')
  submitBtn         = document.querySelector('#submit-btn')
  resultsEl         = document.querySelector('#results-list')

  constructor () {
    const videoEl = document.querySelector('#video')
    this.camera = new Camera(videoEl)
    this.snapshots = []
    this.playPauseBtn.addEventListener('click', this.toggleCameraStatus)
    this.submitBtn.addEventListener('click', this.submit)
    // this.thresholdInputEl.value = this.threshold
    // this.thresholdInputEl.addEventListener('keyup', (e) => this.threshold = parseInt(e.target.value))
  }

  init () {
    this.stopRunningStreams()
    this.emptyMessageEl.innerHTML = '<div>Loading...</div>'
    Promise.all([
      this.camera.setup().then(() => {
        this.toggleCameraStatus()
        const stl = window.getComputedStyle(this.camera.videoEl)
        const vh = parseInt(stl.height)
        const vw = parseInt(stl.width)
        this.rate = Math.min(vh, vw) / VIDEO_PIXELS
      }),
      this.loadModel(),
      ])
      .then(() => {
        this.emptyMessageEl.innerHTML = '<div>Loading complete</div>'
        this.predict()
        this.initDemandChecking()
      })
  }

  async loadModel () {
    this.model = await cocoSsd.load()
    this.modelLoaded = true
  }

  stopRunningStreams () {
    if (window.stream) {
      let trackArr = window.stream.getTracks()
      for (const track of trackArr) {
        track.stop()
      }
    }
  }

  toggleCameraStatus = () => {
    if (this.status == STATUS_PAUSED) {
      this.camera.play()
      this.status = STATUS_PLAYED
      this.playPauseBtn.innerHTML = 'Pause'
      if (this.modelLoaded) {
        this.predict()
      }
    } else {
      this.camera.pause()
      this.status = STATUS_PAUSED
      this.playPauseBtn.innerHTML = 'Play'
    }
  }

  async predict() {
    if (this.status == STATUS_PAUSED) {
      return
    }
    const predictions = await this.model.detect(this.camera.videoEl)
    this.predictionsHandler(predictions)

    requestAnimationFrame(() => this.predict())
    // setTimeout(() => this.predict(), 500)
  }

  predictionsHandler = (predictions) => {
    const needSnapshot = []
    predictions.forEach(p => {
      if (!this.detectedItems[p.class]) {
        const [x, y, width, height] = p.bbox
        this.detectedItems[p.class] = {
          checked : false,
          class : p.class,
          x, y, width, height
        }
        needSnapshot.push(p.class)
      }
    })
    if (needSnapshot.length) {
      const stl = window.getComputedStyle(this.camera.videoEl)
      const vh = parseInt(stl.height)
      const vw = parseInt(stl.width)
      const imgId = this.snapshots.push(this.camera.snapshot(vw, vh)) - 1
      // const imgId = this.snapshots.push(this.camera.snapshot()) - 1
      // this.updateSnapshotPreviews()
      needSnapshot.forEach(cls => this.detectedItems[cls].image = imgId)
    }
    this.updatePredictionsList(predictions)
    this.updateResultsList()
  }

  updatePredictionsList (predictions) {
    if (!predictions.length) {
      this.emptyMessageEl.innerHTML = '<div>Not sure what is this</div>'
    } else {
      this.emptyMessageEl.innerHTML = ''
    }

    const toDelete = []
    for (let cls in this.rects) {
      toDelete.push(cls)
    }
    predictions.map(p => {
      this.drawRect(p)
      const idx = toDelete.indexOf(p.class)
      if (idx != -1) {
        toDelete.splice(idx, 1)
      }
    })

    for (let cls of toDelete) {
      this.rectsContainerEl.removeChild(this.rects[cls])
      delete this.rects[cls]
    }
  }

  drawRect (prediction) {
    const [x, y, width, height] = prediction.bbox
    const cls = prediction.class
    const percent = Math.round(prediction.score * 1000) / 10
    // const label = `${cls} - (${percent}%)`
    const label = `${cls}`
    let rectEl = null
    if (!this.rects[cls]) {
      rectEl = document.createElement("div")

      this.rects[cls] = rectEl
      this.rectsContainerEl.appendChild(rectEl)
    } else {
      rectEl = this.rects[cls]
    }

    rectEl.style.top    = y * this.rate + 'px'
    rectEl.style.left   = x * this.rate + 'px'
    rectEl.style.height = height * this.rate + 'px'
    rectEl.style.width  = width * this.rate + 'px'
    const { checked, minCost, maxCost, people } = this.detectedItems[cls]
    const cost = maxCost ? `${minCost}-${maxCost}` : `${minCost}`
    rectEl.className = `frame ${checked ? 'checked' : 'not-checked'}`
    rectEl.innerHTML = `
      <div class="inner">
        <div class="top">
          <div class="title">${label}</div>
          ${checked && maxCost ? `<div class="cost">${cost}</div>` : ''}
          ${checked ? `<div class="people">${people}</div>` : ''}
        </div>
      </div>`
  }

  initDemandChecking () {
    this.chkDemandTimer = setInterval(() => {
      const classes = keys(this.detectedItems).filter(c => !this.detectedItems[c].checked)
      this.checkDemand(classes)
    }, 3000)
  }

  checkDemand (classes = []) {
    if (!classes.length) {
      return
    }
    fetchPost(
      '/sell/check-demand',
      'CheckDemandForm',
      { classes }
    ).then(resp => {
          if (resp.status >= 400) {
            return resp.json().then((json) => {
              console.error(resp.status, json)
            })
          }
          return resp.json()
            .then(json => {
              const classes = keys(json)
              classes.forEach(c => {
                if (!this.detectedItems[c]) {
                  return
                }
                const { minCost, maxCost, people } = json[c]
                this.detectedItems[c] = {
                  ...this.detectedItems[c],
                  ...json[c],
                  checked : true,
                }
                // this.detectedItems[c].cost = minCost != maxCost ? `${minCost}-${maxCost}` : `${minCost}`
                // this.detectedItems[c].checked = true
                // this.detectedItems[c].people = people
              })
              this.updateResultsList()
            })
        })
        .catch((err) => {
          console.error(err)
        })
  }

  updateSnapshotPreviews () {
    let imgsHtml = ''
    this.snapshots.forEach(s => {
      imgsHtml += `<img src="${s}" />`
    })
    this.snapshotsEl.innerHTML = imgsHtml
  }

  submit = () => {
    const arr = keys(this.detectedItems).map(c => {
      const {checked, minCost, maxCost, people, ...other} = this.detectedItems[c]
      return other
    })
    postSubmit('/sell/step-2', {
      SellListForm : {
        items : arr,
        images : this.snapshots,
      }
    })
  }

  updateResultsList = () => {
    let resHtml = ''
    const classes = keys(this.detectedItems).filter(c => this.detectedItems[c].checked)
    let minTotal = 0
    let maxTotal = 0
    classes.forEach(c => {
      const item = this.detectedItems[c]
      const { minCost, maxCost, people } = item
      const cost = maxCost != minCost ? `$${minCost}-${maxCost}` : `$${minCost}`
      minTotal += parseFloat(minCost) || 0
      maxTotal += parseFloat(maxCost) || 0
      resHtml += `<div class="result">
        <div class="data">
          <div class="title">${item.class}</div>
          ${`<div class="cost">${maxCost ? cost : ''}</div>`}
          <div class="buyers">${parseInt(people) ? `${people} people coud buy it` : `no one is looking for it right now`}</div>
        </div>
      </div>`
    })
    if (classes.length && maxTotal) {
      const total = maxTotal == minTotal ? maxTotal : `${minTotal}-${maxTotal}`
      resHtml += `<div class="result result-full">
        <div class="data">
          You could earn:
          <div class="cost">$${total}</div>
        </div>
      </div>`
    }

    this.resultsEl.innerHTML = resHtml

  }
}

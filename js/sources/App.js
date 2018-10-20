// import * as cocoSsd from '@tensorflow-models/coco-ssd'
import { keys } from 'lodash'
import * as cocoSsd from './cocoSsd'
import Camera from './Camera'
import { fetchPost } from './transport'
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
  // thresholdInputEl  = document.querySelector('#threshold')
  rectsContainerEl  = document.querySelector('#rect-container')

  constructor () {
    const videoEl = document.querySelector('#video')
    this.camera = new Camera(videoEl)
    this.playPauseBtn.addEventListener('click', this.toggleCameraStatus)
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
    predictions.forEach(p => {
      if (!this.detectedItems[p.class]) {
        this.detectedItems[p.class] = {
          checked : false,
        }
      }
    })
    this.updatePredictionsList(predictions)
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
    const [x, y, height, width] = prediction.bbox
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
    rectEl.style.height = width * this.rate + 'px'
    rectEl.style.width  = height * this.rate + 'px'
    if (this.detectedItems[cls].checked) {
      const { cost, people } = this.detectedItems[cls]
      rectEl.className = 'frame checked'
      rectEl.innerHTML = `
        <div class="inner">
          <div class="top">
            <div class="title">${label}</div>
            <div class="cost">${cost}</div>
            <div class="people">${people}</div>
          </div>
        </div>`
    } else {
      rectEl.className = 'frame not-checked'
      rectEl.innerHTML = `<div class="inner">
        <div class="top">
          <div class="title">${label}</div>
        </div>
      </div>`
    }
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
                  checked : true,
                  cost : minCost != maxCost ? `${minCost}-${maxCost}` : `${minCost}`,
                  people
                }
              })
            })
        })
        .catch((err) => {
          console.log(err)
          console.error(err)
        })
  }
}

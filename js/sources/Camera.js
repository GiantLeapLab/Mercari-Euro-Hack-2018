import {
  VIDEO_PIXELS
} from './constants'

export default class Camera {

  videoEl = null

  constructor (videoEl) {
    this.videoEl = videoEl
    this.canvasEl = document.createElement('canvas')
  }

  async setup () {
    const { mediaDevices } = navigator
    if (mediaDevices && mediaDevices.getUserMedia) {
      const stream = await navigator.mediaDevices.getUserMedia({
        'audio': false,
        'video': {facingMode: 'environment'}
      })

      window.stream = stream
      this.videoEl.srcObject = stream

      return new Promise(resolve => {
        this.videoEl.onloadedmetadata = () => {
          const w = this.videoEl.videoWidth
          const h = this.videoEl.videoHeight
          const ratio = w / h
          this.videoEl.height = (w >= h) ? VIDEO_PIXELS : VIDEO_PIXELS / ratio
          this.videoEl.width = (w >= h) ? ratio * VIDEO_PIXELS : VIDEO_PIXELS
          resolve()
        }
      })
    }

    return null;
  }

  pause () {
    this.videoEl.pause();
  }

  play () {
    this.videoEl.play();
  }

  snapshot (width, height) {
    width = width || this.videoEl.width
    height = height || this.videoEl.height
    // const { width, height } = this.videoEl
    this.canvasEl.height = height
    this.canvasEl.width = width
    let ctx = this.canvasEl.getContext('2d')
    ctx.drawImage(this.videoEl, 0, 0, width, height)
    // let img = new Image()
    // img.src = this.canvasEl.toDataURL('image/png').replace('image/png', 'image/octet-stream')
    // return img
    return this.canvasEl.toDataURL('image/png').replace('image/png', 'image/octet-stream')
  }
}

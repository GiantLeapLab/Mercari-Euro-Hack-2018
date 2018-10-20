import {
  VIDEO_PIXELS
} from './constants'

export default class Camera {

  videoEl = null

  constructor (videoEl) {
    this.videoEl = videoEl
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

}

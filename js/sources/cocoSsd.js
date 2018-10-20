import * as tf from '@tensorflow/tfjs'
import { OBJECT_CLASSES } from './constants'

const BASE_PATH = '/web/js/mobilenet_models';

export async function load() {
  if (tf == null) {
    throw new Error(
        `Cannot find TensorFlow.js. If you are using a <script> tag, please ` +
        `also include @tensorflow/tfjs on the page before using this model.`);
  }

  const objectDetection = new ObjectDetection();
  await objectDetection.load();
  return objectDetection;
}

export class ObjectDetection {

  constructor() {
    this.modelPath = `${BASE_PATH}/tensorflowjs_model.pb`
    this.weightPath = `${BASE_PATH}/weights_manifest.json`
  }

  async load() {
    this.model = await tf.loadFrozenModel(this.modelPath, this.weightPath)

    // Warmup the model.
    const result = await this.model.executeAsync(tf.zeros([1, 300, 300, 3]))
    result.map(async (t) => await t.data())
    result.map(async (t) => t.dispose())
  }

  /**
   * Infers through the model.
   *
   * @param img The image to classify. Can be a tensor or a DOM element image,
   * video, or canvas.
   * @param maxNumBoxes The maximum number of bounding boxes of detected
   * objects. There can be multiple objects of the same class, but at different
   * locations. Defaults to 20.
   */
  async infer(img, maxNumBoxes) {
    const batched = tf.tidy(() => {
      if (!(img instanceof tf.Tensor)) {
        img = tf.fromPixels(img)
      }
      // Reshape to a single-element batch so we can pass it to executeAsync.
      return img.expandDims(0);
    });
    const height = batched.shape[1];
    const width = batched.shape[2];

    // model returns two tensors:
    // 1. box classification score with shape of [1, 1917, 90]
    // 2. box location with shape of [1, 1917, 1, 4]
    // where 1917 is the number of box detectors, 90 is the number of classes.
    // and 4 is the four coordinates of the box.
    const result = await this.model.executeAsync(batched);

    const scores = result[0].dataSync();
    const boxes = result[1].dataSync();

    // clean the webgl tensors
    batched.dispose();
    tf.dispose(result);

    const [maxScores, classes] =
        this.calculateMaxScores(scores, result[0].shape[1], result[0].shape[2]);

    const prevBackend = tf.getBackend();
    // run post process in cpu
    tf.setBackend('cpu');
    const indexTensor = tf.tidy(() => {
      const boxes2 =
          tf.tensor2d(boxes, [result[1].shape[1], result[1].shape[3]]);
      return tf.image.nonMaxSuppression(
          boxes2, maxScores, maxNumBoxes, 0.5, 0.5);
    });

    const indexes = indexTensor.dataSync();
    indexTensor.dispose();

    // restore previous backend
    tf.setBackend(prevBackend);

    return this.buildDetectedObjects(
        width, height, boxes, maxScores, indexes, classes);
  }

  buildDetectedObjects(width, height, boxes, scores, indexes, classes) {
    const count = indexes.length;
    const objects = [];
    for (let i = 0; i < count; i++) {
      const bbox = [];
      for (let j = 0; j < 4; j++) {
        bbox[j] = boxes[indexes[i] * 4 + j];
      }
      const minY = bbox[0] * height;
      const minX = bbox[1] * width;
      const maxY = bbox[2] * height;
      const maxX = bbox[3] * width;
      bbox[0] = minX;
      bbox[1] = minY;
      bbox[2] = maxX - minX;
      bbox[3] = maxY - minY;
      objects.push({
        bbox: bbox,
        class: OBJECT_CLASSES[classes[indexes[i]] + 1].displayName,
        score: scores[indexes[i]]
      });
    }
    return objects;
  }

  calculateMaxScores(scores, numBoxes, numClasses) {
    const maxes = [];
    const classes = [];
    for (let i = 0; i < numBoxes; i++) {
      let max = Number.MIN_VALUE;
      let index = -1;
      for (let j = 0; j < numClasses; j++) {
        if (scores[i * numClasses + j] > max) {
          max = scores[i * numClasses + j];
          index = j;
        }
      }
      maxes[i] = max;
      classes[i] = index;
    }
    return [maxes, classes];
  }

  /**
   * Detect objects for an image returning a list of bounding boxes with
   * assocated class and score.
   *
   * @param img The image to detect objects from. Can be a tensor or a DOM
   *     element image, video, or canvas.
   * @param maxNumBoxes The maximum number of bounding boxes of detected
   * objects. There can be multiple objects of the same class, but at different
   * locations. Defaults to 20.
   *
   */
  async detect(img, maxNumBoxes = 20) {
    return this.infer(img, maxNumBoxes);
  }

  /**
   * Dispose the tensors allocated by the model. You should call this when you
   * are done with the model.
   */
  dispose() {
    if (this.model) {
      this.model.dispose();
    }
  }
}

<?php
/**
 * @var $this \yii\web\View
 * @var $models \app\models\SellRequest[]
 * @var $prices array
 */

use app\assets\AppThemeAsset;
use kartik\slider\Slider;
use yii\widgets\ActiveForm;

AppThemeAsset::register($this);

$form = ActiveForm::begin();

foreach ($models as $index => $model) {
    echo $form->field($model,  '[' . $index . ']title', [
        'options' => ['class' => 'form-group col-md-6 required '],
        'inputOptions' => ['class' => 'block']
    ]);
    echo $form->field($model, '[' . $index . ']sell')->checkbox();

    echo $form->field($model,  '[' . $index . ']description', [
        'options' => ['class' => 'form-group col-md-6 required '],
        'inputOptions' => ['class' => 'block']
    ]);
    echo "<img src='" . $model->imageName . "' />";

    $maxPrice = $prices[$model->title]['maxCost'] ? (int)($prices[$model->title]['maxCost'] * 1.3) : 300;
    $minPrice = $prices[$model->title]['minCost'] ? (int)($prices[$model->title]['minCost'] * 2 / 3) : 0;
    echo '<b class="badge">' . $minPrice . '</b> ' . Slider::widget([
            'name' => 'price',
            'sliderColor' => '#dce1e9',
            'handleColor' => '#879cbe',
            'pluginOptions' => [
                'orientation' => 'horizontal',
                'handle' => 'round',
                'min' => $minPrice,
                'max' => $maxPrice,
                'step' => 1
            ],
        ]) . ' <b class="badge">' . $maxPrice . '</b>';
}

ActiveForm::end();

?>

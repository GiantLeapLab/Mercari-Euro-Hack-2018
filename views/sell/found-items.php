<?php
/**
 * @var $this \yii\web\View
 * @var $models \app\models\SellRequest[]
 */

use yii\widgets\ActiveForm;

$form = ActiveForm::begin();

foreach ($models as $index => $model) {
    $form->field($model, '[' . $index . ']title')->textInput();
    $form->field($model, '[' . $index . ']description')->textInput();
    $form->field($model, '[' . $index . ']imageName')->hiddenInput();
}

ActiveForm::end();

?>

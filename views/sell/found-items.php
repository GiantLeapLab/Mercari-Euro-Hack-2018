<?php
/**
 * @var $this \yii\web\View
 * @var $models \app\models\SellRequest[]
 */

use yii\widgets\ActiveForm;

$form = ActiveForm::begin();

foreach ($models as $index => $model) {
    echo $form->field($model, '[' . $index . ']title')->textInput();
    echo $form->field($model, '[' . $index . ']description')->textInput();
    echo $form->field($model, '[' . $index . ']imageName')->textInput();
    echo "<img src='" . $model->imageName . "' />";
}

ActiveForm::end();

?>

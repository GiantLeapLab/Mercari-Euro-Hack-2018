<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\BuyRequest */

/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="buy-request-form">-->

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'user_id')->textInput() ?>

<div class="row">
<?= $form->field($model, 'title', [
    'options' => ['class' => 'form-group col-md-6 required '],
    'inputOptions' => ['class' => 'block']
])->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'category_id', ['options' => ['class' => 'form-group col-md-6 required ']])->dropDownList($categories) ?>
</div>

<div class="row">
    <?= $form->field($model, 'imageFile', [
        'options' => ['class'=>'form-group col-md-4'],
        'labelOptions' => ['class' => 'block'],
        'template' => "{label}\n{input}\n<span class=\"file-block\"></span>",
    ])->fileInput() ?>
    <div class="col-md-8 content">
        <a href="#" class="label block popup-toggle carousel-label" id="popup-opener">Choose the 'laptop' products you like <br>from our library</a>
        <div class="carousel owl-carousel">
            <div class="item"><img src="/../img/carousel-img.png" alt="product"></div>
            <div class="item"><img src="/../img/carousel-img.png" alt="product"></div>
            <div class="item"><img src="/../img/carousel-img.png" alt="product"></div>
            <div class="item"><img src="/../img/carousel-img.png" alt="product"></div>
            <div class="item"><img src="/../img/carousel-img.png" alt="product"></div>
            <div class="item"><img src="/../img/carousel-img.png" alt="product"></div>
            <div class="item"><img src="/../img/carousel-img.png" alt="product"></div>
        </div>
    </div>
</div>

<div class="row price-row">
    <div class="col-12">
        <div class="label price-row-label">Price you are ready to pay</div>
    </div>
    <?= $form->field($model, 'min_price', [
        'options' => ['class' => 'col-auto'],
        'template' => "{label}\n{input}\n{hint}\n{error}",
        'labelOptions' => [ 'class' => 'inline' ],
        'inputOptions' => [ 'class' => '' ]
    ])->textInput() ?>
<?= $form->field($model, 'max_price', [
        'options' => ['class' => 'col-auto'],
        'template' => "{label}\n{input}\n{hint}\n{error}",
        'labelOptions' => [ 'class' => 'inline' ],
        'inputOptions' => [ 'class' => '' ]
])->textInput() ?>
</div>

<div class="row">
    <?= $form->field($model, 'description', [
        'options' => ['class' => 'col '],
        'template' => "{label}\n{input}\n{hint}\n{error}",
        'labelOptions' => [ 'class' => 'block' ],
        'inputOptions' => [ 'class' => '' ]

    ])->textarea(['maxlength' => true]) ?>
</div>


    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<!--</div>-->

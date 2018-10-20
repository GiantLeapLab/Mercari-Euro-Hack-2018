<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\BuyRequest */

/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="buy-request-form">-->

    <?php $form = ActiveForm::begin(); ?>



<div class="row">
<?= $form->field($model, 'title', [
    'options' => ['class' => 'form-group col-md-6 required '],
    'inputOptions' => ['class' => 'block']
])->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'category_id', [
        'options' => ['class' => 'form-group col-md-6 required ']
])->dropDownList($categories, ['class' => 'block']) ?>
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
<div class="popup">

    <div class="inner">
        <h2>Show sellers what you like</h2>


        <!--<form action="">-->

        <div class="products--container" data-mcs-theme="dark">
            <div class="container">
                <div class="row products">
                    <label for="product-01" class="col-md-4--theme">
                        <input type="checkbox" name="product-01" id="product-01">
                        <span class="like"></span>
                        <img src="/../img/carousel-img.png" alt="product">
                    </label>
                    <label for="product-02" class="col-md-4--theme">
                        <input type="checkbox" name="product-02" id="product-02">
                        <span class="like"></span>
                        <img src="/../img/carousel-img.png" alt="product">
                    </label>
                    <label for="product-03" class="col-md-4--theme">
                        <input type="checkbox" name="product-03" id="product-03">
                        <span class="like"></span>
                        <img src="/../img/carousel-img.png" alt="product">
                    </label>
                    <label for="product-04" class="col-md-4--theme">
                        <input type="checkbox" name="product-04" id="product-04">
                        <span class="like"></span>
                        <img src="/../img/carousel-img.png" alt="product">
                    </label>
                    <label for="product-05" class="col-md-4--theme">
                        <input type="checkbox" name="product-05" id="product-05">
                        <span class="like"></span>
                        <img src="/../img/carousel-img.png" alt="product">
                    </label>
                    <label for="product-06" class="col-md-4--theme">
                        <input type="checkbox" name="product-06" id="product-06">
                        <span class="like"></span>
                        <img src="/../img/carousel-img.png" alt="product">
                    </label>

                </div>
            </div>
        </div>

        <div class="btn-row">
            <button class="btn popup-toggle" id="popup-closer">Done</button>
        </div>
        <!--</form>-->

    </div>

</div>
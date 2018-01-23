<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductDiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-discount-form">

    <?php $form = ActiveForm::begin(); ?>
    <!-- <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-6">           
                <?php// $form->field($model, 'STORE_ID')->textInput(['maxlength' => true,'readOnly'=> true]) ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-6">

                <?php// $form->field($model, 'PRODUCT_ID')->textInput(['maxlength' => true,'readOnly'=> true]) ?>
            </div>
    </div>
    <hr> -->
    <?php
        echo '<label class="control-label">Periode Tanggal</label>';
       echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'PERIODE_TGL1',
            'attribute2' => 'PERIODE_TGL2',
            'options' => ['placeholder' => 'Start date'],
            'options2' => ['placeholder' => 'End date'],
            'type' => DatePicker::TYPE_RANGE,
            'form' => $form,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
                "startDate" => $model->PERIODE_TGL1,
            ]
        ]);
    ?>

    <?= $form->field($model, 'DISCOUNT')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

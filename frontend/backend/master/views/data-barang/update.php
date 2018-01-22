<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Store;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-fdiscount-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-xs-12 col-sm-6 col-lg-6">
    <?= $form->field($model, 'STORE_ID')->widget(Select2::classname(),[
       'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
        'options' => ['placeholder'=>'Select Category....'],
        'pluginOptions' => [
            'allowClear' => true
        ], 
    ])?>
    <?= $form->field($model, 'PRODUCT_QR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_NM')->textInput() ?>

    <?= $form->field($model, 'PRODUCT_SIZE')->textInput() ?>

    </div>
    <div class="col-xs-12 col-sm-6 col-lg-6">
    <?= $form->field($model, 'PRODUCT_SIZE_UNIT')->textInput() ?>

    <?= $form->field($model, 'PRODUCT_HEADLINE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CURRENT_STOCK')->textInput() ?>

    <?= $form->field($model, 'CURRENT_PRICE')->widget(MaskMoney::classname(), [
                            'options' => ['placeholder' => 'Harga Barang ...'],
                            'pluginOptions'=>[
                                'prefix'=>'Rp',
                            ],
                        ]) ?>

    </div>
  </div>
   
    
    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\backend\master\models\StoreKasir;
use frontend\backend\master\models\StoreKasirSearch;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\StoreKasir */
/* @var $form yii\widgets\ActiveForm */
$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
 
?>

<div class="store-kasir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PERANGKAT_UUID')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'KASIR_ID')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(StoreKasir::find()->all(),'KASIR_ID','KASIR_NM'),
            'language' => 'de',
            'disabled'=>true,
            'options' => ['placeholder' => 'Select a state ...','id'=>'province-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <div class="col-md-12"><p style="text-align:center"><label >KE</label><p></div>

    <?= $form->field($model, 'KASIR')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(StoreKasir::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1,'PERANGKAT_UUID'=>null])->all(),'KASIR_ID','KASIR_NM'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
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

    <?= $form->field($model, 'PERANGKAT_UUID',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >UUID </span>',
						'options'=>['style' =>' background-color: lightblue;width:100px;text-align:right']
					]
				]
				])->textInput(['readonly'=>true])->label(false) ?>

    <?= $form->field($model, 'KASIR_ID',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >KASIR AWAL </span>',
						'options'=>['style' =>' background-color: lightblue;width:100px;text-align:right']
					]
				]
				])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(StoreKasir::find()->all(),'KASIR_ID','KASIR_NM'),
            'language' => 'de',
            'disabled'=>true,
            'options' => ['placeholder' => 'Select a state ...','id'=>'province-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); ?>
    <div class="col-md-12"><p style="text-align:center"><label >KE</label><p></div>

    <?= $form->field($model, 'KASIR',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >KASIR </span>',
						'options'=>['style' =>' background-color: lightblue;width:100px;text-align:right']
					]
				]
				])->widget(Select2::classname(), [
        'data' => ArrayHelper::map(StoreKasir::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1,'PERANGKAT_UUID'=>null])->all(),'KASIR_ID','KASIR_NM'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false); ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

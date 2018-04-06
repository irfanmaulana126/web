<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Store;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STORE_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>STORE</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 120px;']
						]
					]
				])->widget(Select2::classname(),[
        'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>1])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
        'options' => ['placeholder'=>'Select Category....'],
        'pluginOptions' => [
            'allowClear' => true
        ], 
    ])->label(false)?>

    <?= $form->field($model, 'GROUP_NM',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>NAMA GROUP</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right']
						]
					]
				])->textInput(['maxlength' => true,'style'=>'text-transform:uppercase'])->label(false) ?>

    <?= $form->field($model, 'NOTE')->textarea(['rows' => 6]) ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

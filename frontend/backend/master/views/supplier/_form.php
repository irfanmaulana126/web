<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'SUPPLIER_NM',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >SUPPLIER</span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->textInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'PIC',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >PIC</span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->textInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'EMAIL',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >EMAIL</span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->widget(MaskedInput::classname(),['clientOptions' => [
        'alias' =>  'email'
    ]])->label(false) ?>

    <?= $form->field($model, 'NO_TLP',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >NO_TLP</span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->widget(MaskedInput::classname(),
                ['mask' => '(021) 9999999'])->label(false) ?>

    <?= $form->field($model, 'PHONE',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >PHONE</span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->widget(MaskedInput::classname(),
        ['mask' => '(999) 9999999'])->label('Phone')->label(false) ?>

    <?= $form->field($model, 'ALAMAT',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >ALAMAT</span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->textInput(['maxlength' => true])->label(false) ?>
    
    <?= $form->field($model, 'DCRP_DETIL')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

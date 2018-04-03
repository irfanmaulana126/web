<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Store;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STORE_ID',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >STORE </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->widget(Select2::classname(),[
       'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
        'options' => ['placeholder'=>'Select Category....'],
        'pluginOptions' => [
            'allowClear' => true
        ], 
    ])->label(false) ?>
    
    <?= $form->field($model, 'KTP',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >KTP </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->textInput()->label(false); ?>
            <?= $form->field($model, 'NAMA_DPN',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >DEPAN </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->textInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'NAMA_TGH',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >TENGAH </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->textInput()->label(false) ?>
            <?= $form->field($model, 'NAMA_BLK',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >BELAKANG </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;']
					]
				]])->textInput(['maxlength' => true])->label(false) ?>
            
    <?= $form->field($model, 'ALAMAT',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >ALAMAT </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->textInput()->label(false) ?>

    <?= $form->field($model, 'TMP_LAHIR',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >TMP LAHIR </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->textInput()->label(false) ?>

    <?= $form->field($model, 'TGL_LAHIR',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >TGL LAHIR </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->widget(DatePicker::classname(), [
							'options' => ['placeholder' => 'Enter date ...'],
							'convertFormat' => true,
							'pluginOptions' => [
								'autoclose'=>true,
								// 'todayHighlight' => true,
								 'format' => 'yyyy-MM-dd'
							],
						])->label(false);	 ?>
    
    <?= $form->field($model, 'GENDER',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >GENDER </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->dropDownList(['Laki Laki'=>'Laki-Laki','Prempuan'=>'Prempuan'],['prompt'=>'Select Option','style'=>'width: 170px;'])->label(false) ?>

    <?= $form->field($model, 'STS_NIKAH',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >STS NIKAH </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->dropDownList(['Belum Menikah' => 'Belum Menikah', 'Menikah' => 'Menikah'],['prompt'=>'Select Option','style'=>'width: 170px;'])->label(false) ?>

    <?= $form->field($model, 'TLP',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >TLP </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->widget(MaskedInput::classname(),[
                            'mask' => '9',
                            'clientOptions' => ['repeat' => 12, 'greedy' => false]])->label(false) ?>

    <?= $form->field($model, 'HP',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >HP </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->widget(MaskedInput::classname(),[
    'mask' => '(999) 999-9999'])->label(false) ?>
    
    <?= $form->field($model, 'EMAIL',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >EMAIL </span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:98px']
					]
				]])->widget(MaskedInput::classname(),['clientOptions' => [
        'alias' =>  'email'
    ]])->label(false) ?>
   
    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

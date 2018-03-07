<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Store;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STORE_ID')->widget(Select2::classname(),[
       'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
        'options' => ['placeholder'=>'Select Category....'],
        'pluginOptions' => [
            'allowClear' => true
        ], 
    ]) ?>
    
    <?= $form->field($model, 'KTP')->textInput() ?>
            <div class="row">
            <div class="col-md-4">
            <?= $form->field($model, 'NAMA_DPN')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
            <?= $form->field($model, 'NAMA_TGH')->textInput() ?>
            </div>
            <div class="col-md-4">
            <?= $form->field($model, 'NAMA_BLK')->textInput(['maxlength' => true]) ?>
            </div>
            </div>
            
    <?= $form->field($model, 'ALAMAT')->textInput() ?>

    <?= $form->field($model, 'TMP_LAHIR')->textInput() ?>

    <?= $form->field($model, 'TGL_LAHIR')->widget(DatePicker::classname(), [
							'options' => ['placeholder' => 'Enter date ...'],
							'convertFormat' => true,
							'pluginOptions' => [
								'autoclose'=>true,
								// 'todayHighlight' => true,
								 'format' => 'yyyy-MM-dd'
							],
						]);	 ?>
    
    <?= $form->field($model, 'GENDER')->dropDownList(['Laki Laki'=>'Laki-Laki','Prempuan'=>'Prempuan'],['prompt'=>'Select Option']) ?>

    <?= $form->field($model, 'STS_NIKAH')->dropDownList(['Belum Menikah' => 'Belum Menikah', 'Menikah' => 'Menikah'],['prompt'=>'Select Option']) ?>

    <?= $form->field($model, 'TLP')->widget(MaskedInput::classname(),[
                            'mask' => '9',
                            'clientOptions' => ['repeat' => 12, 'greedy' => false]]) ?>

    <?= $form->field($model, 'HP')->widget(MaskedInput::classname(),[
    'mask' => '(999) 999-9999']) ?>
    
    <?= $form->field($model, 'EMAIL')->widget(MaskedInput::classname(),['clientOptions' => [
        'alias' =>  'email'
    ]]) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Store;
use yii\widgets\MaskedInput;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-update">
<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'NM_DEPAN')->textInput(['maxlength' => true])->label('Nama Depan') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'NM_TENGAH')->textInput(['maxlength' => true])->label('Nama Tengah') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'NM_BELAKANG')->textInput(['maxlength' => true])->label('Nama Belakang') ?>       
        </div>
    </div>
        
    <?= $form->field($model, 'KTP')->textInput(['maxlength' => true])->label('KTP') ?>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'LAHIR_TEMPAT')->textInput(['maxlength' => true])->label('Tempat Lahir') ?>
    </div>
        <div class="col-md-6">
    <?= $form->field($model, 'LAHIR_TGL')->widget(DatePicker::classname(), [
							'options' => ['placeholder' => 'Enter date ...'],
							'convertFormat' => true,
							'pluginOptions' => [
								'autoclose'=>true,
								// 'todayHighlight' => true,
								 'format' => 'yyyy-MM-dd'
							],
						])->label('Tanggal Lahir') ?>
 </div>
    </div>
    
    <?= $form->field($model, 'LAHIR_GENDER')->dropDownList(['1'=>'Laki-Laki','2'=>'Prempuan'],['prompt'=>'Select Option'])->label('Jenis Kelamin') ?>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'HP')->widget(MaskedInput::classname(),[
    'mask' => '(999) 999-9999'])->label('Telepon') ?>
 </div>
        <div class="col-md-6">
    <?= $form->field($model, 'EMAIL')->widget(MaskedInput::classname(),['clientOptions' => [
        'alias' =>  'email'
    ]])->label('Email') ?>
</div>
    </div>
    <?= $form->field($model, 'ALMAT')->textarea(['rows' => 2])->label('Alamat') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>

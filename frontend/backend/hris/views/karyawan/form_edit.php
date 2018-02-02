<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Store;
use yii\widgets\MaskedInput;

?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'STORE_ID')->widget(Select2::classname(),[
       'data'=>ArrayHelper::map(Store::find()->all(),'STORE_ID','STORE_NM'),'language' => 'en',
        'options' => ['placeholder'=>'Select STORE....'],
        'pluginOptions' => [
            'allowClear' => true
        ], 
    ]) ?>

    <?= $form->field($model, 'NAMA_DPN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAMA_TGH')->textInput() ?>

    <?= $form->field($model, 'NAMA_BLK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TLP')->widget(MaskedInput::classname(),[
                            'mask' => '9',
                            'clientOptions' => ['repeat' => 12, 'greedy' => false]]) ?>

    <?= $form->field($model, 'HP')->widget(MaskedInput::classname(),[
    'mask' => '(999) 999-9999']) ?>
    
    <?= $form->field($model, 'EMAIL')->widget(MaskedInput::classname(),['clientOptions' => [
        'alias' =>  'email'
    ]]) ?>

    <?= $form->field($model, 'GENDER')->dropDownList(['Laki Laki'=>'Laki-Laki','Perempuan'=>'Perempuan']) ?>
   
    <?= $form->field($model, 'STATUS')->dropDownList(['1'=>'Aktif','3'=>'Keluar']) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

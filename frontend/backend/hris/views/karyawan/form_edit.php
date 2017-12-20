<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Store;

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

    <?= $form->field($model, 'TLP')->textInput() ?>

    <?= $form->field($model, 'GENDER')->dropDownList(['Laki Laki'=>'Laki-Laki','Perempuan'=>'Perempuan']) ?>
   
    <?= $form->field($model, 'STATUS')->dropDownList(['1'=>'Aktif','3'=>'Keluar']) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

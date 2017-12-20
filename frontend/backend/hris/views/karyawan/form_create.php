<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Store;
use kartik\widgets\DatePicker;
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STORE_ID')->widget(Select2::classname(),[
       'data'=>ArrayHelper::map(Store::find()->all(),'STORE_ID','STORE_NM'),'language' => 'en',
        'options' => ['placeholder'=>'Select Category....'],
        'pluginOptions' => [
            'allowClear' => true
        ], 
    ]) ?>
    
    <?= $form->field($model, 'KTP')->textInput() ?>

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
    
    <?= $form->field($model, 'NAMA_DPN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAMA_TGH')->textInput() ?>

    <?= $form->field($model, 'NAMA_BLK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TLP')->textInput() ?>

    <?= $form->field($model, 'GENDER')->dropDownList(['Laki Laki'=>'Laki-Laki','Prempuan'=>'Prempuan']) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

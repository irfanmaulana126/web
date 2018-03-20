<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use frontend\backend\sistem\models\Bank;
use yii\widgets\MaskedInput;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\DompetRekening */
/* @var $form yii\widgets\ActiveForm */

$data=unserialize($modelImage->IMAGE);
foreach ($data as $key) {
    if (!empty($key)) {
        $datas[]='<img src="'.$key.'" alt="Your Avatar" style="width:160px;align:center">';
	} else {
        $datas='<img src="https://www.mautic.org/media/images/default_avatar.png" alt="Your Avatar" style="width:160px;align:center">';
	}	
}

?>

<div class="dompet-rekening-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAMA_LENGKAP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BANK')->textInput(['maxlength' => true])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Bank::find()->all(),'BANK_NM','BANK_NM'),
            'language' => 'EN',
            'options' => ['placeholder' => 'Select a Bank ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <?= $form->field($model, 'NO_REK')->textInput(['type' => 'number']) ?>


    <?= $form->field($model, 'TLP')->widget(MaskedInput::classname(),[
        'mask' => '9',
        'clientOptions' => ['repeat' => 12, 'greedy' => false]]) ?>

    <?= $form->field($modelImage, 'IMAGE[]')->widget(FileInput::classname(), [
        'options' => [
                'accept' => 'image/*',
                'multiple' => true,
                'maxFile'=>5],
        'pluginOptions' => [
            'initialPreview'=>$datas,
        'overwriteInitial'=>false,
        'maxFileSize'=>2800
        ],        
    ]); ?>

    <?= $form->field($model, 'ALAMAT')->textarea(['rows' => 6]) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

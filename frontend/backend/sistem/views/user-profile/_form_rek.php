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
// print_r(!empty($modelImage));die();
if(!empty($modelImage->IMAGE)){
    $data=unserialize($modelImage->IMAGE);
    foreach ($data as $key) {
            $datas[]='<img src="'.$key.'" alt="Your Avatar" style="width:160px;align:center">';
        }
}else{
    $datas='';
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

    <?= $form->field($model, 'ALAMAT')->textarea(['rows' => 4]) ?>

    <?= $form->field($modelImage, 'IMAGE[]')->widget(FileInput::classname(), [
        'options'=>[
                'width'=>'100px',
                'accept'=>'image/*',
                'multiple'=>true
            ],				
        'pluginOptions'=>[
            'allowedFileExtensions'=>['jpg','gif','png'],					
            'showCaption' => false,
            'showRemove' => true,
            'showUpload' => false,
            'showClose' =>false,
            'showDrag' =>false,
            'browseLabel' => 'Select Photo',
            'removeLabel' => '',
            'removeIcon'=> '<i class="glyphicon glyphicon-remove"></i>',
            'removeTitle'=> 'Clear Selected File',
            'defaultPreviewContent' => $datas,
            'maxFileSize'=>800 //10KB
            
        ],
        'pluginEvents' => [
            'fileclear' => 'function() { log("fileclear"); }',
            'filereset' => 'function() { log("filereset"); }',
        ]        
    ]); ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

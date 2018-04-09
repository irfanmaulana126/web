<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
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
$warnaLabel='rgba(21, 175, 213, 0.14)';
$widthLabel='125px';
?>

<div class="dompet-rekening-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAMA_LENGKAP',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>NAMA</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->textInput(['maxlength' => true,'style'=>'width: 445px;'])->label(false); ?>

    <?= $form->field($model, 'BANK',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>BANK</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->textInput(['maxlength' => true])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Bank::find()->all(),'BANK_NM','BANK_NM'),
            'language' => 'EN',
            'options' => ['placeholder' => 'Select a Bank ...','style'=>'width: 445px;'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); ?>

    <?= $form->field($model, 'NO_REK',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>NO REK</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->textInput(['type' => 'number','style'=>'width: 445px;'])->label(false); ?>


    <?= $form->field($model, 'TLP',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>TLP</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->widget(MaskedInput::classname(),[
        'mask' => '9',
        'options'=>['class'=>'form-control','style'=>'width: 445px;'],
        'clientOptions' => ['repeat' => 12, 'greedy' => false]])->label(false); ?>

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
	
	<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

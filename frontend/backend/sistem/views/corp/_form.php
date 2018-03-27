<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
$data=$image->CORP_64;
	if (!empty($data)) {
		$datas='<img src="'.$image->CORP_64.'" alt="Your Avatar" style="width:160px;align:center">';
	} else {
		$datas='<img src="https://www.mautic.org/media/images/default_avatar.png" alt="Your Avatar" style="width:160px;align:center">';
	}
/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobHeader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="corp-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'CORP_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MAP_LAG')->textInput() ?>

    <?= $form->field($model, 'MAP_LAT')->textInput() ?>

    <?= $form->field($model, 'ALAMAT')->textInput(['maxlength' => true]) ?>
    
    <?=  $form->field($image, 'CORP_64')->widget(FileInput::classname(), [
				'name'=>'item-input-file',
				'options'=>[
					'width'=>'100px',
					'accept'=>'image/*',
					'multiple'=>false
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
					'maxFileSize'=>30 //10KB
					
				],
				'pluginEvents' => [
					'fileclear' => 'function() { log("fileclear"); }',
					'filereset' => 'function() { log("filereset"); }',
				]
			]) ; 
			?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

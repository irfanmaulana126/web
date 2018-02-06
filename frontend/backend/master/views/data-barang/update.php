<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Store;
use kartik\widgets\FileInput;
use frontend\backend\master\models\Industry;
use frontend\backend\master\models\IndustryGroup;
use frontend\backend\master\models\ProductGroup;
use frontend\backend\master\models\ProductUnit;
use frontend\backend\master\models\ProductUnitGroup;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
use kartik\widgets\ColorInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
$data=$image->PRODUCT_IMAGE;
	if (!empty($data)) {
		$datas='<img src="'.$image->PRODUCT_IMAGE.'" alt="Your Avatar" style="width:160px;align:center">';
	} else {
		$datas='<img src="https://www.mautic.org/media/images/default_avatar.png" alt="Your Avatar" style="width:160px;align:center">';
	}	

?>

<div class="item-fdiscount-form">

<?php $form = ActiveForm::begin([
	'options'=>['enctype'=>'multipart/form-data'],
	]); ?>	
			
			<?= $form->field($model, 'PRODUCT_NM')->textInput() ?>

			<?= $form->field($model, 'PRODUCT_QR')->textInput() ?>
			
			<?= $form->field($model, 'GROUP_ID')->widget(Select2::classname(), [
					'data' => ArrayHelper::map(ProductGroup::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>1])->all(),'GROUP_ID','GROUP_NM'),
					'language' => 'de',
					'options' => ['placeholder' => 'Select a state ...'],
					'pluginOptions' => [
						'allowClear' => true
					],
				]); ?>

			<?= $form->field($model, 'PRODUCT_WARNA')->widget(ColorInput::classname(), [
				'value' => 'red',
				'showDefaultPalette' => false,
				'options' => ['placeholder' => 'Choose your color ...'],
				'pluginOptions' => [
					'showInput' => true,
					'showInitial' => true,
					'showPalette' => true,
					'showPaletteOnly' => true,
					'showSelectionPalette' => true,
					'showAlpha' => false,
					'allowEmpty' => false,
					'preferredFormat' => 'name',
					'palette' => [
						[
							"white", "black", "grey", "silver", "gold", "brown", 
						],
						[
							"red", "orange", "yellow", "indigo", "maroon", "pink"
						],
						[
							"blue", "green", "violet", "cyan", "magenta", "purple", 
						],
					]
				]
			]); ?>
			
			<?= $form->field($model, 'PRODUCT_HEADLINE')->textInput() ?>

			<?= $form->field($model, 'STOCK_LEVEL')->textInput(['type'=>'number','min'=>1,'allowEmpty' => true,'integerOnly' => false]) ?>
			   
			<?= $form->field($model, 'CURRENT_PPN')->textInput(['type'=>'number','min'=>0,'max'=>10,'allowEmpty' => true,'integerOnly' => false]) ?>
    
			<div class="col-md-6">
				<?= 
				'<label class="control-label">Unit Group</label>';
				echo Select2::widget([
					'name' => 'state_2',
					'data' => ArrayHelper::map(ProductUnitGroup::find()->all(),'UNIT_ID_GRP','UNIT_NM_GRP'),
					'options' => ['placeholder' => 'Select a state ...','id'=>'unitgrp'],
					'pluginOptions' => [
						'allowClear' => true
					],
				]); ?>
			</div>

			<div class="col-md-6">
				<?= $form->field($model, 'UNIT_ID')->widget(DepDrop::classname(), [
					'type'=>DepDrop::TYPE_SELECT2,
					'options'=>['id'=>'subunit-id'],
					'pluginOptions'=>[
						'depends'=>['unitgrp'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['/master/data-barang/unit'])
					]
				]); ?>
			</div>

			<?= $form->field($model, 'PRODUCT_SIZE')->textInput(['type'=>'number','min'=>1,'allowEmpty' => true,'integerOnly' => false]) ?>
								
			<?= 
			$form->field($image, 'PRODUCT_IMAGE')->widget(FileInput::classname(), [
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
			]); 
			?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
<?php ActiveForm::end(); ?>


</div>
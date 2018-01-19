<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Store;
use kartik\widgets\FileInput;
use frontend\backend\master\models\Industry;
use frontend\backend\master\models\IndustryGroup;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-fdiscount-form">

<?php $form = ActiveForm::begin([
	'options'=>['enctype'=>'multipart/form-data'],
	]); ?>
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">	
		
        <?= $form->field($model, 'STORE_ID')->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Select Category....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])?>
			
			<?= $form->field($model, 'PRODUCT_NM')->textInput() ?>

			<?= $form->field($model, 'PRODUCT_QR')->textInput() ?>
			
			<?= $form->field($model, 'PRODUCT_WARNA')->textInput() ?>

			<?= $form->field($model, 'PRODUCT_SIZE')->textInput() ?>

			<?= $form->field($model, 'PRODUCT_SIZE_UNIT')->textInput() ?>
			
			<?= $form->field($model, 'PRODUCT_HEADLINE')->textInput() ?>
			
			<?php 
			// $form->field($model, 'STORE_ID')->widget(Select2::classname(), [
			// 		//'data' => $dropunit,
			// 		'options'=>['placeholder'=>'Select ...'],
			// 		'pluginOptions' => [
			// 			'allowClear' => true,
			// 			'ajax' => [
			// 				'url' =>$urlx,
			// 				'dataType' => 'json',
			// 				'data' => new JsExpression('function(params) { 
			// 						return {q:params.term,store_id:"'.$store_id.'"}; 
			// 					}
			// 				')
			// 			],
			// 		],
			// 	]);
			?>
			
		</div>
		<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
		

			<?= $form->field($model, 'STOCK_LEVEL')->textInput() ?>
			
			<?= $form->field($model, 'CURRENT_STOCK')->textInput() ?>
			
			<?= $form->field($model, 'CURRENT_HPP')->textInput() ?>
			
			<?= $form->field($model, 'CURRENT_PRICE')->textInput() ?>
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
					'defaultPreviewContent' => '<img src="https://www.mautic.org/media/images/default_avatar.png" alt="Your Avatar" style="width:160px">',
					'maxFileSize'=>30 //10KB
					
				],
				'pluginEvents' => [
					'fileclear' => 'function() { log("fileclear"); }',
					'filereset' => 'function() { log("filereset"); }',
				]
			]); 
			?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>


</div>


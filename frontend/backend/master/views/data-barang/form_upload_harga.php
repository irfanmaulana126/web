<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;


?>
   <?php $form = ActiveForm::begin([
			'options'=>['enctype'=>'multipart/form-data'], // important,
			'method' => 'post',
			'action' => ['/master/data-barang/upload-file-harga'],
   ]); ?>
		<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 6pt;">
		<div class="row" >
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php
						echo $form->field($modelPeriode, 'uploadExport')->widget(FileInput::classname(), [
							'options' => ['accept' => '.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel'],
							'pluginOptions' => [
								'showPreview' => false,
								'showUpload' => false,
								//'uploadUrl' => Url::to(['/sales/import-data/upload']),
							] 
						])->label("Upload for Import");
					?>
				</div>
					
			
		</div>
		<div class="text-right">
					<?=Html::submitButton('Upload',['class' => 'btn btn-success']); ?>
			</div>
	</div>
<?php ActiveForm::end(); ?>

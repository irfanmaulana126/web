<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use common\models\Store;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;

// $data = Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1','0']])->all();
$data = Yii::$app->db->createCommand("SELECT STORE_ID,STORE_NM FROM store WHERE ACCESS_GROUP='".Yii::$app->user->identity->ACCESS_GROUP."' AND STATUS IN (1,0)")->queryall();
array_push($data,array('STORE_ID'=>'-','STORE_NM'=>'None Store'));
?>
   <?php $form = ActiveForm::begin([
			'options'=>['enctype'=>'multipart/form-data'], // important,
			'method' => 'post',
			'action' => ['/master/data-barang/upload-file'],
   ]); ?>
		<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 6pt;">
		<div class="row" >
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
		<?= $form->field($modelPeriode, 'STORE_ID')->widget(Select2::classname(),[
            'data'=>ArrayHelper::map($data,'STORE_ID','STORE_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Select Category....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])->label('STORE')?>
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
					
			<div class="col-md-12">
					<?=Html::submitButton('Upload',['class' => 'btn btn-success']); ?>
				<div class="pull-right">
						<?=Html::Button('cara Upload',['class' => 'btn btn-warning','data-toggle'=>'modal','href'=>'#cara']); ?>
						<?=Html::a('Download Template','/master/data-barang/download-template',['class' => 'btn btn-info']); ?>
				</div>
			</div>
		</div>
	</div>
<?php ActiveForm::end(); ?>

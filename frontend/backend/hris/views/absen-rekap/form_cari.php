<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;;

?>
   <?php $form = ActiveForm::begin([
			'id'=> $modelPeriode->formName(),			
			'enableClientValidation'=> true,
			//'enableAjaxValidation'=>true,
			//'method' => 'post',
			//'validationUrl'=>Url::toRoute('/absensi/absen-import/valid')
			'action' =>['/inventory/stock-product/index']
   ]); ?>
		<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 6pt;">
		<div class="row" >
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php
						echo $form->field($modelPeriode, 'TAHUNBULAN')->widget(DatePicker::classname(), [
							'options' => ['placeholder' => 'Enter date ...'],
							'convertFormat' => true,
							'pluginOptions' => [
								'autoclose'=>true,
								'startView'=>'year',
								'minViewMode'=>'months',
								// 'todayHighlight' => true,
								 'format' => 'yyyy-MM'
							],
						])->label('PILIH TAHUN DAN BULAN');		
					?>
					<?php
						// echo $form->field($modelPeriode, 'BULAN')->widget(DatePicker::classname(), [
							// 'options' => ['placeholder' => 'Enter date ...'],
							// 'convertFormat' => true,
							// 'pluginOptions' => [
								// 'autoclose'=>true,
								// 'todayHighlight' => true,
								// 'format' => 'yyyy-MM-dd'
							// ],
						// ])->label('PILIH BULAN');			
					?>
				</div>
					
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?=Html::submitButton('CARI',['class' => 'btn btn-success']); ?>
			</div>
		</div>
	</div>
<?php ActiveForm::end(); ?>


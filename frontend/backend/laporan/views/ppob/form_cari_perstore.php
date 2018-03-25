<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use common\models\Store;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;;

?>
   <?php $form = ActiveForm::begin([
			'id'=> $modelPeriode->formName(),			
			'enableClientValidation'=> true,
			'action' =>['/laporan/ppob/perstore']
   ]); ?>
		<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 6pt;">
		<div class="row" >
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php
						echo $form->field($modelPeriode, 'TAHUN')->widget(DatePicker::classname(), [
							'options' => ['placeholder' => 'Enter date ...'],
							'convertFormat' => true,
							'pluginOptions' => [
								'autoclose'=>true,
								'startView'=>'year',
								'minViewMode'=>'months',
								// 'todayHighlight' => true,
								 'format' => 'yyyy-MM'
							],
						])->label('PILIH TAHUN');		
					?>
					<?= $form->field($modelPeriode, 'STORE_ID')->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1','0']])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Pilih Toko....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])->label('STORE')?>
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


<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use kartik\depdrop\DepDropAction;
use yii\web\JsExpression;
use frontend\backend\ppob\models\PpobTransaksiSaldo;
use yii\web\View;
use softark\duallistbox\DualListbox;

$this->registerJs("
	$('#access').change(function() { 
		change();
	 });
	 function change()
	 {
		 var selectValue=$('#access').val();
		 $('#store').empty();
		 $.post('/ppob/ppob-transaksi-saldo/substore?ACCESS_GROUP='+selectValue,
			function(data){
				$('select#store').html(data);
			});

	 };
",View::POS_READY);
?>

<div class="ppob-transaksi-create">

<div class="ppob-transaksi-form">
   <?php $form = ActiveForm::begin([
			'id'=> $modelPeriode->formName(),			
			'enableClientValidation'=> true,
			//'enableAjaxValidation'=>true,
			//'method' => 'post',
			//'validationUrl'=>Url::toRoute('/inventory/stock-opname/valid')
			'action' =>['/master/store/restore']
   ]); ?>
			  
			<?php 
			$options = [
				'multiple' => true,
				'size' => 20,
			];
			// echo Html::activeListBox($model, $attribute, $items, $options);
			echo DualListbox::widget([
				'model' => $model,
				'attribute' => $attribute,
				'items' => $items,
				'options' => $options,
				'clientOptions' => [
					'moveOnSelect' => false,
					'selectedListLabel' => 'Selected Items',
					'nonSelectedListLabel' => 'Available Items',
				],
			]);
			/* $form->field($modelPeriode, 'ACCESS_GROUP')->widget(Select2::classname(), [
				'data' => ArrayHelper::map(PpobTransaksiSaldo::find()->all(),'ACCESS_GROUP','user.username'),
				'options' => [
					'id'=>'access',
					'placeholder' => 'Select Access Group...',
				],
				'pluginOptions' => [
					'allowClear' => true,
				],
			]);?>

			<?= $form->field($modelPeriode, 'STORE_ID')->widget(Select2::classname(), [
				'options' => ['id'=>'store','placeholder' => 'Select Store Id ...',],
				]);*/?>

			<div class="form-group">
					<?=Html::submitButton('CARI',['class' => 'btn btn-success']); ?>
			</div>

<?php ActiveForm::end(); ?>

</div>
</div>
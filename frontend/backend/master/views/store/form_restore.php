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
use yii\web\View;
use softark\duallistbox\DualListbox;
use common\models\Store;
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
			'action' =>['/master/store/restore']
   ]); ?>
			  
			<?php
			echo DualListbox::widget([
				'model' => $modelPeriode,
				'attribute' => 'STATUS',
				'items' => ArrayHelper::map(Store::find()->all(),'STATUS','STORE_NM'),
				'clientOptions' => [
					'moveOnSelect' => false,
					'selectedListLabel' => 'Selected Items',
					'nonSelectedListLabel' => 'Available Items',
				],
			]);?>

			<div class="form-group">
					<?=Html::submitButton('CARI',['class' => 'btn btn-success']); ?>
			</div>

<?php ActiveForm::end(); ?>

</div>
</div>
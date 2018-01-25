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
$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        
?>

<div class="ppob-transaksi-create">

<div class="ppob-transaksi-form">
   <?php 
//    print_r($items);die();
   $form = ActiveForm::begin([	
			'enableClientValidation'=> true,
			'action' =>['/master/store/restore']
   ]); ?>
			  
			<?php
			$options = [
				'multiple' => true,
				'size' => 10,
			];
			echo DualListbox::widget([
				'model' => $modelPeriode,
				'attribute' => 'STATUS',
				// 'selection' => ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user,'STATUS' =>'3'])->all(),'STORE_ID','STORE_NM'),
				'items' => $items,
				'options' => $options,
				'clientOptions' => [
					'moveOnSelect' => false,
					'selectedListLabel' => 'Selected Items',
					'nonSelectedListLabel' => 'Available Items',
				],
			]);?>
<br>
			<div class="form-group">
					<?=Html::submitButton('Simpan',['class' => 'btn btn-success']); ?>
			</div>

<?php ActiveForm::end(); ?>

</div>
</div>
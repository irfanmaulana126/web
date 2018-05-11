<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
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
$warnaLabel='rgba(21, 175, 213, 0.14)';
$widthLabel='155px';
?>

<?php $form = ActiveForm::begin([
	'options'=>['enctype'=>'multipart/form-data'],
	]); ?>	
		
        <?= $form->field($model, 'STORE_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>Toko</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1','0']])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Pilih Toko....','id'=>'store'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])->label(false)?>
		
		<?= $form->field($model, 'GROUP_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>GROUP PPRODUK</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width:157px;']
						]
					]
				])->widget(DepDrop::classname(), [
					'type'=>DepDrop::TYPE_SELECT2,
					'options'=>['id'=>'group'],
					'pluginOptions'=>[
						'depends'=>['store'],
						'placeholder'=>'Select...',
						'url'=>Url::to(['/master/data-barang/group'])
					]
				])->label(false) ; ?>

			<?= $form->field($model, 'PRODUCT_NM',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>Produk</b></span>',
							'options'=>['style' =>' 
											background-color:'.$warnaLabel.';
											width:450px;
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->textInput(['style'=>'text-transform:uppercase;width:410px'])->label(false) ?>

		<div class="form-group text-right">
			<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
<?php ActiveForm::end(); ?>




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
?>

<div class="item-fdiscount-form">

<?php $form = ActiveForm::begin([
	'options'=>['enctype'=>'multipart/form-data'],
	]); ?>	
		
        <?= $form->field($model, 'STORE_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >STORE</span>',
							'options'=>['style' =>' background-color: lightblue;width:125px;text-align:right']
						]
					]
				])->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1','0']])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Select Store....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])->label(false)?>
			
			<?= $form->field($model, 'PRODUCT_NM',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >NAMA PRODUK</span>',
							'options'=>['style' =>' background-color: lightblue;width:100px;text-align:right']
						]
					]
				])->textInput(['style'=>'text-transform:uppercase'])->label(false) ?>

		<div class="form-group text-right">
			<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
<?php ActiveForm::end(); ?>


</div>


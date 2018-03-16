<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\backend\master\models\Supplier;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-discount-form">

<?php $form = ActiveForm::begin(); ?>
       <?=$form->field($model,'storeNm',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span><b>Toko </b></span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color:rgba(21, 175, 213, 0.14);width:100px;text-align:right']
					]
				]
				])->textInput([
					'value'=>$productdetail->STORE_NM,
					'readOnly'=>true,
                    'style'=>'border-radius: 0px 5px 5px 0px;'
				])->label(false);	
		?>
        <?=$form->field($model,'produkNm',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Produk</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color:rgba(21, 175, 213, 0.14);width:100px;text-align:right']
						]
					]
				])->textInput([
					'value'=>$productdetail->PRODUCT_NM,
					'readOnly'=>true,
                    'style'=>'border-radius: 0px 5px 5px 0px;'
				])->label(false);	
		?>        
        <?= $form->field($model, 'SUPPLIER_ID',[
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Supplier</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color:rgba(21, 175, 213, 0.14);width:100px;text-align:right']
						]
					],		
				])->widget(Select2::classname(),[				
				'data'=>ArrayHelper::map(Supplier::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1']])->all(),'SUPPLIER_ID','SUPPLIER_NM'),'language' => 'en',
				'options' => ['placeholder'=>'Select Category....','style'=>'border-radius: 0px 5px 5px 0px;'],
				'pluginOptions' => [
					'allowClear' => true,					
				], 
				
			])->label(false)
		?>
		 <?=$form->field($model,'INPUT_STOCK',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Input Stock</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color:rgba(21, 175, 213, 0.14);width:100px;text-align:right']
						]
					]
				])->textInput([
					'type'=>'number',
					'min'=>1,
					'allowEmpty' => true,
					'integerOnly' => false,
                    'style'=>'border-radius: 0px 5px 5px 0px;'
				])->label(false);	
		?>    
            
    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>


</div>


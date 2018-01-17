<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\label\LabelInPlace;
use kartik\widgets\Select2;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use kartik\widgets\DatePicker;
use kartik\widgets\TouchSpin;
use frontend\backend\master\models\ProductUnit;
use frontend\backend\master\models\Industry;
use frontend\backend\master\models\IndustryGroup;
use yii\web\JsExpression;
?>

 <?php $form = ActiveForm::begin([
	'options'=>['enctype'=>'multipart/form-data'],
	]); ?>
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		
			<?= $form->field($model, 'STORE_ID')->textInput(['value' =>$store_id]) ?>
			
			<?= $form->field($model, 'PRODUCT_NM')->textInput() ?>
			
			<?= $form->field($model, 'UNIT_ID')->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(ProductUnit::find()->all(),'UNIT_ID','UNIT_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Select Unit....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])?>
		<?= $form->field($model, 'INDUSTRY_GRP_ID')->dropDownList(ArrayHelper::map(IndustryGroup::find()->all(), 'INDUSTRY_GRP_ID', 'INDUSTRY_GRP_NM'),['id'=>'INDUSTRY-GRP'])?>

		
		<?= $form->field($model, 'INDUSTRY_ID')->widget(DepDrop::classname(), [
				'options' => ['id'=>'subIndustry-grp-id'],
				'pluginOptions'=>[
					'depends'=>['INDUSTRY-GRP'],
					'placeholder' => 'Select...',
					'url' => Url::to(['/master/product/industry'])
				]
			]); ?>				
		
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>

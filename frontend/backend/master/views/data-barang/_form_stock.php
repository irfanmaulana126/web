<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
    <?= Html::label('STORE', 'xxx') ?>
        <?= Html::textInput('XXX', $productdetail->STORE_NM, ['class' => 'form-control','readOnly'=>true]) ?>
        <br>
        <?= Html::label('PRODUK', 'xxx') ?>
        <?= Html::textInput('XXX', $productdetail->PRODUCT_NM, ['class' => 'form-control','readOnly'=>true]) ?>
        <br>
        <?= $form->field($model, 'SUPPLIER_ID')->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(Supplier::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1']])->all(),'SUPPLIER_ID','SUPPLIER_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Select Category....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])->label('Supplier')?>
    <?= $form->field($model,'INPUT_STOCK')->textInput(['type'=>'number','min'=>1,'allowEmpty' => true,'integerOnly' => false]) ?>
            
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>


</div>


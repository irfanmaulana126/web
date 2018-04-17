<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Store;
use frontend\backend\laporan\models\JurnalAkun;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTambahan */

?>
<div class="jurnal-tambahan-update">

    <div class="jurnal-tambahan-form">

    <?php $form = ActiveForm::begin(); ?>

       <?= $form->field($model, 'STORE_ID')->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,'STATUS'=>['1','0']])->all(),'STORE_ID','STORE_NM'),'language' => 'en',
            'options' => ['placeholder'=>'Select Category....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ])->label('STORE')?>

    <?= $form->field($model, 'STT_PAY')->dropDownList(['1'=>'TUNAI','2'=>'NON TUNAI'],['prompt'=>'Select Option']) ?>

     <?= $form->field($model, 'AKUN_CODE')->widget(Select2::classname(),[
            'data'=>ArrayHelper::map(JurnalAkun::find()->all(),'AKUN_CODE',function ($model)
            {
                return $model['AKUN_CODE'].' / '.$model['AKUN_NM'];
            }),'language' => 'en',
            'options' => ['placeholder'=>'Select Category....'],
            'pluginOptions' => [
                'allowClear' => true
            ], 
        ]) ?>

    <?= $form->field($model, 'JUMLAH_TOTAL')->widget(MaskMoney::classname(), [
		'options' => [
					'placeholder' => 'JUMLAH TOTAL ...',
					'class' => 'form-control',
					'id'=>'margin',
				],'pluginOptions' => [
					'prefix' => 'Rp ',
					'precision' => 0
				 ]
				]); ?>

    <?= $form->field($model, 'FREKUENSI')->dropDownList(['1'=>'HARIAN','2'=>'MINGGUAN','3'=>'BULANAN'],['prompt'=>'Select Option']) ?>

    <?php
        echo '<label class="control-label">PERIODE TANGGAL</label>';
       echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'RANGE_TGL1',
            'attribute2' => 'RANGE_TGL2',
            'options' => ['placeholder' => 'Start date'],
            'options2' => ['placeholder' => 'End date'],
            'type' => DatePicker::TYPE_RANGE,
            'form' => $form,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                "startDate" => date('Y-m-d'),
            ]
        ]);
    ?>
<br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>

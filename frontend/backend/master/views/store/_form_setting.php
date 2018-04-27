<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use frontend\backend\master\models\StoreMembershipPaket;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\StoreKasir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-kasir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DOMPET_AUTODEBET',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >Dompet Autodebet </span>',
						'options'=>['style' =>' background-color: lightblue;text-align:right']
					]
				]
				])->dropDownList(['1' => 'YA', '0' => 'TIDAK'],['prompt'=>'Select Option'])->label(false); ?>

    <?= $form->field($model, 'PAYMENT_METHODE',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >Payment Methode </span>',
						'options'=>['style' =>' background-color: lightblue;text-align:right']
					]
				]
				])->dropDownList(['0' => 'DEBET DOMPET', '1' => 'KARTU KREDIT', '2' => 'TRANSFER MANUAL'],['prompt'=>'Select Option'])->label(false); ?>

    <?= $form->field($model, 'PAKET_ID',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >Paket </span>',
						'options'=>['style' =>' background-color: lightblue;text-align:right']
					]
				]
				])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(StoreMembershipPaket::find()->where(['PAKET_STT'=>1])->all(),'PAKET_ID','PAKET_NM'),
            'language' => 'EN',
            'options' => ['placeholder' => 'Select a state ...','id'=>'province-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); ?>

	<div style="float:left">
		<?= Html::Button('Daftar Paket', ['class' => 'btn btn-warning','value'=>Url::toRoute(['/master/store/paket']),'id'=>'paket']) ?>
	</div>

    <div class="text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

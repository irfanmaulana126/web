<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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

    <?= $form->field($model, 'DOMPET_AUTODEBET')->dropDownList(['1' => 'YA', '0' => 'TIDAK'],['prompt'=>'Select Option']); ?>

    <?= $form->field($model, 'PAYMENT_METHODE')->dropDownList(['0' => 'DEBET DOMPET', '1' => 'KARTU KREDIT', '2' => 'TRANSFER MANUAL'],['prompt'=>'Select Option']); ?>

    <?= $form->field($model, 'PAKET_ID')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(StoreMembershipPaket::find()->where(['PAKET_STT'=>1])->all(),'PAKET_ID','PAKET_NM'),
            'language' => 'EN',
            'options' => ['placeholder' => 'Select a state ...','id'=>'province-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::Button('Daftar Paket', ['class' => 'btn btn-warning','value'=>Url::toRoute(['/master/store/paket']),'id'=>'paket']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

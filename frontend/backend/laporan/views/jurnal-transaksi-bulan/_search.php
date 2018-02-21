<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTransaksiBulanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-transaksi-bulan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'JURNAL_BULAN') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'TRANS_DATE') ?>

    <?= $form->field($model, 'TAHUN') ?>

    <?php // echo $form->field($model, 'BULAN') ?>

    <?php // echo $form->field($model, 'JUMLAH') ?>

    <?php // echo $form->field($model, 'STT_PAY') ?>

    <?php // echo $form->field($model, 'STT_NM') ?>

    <?php // echo $form->field($model, 'AKUN_CODE') ?>

    <?php // echo $form->field($model, 'AKUN_NM') ?>

    <?php // echo $form->field($model, 'KTG_CODE') ?>

    <?php // echo $form->field($model, 'KTG_NM') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

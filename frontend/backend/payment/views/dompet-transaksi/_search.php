<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTransaksiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dompet-transaksi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TRANS_ID') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'VA_ID') ?>

    <?= $form->field($model, 'TRANSCODE') ?>

    <?php // echo $form->field($model, 'TRANSCODE_NM') ?>

    <?php // echo $form->field($model, 'TRANS_TYPE') ?>

    <?php // echo $form->field($model, 'TRANS_TYPE_NM') ?>

    <?php // echo $form->field($model, 'JUMLAH') ?>

    <?php // echo $form->field($model, 'CURRENT_TGL') ?>

    <?php // echo $form->field($model, 'TGL') ?>

    <?php // echo $form->field($model, 'WAKTU') ?>

    <?php // echo $form->field($model, 'REF_NUMBER') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreMembershipPaketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-membership-paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PAKET_ID') ?>

    <?= $form->field($model, 'PAKET_GROUP') ?>

    <?= $form->field($model, 'PAKET_NM') ?>

    <?= $form->field($model, 'PAKET_DURATION') ?>

    <?= $form->field($model, 'PAKET_DURATION_BONUS') ?>

    <?php // echo $form->field($model, 'HARGA_BULAN') ?>

    <?php // echo $form->field($model, 'HARGA_HARI') ?>

    <?php // echo $form->field($model, 'HARGA_PAKET') ?>

    <?php // echo $form->field($model, 'HARGA_PAKET_HARI') ?>

    <?php // echo $form->field($model, 'PAKET_STT') ?>

    <?php // echo $form->field($model, 'PAKET_STT_NM') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

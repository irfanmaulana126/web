<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobTransaksiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppob-transaksi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'TRANS_ID') ?>

    <?= $form->field($model, 'TRANS_DATE') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?php // echo $form->field($model, 'DETAIL_ID') ?>

    <?php // echo $form->field($model, 'KODE') ?>

    <?php // echo $form->field($model, 'NUMBER_ID') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <?php // echo $form->field($model, 'NOMINAL') ?>

    <?php // echo $form->field($model, 'HARGA_KG') ?>

    <?php // echo $form->field($model, 'HARGA_JUAL') ?>

    <?php // echo $form->field($model, 'QTY') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

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

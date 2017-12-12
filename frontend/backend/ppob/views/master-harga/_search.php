<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobMasterHargaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ppob-master-harga-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'DETAIL_ID') ?>

    <?= $form->field($model, 'KODE') ?>

    <?= $form->field($model, 'KETERANGAN') ?>

    <?= $form->field($model, 'NOMINAL') ?>

    <?php // echo $form->field($model, 'HARGA1') ?>

    <?php // echo $form->field($model, 'HARGA2') ?>

    <?php // echo $form->field($model, 'HARGA3') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'DCRIP') ?>

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

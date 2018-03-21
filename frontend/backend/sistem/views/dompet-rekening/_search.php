<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\DompetRekeningSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dompet-rekening-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'NAMA_LENGKAP') ?>

    <?= $form->field($model, 'BANK') ?>

    <?= $form->field($model, 'NO_REK') ?>

    <?php // echo $form->field($model, 'ALAMAT') ?>

    <?php // echo $form->field($model, 'TLP') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'DCRP_DETIL') ?>

    <?php // echo $form->field($model, 'YEAR_AT') ?>

    <?php // echo $form->field($model, 'MONTH_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

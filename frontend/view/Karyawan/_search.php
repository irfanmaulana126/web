<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\KaryawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'KARYAWAN_ID') ?>

    <?= $form->field($model, 'NAMA_DPN') ?>

    <?php // echo $form->field($model, 'NAMA_TGH') ?>

    <?php // echo $form->field($model, 'NAMA_BLK') ?>

    <?php // echo $form->field($model, 'KTP') ?>

    <?php // echo $form->field($model, 'TMP_LAHIR') ?>

    <?php // echo $form->field($model, 'TGL_LAHIR') ?>

    <?php // echo $form->field($model, 'GENDER') ?>

    <?php // echo $form->field($model, 'ALAMAT') ?>

    <?php // echo $form->field($model, 'STS_NIKAH') ?>

    <?php // echo $form->field($model, 'TLP') ?>

    <?php // echo $form->field($model, 'HP') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'DCRP_DETIL') ?>

    <?php // echo $form->field($model, 'YEAR_AT') ?>

    <?php // echo $form->field($model, 'MONTH_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

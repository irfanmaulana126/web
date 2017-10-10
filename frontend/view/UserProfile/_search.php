<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_ID') ?>

    <?= $form->field($model, 'NM_DEPAN') ?>

    <?= $form->field($model, 'NM_TENGAH') ?>

    <?= $form->field($model, 'NM_BELAKANG') ?>

    <?php // echo $form->field($model, 'KTP') ?>

    <?php // echo $form->field($model, 'ALMAT') ?>

    <?php // echo $form->field($model, 'LAHIR_TEMPAT') ?>

    <?php // echo $form->field($model, 'LAHIR_TGL') ?>

    <?php // echo $form->field($model, 'LAHIR_GENDER') ?>

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

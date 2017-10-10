<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Store */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_ID')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'UUID')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PLAYER_ID')->textInput() ?>

    <?= $form->field($model, 'DATE_START')->textInput() ?>

    <?= $form->field($model, 'DATE_END')->textInput() ?>

    <?= $form->field($model, 'PROVINCE_ID')->textInput() ?>

    <?= $form->field($model, 'PROVINCE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CITY_ID')->textInput() ?>

    <?= $form->field($model, 'CITY_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ALAMAT')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PIC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TLP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FAX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'DCRP_DETIL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'YEAR_AT')->textInput() ?>

    <?= $form->field($model, 'MONTH_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

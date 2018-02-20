<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\RptDailyChart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rpt-daily-chart-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Val_Nm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Val_Cnt')->textInput() ?>

    <?= $form->field($model, 'Val_Json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

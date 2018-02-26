<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-template-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RPT_DETAIL_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RPT_SORTING')->textInput() ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AKUN_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KTG_CODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AKUN_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KTG_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RPT_TITLE_ID')->textInput() ?>

    <?= $form->field($model, 'RPT_TITLE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RPT_GROUP_ID')->textInput() ?>

    <?= $form->field($model, 'RPT_GROUP_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CAL_FORMULA')->textInput() ?>

    <?= $form->field($model, 'CAL_FORMULA_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'STATUS_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'MONTH_AT')->textInput() ?>

    <?= $form->field($model, 'YEAR_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

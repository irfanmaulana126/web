<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateTitleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurnal-template-title-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'RPT_TITLE_ID') ?>

    <?= $form->field($model, 'RPT_TITLE_NM') ?>

    <?= $form->field($model, 'RPT_GROUP_ID') ?>

    <?= $form->field($model, 'RPT_GROUP_NM') ?>

    <?= $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

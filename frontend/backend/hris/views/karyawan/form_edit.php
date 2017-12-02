<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NAMA_DPN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAMA_TGH')->textInput() ?>

    <?= $form->field($model, 'NAMA_BLK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TLP')->textInput() ?>

    <?= $form->field($model, 'GENDER')->textInput() ?>  
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

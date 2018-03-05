<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\field\FieldRange;
use kartik\widgets\Spinner;

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>
   
    <?= $form->field($model, 'POT_RUPIAH')->textInput() ?>

    <?=FieldRange::widget([
    'form' => $form,
    'model' => $model,
    'label' => 'Enter time range',
    'attribute1' => 'POT_JAM1',
    'attribute2' => 'POT_JAM2',
    'type' => FieldRange::INPUT_DATETIME,
]); ?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

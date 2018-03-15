<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\field\FieldRange;
use kartik\widgets\TouchSpin;

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=FieldRange::widget([
    'form' => $form,
    'model' => $model,
    'label' => 'JARAK TANGGAL AWAL KE TANGGAL AKHIR',
    'attribute1' => 'TGL1',
    'attribute2' => 'TGL2',
    'type' => FieldRange::INPUT_SPIN, 
    'widgetOptions1' => [
        'pluginOptions' => [
        'min' => 1,
        'max' => 30,
    ],
    ],
    'widgetOptions2' => [
        'pluginOptions' => [
        'min' => 1,
        'max' => 30,
    ],
    ],
]);?>
   
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

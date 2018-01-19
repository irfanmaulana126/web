<?php 
echo "default";
use kartik\field\FieldRange;
use kartik\widgets\ActiveForm;

$form = ActiveForm::begin();

echo FieldRange::widget([
    'form' => $form,
    'model' => $model,
    'label' => 'Enter amount range',
    'attribute1' => 'INDUSTRY_ID',
    'attribute2' => 'INDUSTRY_ID',
    'type' => FieldRange::INPUT_SPIN,
]);

?>
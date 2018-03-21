<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\DompetRekeningImage */

$this->title = 'Update Dompet Rekening Image: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dompet Rekening Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dompet-rekening-image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

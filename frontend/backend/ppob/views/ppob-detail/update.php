<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobDetail */

$this->title = 'Update Ppob Detail: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Ppob Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'DETAIL_ID' => $model->DETAIL_ID, 'HEADER_ID' => $model->HEADER_ID, 'PROVIDER_ID' => $model->PROVIDER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ppob-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

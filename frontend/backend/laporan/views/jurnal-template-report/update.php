<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateReport */

$this->title = 'Update Jurnal Template Report: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Template Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RPT_GROUP__ID, 'url' => ['view', 'id' => $model->RPT_GROUP__ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurnal-template-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

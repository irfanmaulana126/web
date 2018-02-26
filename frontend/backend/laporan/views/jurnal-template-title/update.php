<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateTitle */

$this->title = 'Update Jurnal Template Title: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Template Titles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RPT_TITLE_ID, 'url' => ['view', 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurnal-template-title-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

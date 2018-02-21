<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTranscode */

$this->title = 'Update Dompet Transcode: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dompet Transcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TRANSCODE, 'url' => ['view', 'id' => $model->TRANSCODE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dompet-transcode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

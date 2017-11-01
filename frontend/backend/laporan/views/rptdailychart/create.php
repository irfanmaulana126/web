<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\RptDailyChart */

$this->title = 'Create Rpt Daily Chart';
$this->params['breadcrumbs'][] = ['label' => 'Rpt Daily Charts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpt-daily-chart-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

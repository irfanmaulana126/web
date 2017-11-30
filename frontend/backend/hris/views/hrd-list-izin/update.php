<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdListIzin */

$this->title = 'Update Hrd List Izin: ' . $model->IZIN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd List Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IZIN_ID, 'url' => ['view', 'id' => $model->IZIN_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hrd-list-izin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

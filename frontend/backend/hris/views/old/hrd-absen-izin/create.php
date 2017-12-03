<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsenIzin */

$this->title = 'Create Hrd Absen Izin';
$this->params['breadcrumbs'][] = ['label' => 'Hrd Absen Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-absen-izin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

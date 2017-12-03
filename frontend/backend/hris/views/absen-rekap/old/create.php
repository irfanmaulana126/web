<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsenRekap */

$this->title = 'Create Hrd Absen Rekap';
$this->params['breadcrumbs'][] = ['label' => 'Hrd Absen Rekaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-absen-rekap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

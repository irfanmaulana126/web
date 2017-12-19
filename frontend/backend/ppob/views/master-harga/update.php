<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobMasterHarga */

$this->title = 'Update Ppob Master Harga: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Ppob Master Hargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ppob-master-harga-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

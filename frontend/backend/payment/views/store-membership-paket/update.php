<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreMembershipPaket */

$this->title = 'Update Store Membership Paket: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Store Membership Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PAKET_ID, 'url' => ['view', 'id' => $model->PAKET_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-membership-paket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

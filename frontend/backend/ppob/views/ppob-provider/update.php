<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobProvider */

$this->title = 'Update Ppob Provider: ' . $model->PROVIDER_ID;
$this->params['breadcrumbs'][] = ['label' => 'Ppob Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PROVIDER_ID, 'url' => ['view', 'id' => $model->PROVIDER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ppob-provider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

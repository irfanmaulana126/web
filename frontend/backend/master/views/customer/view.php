<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Customer */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CUSTOMER_ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'NAME',
            'EMAIL',
            'PHONE',
            'DCRP_DETIL:ntext',
        ],
    ]) ?>

</div>

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
            ['attribute'=>'NAME',
            'label'=>'NAMA'  ],
           ['attribute'=>'EMAIL',
            'label'=>'EMAIL'  ],
           ['attribute'=>'PHONE',
            'label'=>'PHONE'  ],
           ['attribute'=>'DCRP_DETIL',
            'label'=>'DCRP_DETIL'  ],
        ],
    ]) ?>

</div>

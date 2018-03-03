<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Supplier */
?>
<div class="supplier-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'SUPPLIER_ID',
            'SUPPLIER_NM',
            'ACCESS_GROUP',
            'ALAMAT',
            'EMAIL:email',
            'NO_TLP',
            'PIC',
            'PHONE',
            'STATUS',
            'DCRP_DETIL:ntext',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'YEAR_AT',
            'MONTH_AT',
        ],
    ]) ?>

</div>

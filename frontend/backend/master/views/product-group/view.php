<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductGroup */

?>
<div class="product-group-view">

   
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'GROUP_NM',
            'label'=>'NAMA'  ],
            'NOTE:ntext',
        ],
    ]) ?>

</div>

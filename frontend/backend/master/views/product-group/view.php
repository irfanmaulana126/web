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
            'GROUP_NM',
            'NOTE:ntext',
        ],
    ]) ?>

</div>

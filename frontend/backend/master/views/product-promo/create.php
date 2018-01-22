<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductPromo */

$this->title = 'Create Product Promo';
$this->params['breadcrumbs'][] = ['label' => 'Product Promos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-promo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

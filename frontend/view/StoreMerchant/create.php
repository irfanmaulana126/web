<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\StoreMerchant */

$this->title = 'Create Store Merchant';
$this->params['breadcrumbs'][] = ['label' => 'Store Merchants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-merchant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

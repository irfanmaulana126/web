<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreMembershipPaket */

$this->title = 'Create Store Membership Paket';
$this->params['breadcrumbs'][] = ['label' => 'Store Membership Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-membership-paket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobMasterHarga */

$this->title = 'Create Ppob Master Harga';
$this->params['breadcrumbs'][] = ['label' => 'Ppob Master Hargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppob-master-harga-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

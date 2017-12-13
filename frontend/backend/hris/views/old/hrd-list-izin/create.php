<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdListIzin */

$this->title = 'Create Hrd List Izin';
$this->params['breadcrumbs'][] = ['label' => 'Hrd List Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-list-izin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

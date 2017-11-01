<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsen */

$this->title = 'Create Hrd Absen';
$this->params['breadcrumbs'][] = ['label' => 'Hrd Absens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-absen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

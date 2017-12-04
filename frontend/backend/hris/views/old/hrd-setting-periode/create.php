<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingPeriode */

$this->title = 'Create Hrd Setting Periode';
$this->params['breadcrumbs'][] = ['label' => 'Hrd Setting Periodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-setting-periode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

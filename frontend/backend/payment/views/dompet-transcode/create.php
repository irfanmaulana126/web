<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTranscode */

$this->title = 'Create Dompet Transcode';
$this->params['breadcrumbs'][] = ['label' => 'Dompet Transcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-transcode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

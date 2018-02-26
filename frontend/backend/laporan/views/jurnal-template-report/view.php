<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateReport */

$this->title = $model->RPT_GROUP__ID;
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Template Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-template-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->RPT_GROUP__ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->RPT_GROUP__ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'RPT_GROUP__ID',
            'RPT_GROUP_NM',
            'STATUS',
            'KETERANGAN:ntext',
        ],
    ]) ?>

</div>

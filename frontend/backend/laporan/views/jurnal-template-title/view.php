<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateTitle */

$this->title = $model->RPT_TITLE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Template Titles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-template-title-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID], [
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
            'RPT_TITLE_ID',
            'RPT_TITLE_NM',
            'RPT_GROUP_ID',
            'RPT_GROUP_NM',
            'STATUS',
            'KETERANGAN:ntext',
        ],
    ]) ?>

</div>

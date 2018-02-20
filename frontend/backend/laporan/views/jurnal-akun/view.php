<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalAkun */

$this->title = $model->AKUN_CODE;
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Akuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-akun-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AKUN_CODE], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AKUN_CODE], [
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
            'AKUN_CODE',
            'AKUN_NM',
            'KTG_CODE',
            'KTG_NM',
            'STATUS',
            'KETERANGAN:ntext',
        ],
    ]) ?>

</div>

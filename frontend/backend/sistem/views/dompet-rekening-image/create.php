<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\DompetRekeningImage */

$this->title = 'Create Dompet Rekening Image';
$this->params['breadcrumbs'][] = ['label' => 'Dompet Rekening Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-rekening-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobProvider */

$this->title = 'Create Ppob Provider';
$this->params['breadcrumbs'][] = ['label' => 'Ppob Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppob-provider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

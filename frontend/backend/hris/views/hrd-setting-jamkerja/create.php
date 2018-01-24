<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingJamkerja */

$this->title = 'Create Hrd Setting Jamkerja';
$this->params['breadcrumbs'][] = ['label' => 'Hrd Setting Jamkerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-setting-jamkerja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

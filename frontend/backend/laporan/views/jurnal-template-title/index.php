<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\backend\laporan\models\JurnalTemplateDetailSearch;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateTitleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurnal Template Titles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-template-title-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jurnal Template Title', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\ExpandRowColumn',
            'value'=>function($model,$key,$index,$column){
                return GridView::ROW_COLLAPSED;
            },
            'detail'=> function($model,$key,$index,$column)
            {
                $searchModel =  new JurnalTemplateDetailSearch();
                $searchModel->RPT_TITLE_ID = $model->RPT_TITLE_ID;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return Yii::$app->controller->renderPartial('index_detail',[
                    'searchModel'=>$searchModel,
                    'dataProvider'=>$dataProvider
                ]);
            }
        ],

            'RPT_TITLE_ID',
            'RPT_TITLE_NM',
            'RPT_GROUP_ID',
            'RPT_GROUP_NM',
            'STATUS',
            //'KETERANGAN:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

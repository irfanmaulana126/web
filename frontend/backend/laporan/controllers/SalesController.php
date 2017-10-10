<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use yii\web\Controller;
use frontend\backend\laporan\models\TransPenjualanDetail;
use frontend\backend\laporan\models\TransPenjualanDetailSearch;


class SalesController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new TransPenjualanDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

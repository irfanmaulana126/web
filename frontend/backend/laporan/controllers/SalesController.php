<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use yii\web\Controller;
use frontend\backend\laporan\models\TransPenjualanHeader;
use frontend\backend\laporan\models\TransPenjualanHeaderSearch;

class SalesController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new TransPenjualanHeaderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

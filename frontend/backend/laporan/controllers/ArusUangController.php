<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use frontend\backend\laporan\models\ComponenBulan;
use frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthly;
use frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthlySearch;

class ArusUangController extends Controller
{
    public function actionIndex()
    {
		
		
		/*==========================
		* ARUS KAS MASUK & KELUAR
		*===========================*/
        $searchModel = new TransPenjualanHeaderSummaryMonthlySearch(['thn'=>'2017']);
        $dataProvider = $searchModel->searchKasMasukYear(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }	
}

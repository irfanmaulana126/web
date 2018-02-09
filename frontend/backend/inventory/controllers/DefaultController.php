<?php

namespace frontend\backend\inventory\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\base\DynamicModel;
use yii\web\Response;

use frontend\backend\inventory\models\StockOutSearch;

class DefaultController extends Controller
{
    public function actionIndex()
    {
		//PUBLIC PARAMS	
		$cari=['thn'=>'2018-02-06'];	
		$searchModel = new StockOutSearch($cari);
        $dataProvider = $searchModel->searchDayOfMonthStock(Yii::$app->request->queryParams);
        print_r($dataProvider);
	    //return $this->render('index');
		//return $dataProvider;
    }
	
	
}

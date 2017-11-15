<?php

namespace frontend\backend\inventory\controllers;

use Yii;
use yii\web\Controller;
use frontend\backend\inventory\models\StockOutSearch;

class StockProductController extends Controller
{
    public function actionIndex()
    {
		
		$searchModel = new StockOutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

<?php

namespace frontend\backend\inventory\controllers;

use yii\web\Controller;

class StockClosingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

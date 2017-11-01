<?php

namespace frontend\backend\inventory\controllers;

use yii\web\Controller;

class StockProductController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

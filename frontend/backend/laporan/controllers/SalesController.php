<?php

namespace frontend\backend\laporan\controllers;

use yii\web\Controller;

class SalesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

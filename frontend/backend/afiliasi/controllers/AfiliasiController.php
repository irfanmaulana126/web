<?php

namespace frontend\backend\afiliasi\controllers;

use yii\web\Controller;

class AfiliasiController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

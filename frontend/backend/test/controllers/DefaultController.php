<?php

namespace frontend\backend\test\controllers;

use yii\web\Controller;
use frontend\backend\master\models\Industry;

class DefaultController extends Controller
{
    public function actionIndex()
    {
		 $model = new Industry();
        return $this->render('index',['model'=>$model]);
    }
}

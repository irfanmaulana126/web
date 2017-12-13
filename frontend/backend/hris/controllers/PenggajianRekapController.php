<?php

namespace frontend\backend\hris\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\backend\hris\models\PenggajianRekapSearch;


class PenggajianRekapController extends Controller
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HrdAbsenRekap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenggajianRekapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		// print_r($dataProvider);
		// die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}

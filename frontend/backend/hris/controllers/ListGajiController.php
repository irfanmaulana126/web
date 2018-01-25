<?php

namespace frontend\backend\hris\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use ptrnov\postman4excel\Postman4ExcelBehavior;
use frontend\backend\hris\models\Karyawan;
use frontend\backend\hris\models\KaryawanSearch;

class ListGajiController extends Controller
{
    public function behaviors()
    {
        return [
			/*EXCEl IMPORT*/
			'export4excel' => [
				'class' => Postman4ExcelBehavior::className(),
				'widgetType'=>'download',
			], 
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {	
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new KaryawanSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAcc($ID,$STORE_ID,$KARYAWAN_ID,$YEAR_AT,$MONTH_AT)
    {
        $model= Karyawan::findOne(['ID' => $ID, 'STORE_ID' => $STORE_ID, 'KARYAWAN_ID' => $KARYAWAN_ID, 'YEAR_AT' => $YEAR_AT, 'MONTH_AT' => $MONTH_AT]);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                // print_r($model);die();
                // $model->UPAH_HARIAN =Yii::$app->request->post('karyawan-upah_harian-disp');
                // $tes = Yii::$app->request->post('STT_POT_TELAT');
                // print_r($model);die();
                $model->save(false);
                return $this->redirect(['index']);
            }
        } else {
            return $this->renderAjax('form_acc', [
                'model' => $model,
            ]);
        }
        
    }
}

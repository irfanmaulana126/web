<?php

namespace frontend\backend\hris\controllers;

use Yii;
use frontend\backend\hris\models\HrdAbsenIzin;
use frontend\backend\hris\models\HrdAbsenIzinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HrdAbsenIzinController implements the CRUD actions for HrdAbsenIzin model.
 */
class HrdAbsenIzinController extends Controller
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
     * Lists all HrdAbsenIzin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HrdAbsenIzinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HrdAbsenIzin model.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionView($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT),
        ]);
    }

    /**
     * Creates a new HrdAbsenIzin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HrdAbsenIzin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HrdAbsenIzin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionUpdate($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        $model = $this->findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HrdAbsenIzin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionDelete($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        $this->findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HrdAbsenIzin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $KARYAWAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return HrdAbsenIzin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID, $STORE_ID, $KARYAWAN_ID, $YEAR_AT, $MONTH_AT)
    {
        if (($model = HrdAbsenIzin::findOne(['ID' => $ID, 'STORE_ID' => $STORE_ID, 'KARYAWAN_ID' => $KARYAWAN_ID, 'YEAR_AT' => $YEAR_AT, 'MONTH_AT' => $MONTH_AT])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

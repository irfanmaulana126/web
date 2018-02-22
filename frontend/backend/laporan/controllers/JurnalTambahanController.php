<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use frontend\backend\laporan\models\JurnalTambahan;
use frontend\backend\laporan\models\JurnalTambahanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JurnalTambahanController implements the CRUD actions for JurnalTambahan model.
 */
class JurnalTambahanController extends Controller
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
     * Lists all JurnalTambahan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JurnalTambahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JurnalTambahan model.
     * @param string $JURNAL_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($JURNAL_ID, $MONTH_AT, $YEAR_AT)
    {
        return $this->render('view', [
            'model' => $this->findModel($JURNAL_ID, $MONTH_AT, $YEAR_AT),
        ]);
    }

    /**
     * Creates a new JurnalTambahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JurnalTambahan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JurnalTambahan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $JURNAL_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($JURNAL_ID, $MONTH_AT, $YEAR_AT)
    {
        $model = $this->findModel($JURNAL_ID, $MONTH_AT, $YEAR_AT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JurnalTambahan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $JURNAL_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($JURNAL_ID, $MONTH_AT, $YEAR_AT)
    {
        $this->findModel($JURNAL_ID, $MONTH_AT, $YEAR_AT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JurnalTambahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $JURNAL_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return JurnalTambahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($JURNAL_ID, $MONTH_AT, $YEAR_AT)
    {
        if (($model = JurnalTambahan::findOne(['JURNAL_ID' => $JURNAL_ID, 'MONTH_AT' => $MONTH_AT, 'YEAR_AT' => $YEAR_AT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

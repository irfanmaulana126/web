<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use frontend\backend\laporan\models\TransStoran;
use frontend\backend\laporan\models\TransStoranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransStoranController implements the CRUD actions for TransStoran model.
 */
class TransStoranController extends Controller
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
     * Lists all TransStoran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransStoranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransStoran model.
     * @param string $ID
     * @param string $OPENCLOSE_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionView($ID, $OPENCLOSE_ID, $YEAR_AT, $MONTH_AT)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID, $OPENCLOSE_ID, $YEAR_AT, $MONTH_AT),
        ]);
    }

    /**
     * Creates a new TransStoran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransStoran();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'OPENCLOSE_ID' => $model->OPENCLOSE_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TransStoran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID
     * @param string $OPENCLOSE_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionUpdate($ID, $OPENCLOSE_ID, $YEAR_AT, $MONTH_AT)
    {
        $model = $this->findModel($ID, $OPENCLOSE_ID, $YEAR_AT, $MONTH_AT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'OPENCLOSE_ID' => $model->OPENCLOSE_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TransStoran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID
     * @param string $OPENCLOSE_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     */
    public function actionDelete($ID, $OPENCLOSE_ID, $YEAR_AT, $MONTH_AT)
    {
        $this->findModel($ID, $OPENCLOSE_ID, $YEAR_AT, $MONTH_AT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransStoran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID
     * @param string $OPENCLOSE_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return TransStoran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID, $OPENCLOSE_ID, $YEAR_AT, $MONTH_AT)
    {
        if (($model = TransStoran::findOne(['ID' => $ID, 'OPENCLOSE_ID' => $OPENCLOSE_ID, 'YEAR_AT' => $YEAR_AT, 'MONTH_AT' => $MONTH_AT])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

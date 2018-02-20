<?php

namespace frontend\backend\inventory\controllers;

use Yii;
use frontend\backend\inventory\models\ProductStockClosing;
use frontend\backend\inventory\models\ProductStockClosingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductStockClosingController implements the CRUD actions for ProductStockClosing model.
 */
class ProductStockClosingController extends Controller
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
     * Lists all ProductStockClosing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductStockClosingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductStockClosing model.
     * @param string $UNIX_BULAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($UNIX_BULAN_ID, $YEAR_AT, $MONTH_AT)
    {
        return $this->render('view', [
            'model' => $this->findModel($UNIX_BULAN_ID, $YEAR_AT, $MONTH_AT),
        ]);
    }

    /**
     * Creates a new ProductStockClosing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductStockClosing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UNIX_BULAN_ID' => $model->UNIX_BULAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductStockClosing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $UNIX_BULAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($UNIX_BULAN_ID, $YEAR_AT, $MONTH_AT)
    {
        $model = $this->findModel($UNIX_BULAN_ID, $YEAR_AT, $MONTH_AT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'UNIX_BULAN_ID' => $model->UNIX_BULAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductStockClosing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $UNIX_BULAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($UNIX_BULAN_ID, $YEAR_AT, $MONTH_AT)
    {
        $this->findModel($UNIX_BULAN_ID, $YEAR_AT, $MONTH_AT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductStockClosing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $UNIX_BULAN_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return ProductStockClosing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($UNIX_BULAN_ID, $YEAR_AT, $MONTH_AT)
    {
        if (($model = ProductStockClosing::findOne(['UNIX_BULAN_ID' => $UNIX_BULAN_ID, 'YEAR_AT' => $YEAR_AT, 'MONTH_AT' => $MONTH_AT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

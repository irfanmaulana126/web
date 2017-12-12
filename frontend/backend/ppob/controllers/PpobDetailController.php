<?php

namespace frontend\backend\ppob\controllers;

use Yii;
use frontend\backend\ppob\models\PpobDetail;
use frontend\backend\ppob\models\PpobDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PpobDetailController implements the CRUD actions for PpobDetail model.
 */
class PpobDetailController extends Controller
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
     * Lists all PpobDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PpobDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PpobDetail model.
     * @param string $ID
     * @param string $DETAIL_ID
     * @param string $HEADER_ID
     * @param string $PROVIDER_ID
     * @return mixed
     */
    public function actionView($ID, $DETAIL_ID, $HEADER_ID, $PROVIDER_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID, $DETAIL_ID, $HEADER_ID, $PROVIDER_ID),
        ]);
    }

    /**
     * Creates a new PpobDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PpobDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'DETAIL_ID' => $model->DETAIL_ID, 'HEADER_ID' => $model->HEADER_ID, 'PROVIDER_ID' => $model->PROVIDER_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PpobDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID
     * @param string $DETAIL_ID
     * @param string $HEADER_ID
     * @param string $PROVIDER_ID
     * @return mixed
     */
    public function actionUpdate($ID, $DETAIL_ID, $HEADER_ID, $PROVIDER_ID)
    {
        $model = $this->findModel($ID, $DETAIL_ID, $HEADER_ID, $PROVIDER_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'DETAIL_ID' => $model->DETAIL_ID, 'HEADER_ID' => $model->HEADER_ID, 'PROVIDER_ID' => $model->PROVIDER_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PpobDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID
     * @param string $DETAIL_ID
     * @param string $HEADER_ID
     * @param string $PROVIDER_ID
     * @return mixed
     */
    public function actionDelete($ID, $DETAIL_ID, $HEADER_ID, $PROVIDER_ID)
    {
        $this->findModel($ID, $DETAIL_ID, $HEADER_ID, $PROVIDER_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PpobDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID
     * @param string $DETAIL_ID
     * @param string $HEADER_ID
     * @param string $PROVIDER_ID
     * @return PpobDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID, $DETAIL_ID, $HEADER_ID, $PROVIDER_ID)
    {
        if (($model = PpobDetail::findOne(['ID' => $ID, 'DETAIL_ID' => $DETAIL_ID, 'HEADER_ID' => $HEADER_ID, 'PROVIDER_ID' => $PROVIDER_ID])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use frontend\backend\laporan\models\JurnalTemplateDetail;
use frontend\backend\laporan\models\JurnalTemplateDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JurnalTemplateDetailController implements the CRUD actions for JurnalTemplateDetail model.
 */
class JurnalTemplateDetailController extends Controller
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
     * Lists all JurnalTemplateDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JurnalTemplateDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JurnalTemplateDetail model.
     * @param string $RPT_DETAIL_ID
     * @param string $AKUN_CODE
     * @param integer $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($RPT_DETAIL_ID, $AKUN_CODE, $RPT_TITLE_ID, $RPT_GROUP_ID, $MONTH_AT, $YEAR_AT)
    {
        return $this->render('view', [
            'model' => $this->findModel($RPT_DETAIL_ID, $AKUN_CODE, $RPT_TITLE_ID, $RPT_GROUP_ID, $MONTH_AT, $YEAR_AT),
        ]);
    }

    /**
     * Creates a new JurnalTemplateDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JurnalTemplateDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'RPT_DETAIL_ID' => $model->RPT_DETAIL_ID, 'AKUN_CODE' => $model->AKUN_CODE, 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JurnalTemplateDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $RPT_DETAIL_ID
     * @param string $AKUN_CODE
     * @param integer $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($RPT_DETAIL_ID, $AKUN_CODE, $RPT_TITLE_ID, $RPT_GROUP_ID, $MONTH_AT, $YEAR_AT)
    {
        $model = $this->findModel($RPT_DETAIL_ID, $AKUN_CODE, $RPT_TITLE_ID, $RPT_GROUP_ID, $MONTH_AT, $YEAR_AT);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'RPT_DETAIL_ID' => $model->RPT_DETAIL_ID, 'AKUN_CODE' => $model->AKUN_CODE, 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JurnalTemplateDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $RPT_DETAIL_ID
     * @param string $AKUN_CODE
     * @param integer $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($RPT_DETAIL_ID, $AKUN_CODE, $RPT_TITLE_ID, $RPT_GROUP_ID, $MONTH_AT, $YEAR_AT)
    {
        $this->findModel($RPT_DETAIL_ID, $AKUN_CODE, $RPT_TITLE_ID, $RPT_GROUP_ID, $MONTH_AT, $YEAR_AT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JurnalTemplateDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $RPT_DETAIL_ID
     * @param string $AKUN_CODE
     * @param integer $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @param integer $MONTH_AT
     * @param integer $YEAR_AT
     * @return JurnalTemplateDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($RPT_DETAIL_ID, $AKUN_CODE, $RPT_TITLE_ID, $RPT_GROUP_ID, $MONTH_AT, $YEAR_AT)
    {
        if (($model = JurnalTemplateDetail::findOne(['RPT_DETAIL_ID' => $RPT_DETAIL_ID, 'AKUN_CODE' => $AKUN_CODE, 'RPT_TITLE_ID' => $RPT_TITLE_ID, 'RPT_GROUP_ID' => $RPT_GROUP_ID, 'MONTH_AT' => $MONTH_AT, 'YEAR_AT' => $YEAR_AT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

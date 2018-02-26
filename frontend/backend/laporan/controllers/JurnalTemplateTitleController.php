<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use frontend\backend\laporan\models\JurnalTemplateTitle;
use frontend\backend\laporan\models\JurnalTemplateTitleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JurnalTemplateTitleController implements the CRUD actions for JurnalTemplateTitle model.
 */
class JurnalTemplateTitleController extends Controller
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
     * Lists all JurnalTemplateTitle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JurnalTemplateTitleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JurnalTemplateTitle model.
     * @param string $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($RPT_TITLE_ID, $RPT_GROUP_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($RPT_TITLE_ID, $RPT_GROUP_ID),
        ]);
    }

    /**
     * Creates a new JurnalTemplateTitle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new JurnalTemplateTitle();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JurnalTemplateTitle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($RPT_TITLE_ID, $RPT_GROUP_ID)
    {
        $model = $this->findModel($RPT_TITLE_ID, $RPT_GROUP_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JurnalTemplateTitle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($RPT_TITLE_ID, $RPT_GROUP_ID)
    {
        $this->findModel($RPT_TITLE_ID, $RPT_GROUP_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JurnalTemplateTitle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $RPT_TITLE_ID
     * @param integer $RPT_GROUP_ID
     * @return JurnalTemplateTitle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($RPT_TITLE_ID, $RPT_GROUP_ID)
    {
        if (($model = JurnalTemplateTitle::findOne(['RPT_TITLE_ID' => $RPT_TITLE_ID, 'RPT_GROUP_ID' => $RPT_GROUP_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

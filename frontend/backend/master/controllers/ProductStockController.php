<?php

namespace frontend\backend\master\controllers;

use Yii;
use frontend\backend\master\models\ProductStock;
use frontend\backend\master\models\ProductStockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductStockController implements the CRUD actions for ProductStock model.
 */
class ProductStockController extends Controller
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
	public function beforeAction($action){
        $modulIndentify=4; //OUTLET
       // Check only when the user is logged in.
       // Author piter Novian [ptr.nov@gmail.com].
       if (!Yii::$app->user->isGuest){
           if (Yii::$app->session['userSessionTimeout']< time() ) {
               // timeout
               Yii::$app->user->logout();
               return $this->goHome(); 
           } else {	
               //add Session.
               Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
               //check validation [access/url].
               $checkAccess=Yii::$app->getUserOpt->UserMenuPermission($modulIndentify);
               if($checkAccess['modulMenu']['MODUL_STS']==0 OR $checkAccess['ModulPermission']['STATUS']==0){				
                   $this->redirect(array('/site/alert'));
               }else{
                   if($checkAccess['PageViewUrl']==true){						
                       return true;
                   }else{
                       $this->redirect(array('/site/alert'));
                   }					
               }			 
           }
       }else{
           Yii::$app->user->logout();
           return $this->goHome(); 
       }
   }
    /**
     * Lists all ProductStock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductStockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductStock model.
     * @param string $ID
     * @param string $PRODUCT_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT),
        ]);
    }

    /**
     * Creates a new ProductStock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductStock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'PRODUCT_ID' => $model->PRODUCT_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductStock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID
     * @param string $PRODUCT_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT)
    {
        $model = $this->findModel($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT);
        $models = Product::find()->where(['PRODUCT_ID'=>$PRODUCT_ID])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'PRODUCT_ID' => $model->PRODUCT_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductStock model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID
     * @param string $PRODUCT_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT)
    {
        $this->findModel($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductStock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID
     * @param string $PRODUCT_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return ProductStock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT)
    {
        if (($model = ProductStock::findOne(['ID' => $ID, 'PRODUCT_ID' => $PRODUCT_ID, 'YEAR_AT' => $YEAR_AT, 'MONTH_AT' => $MONTH_AT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace frontend\backend\master\controllers;

use Yii;
use frontend\backend\master\models\ProductGroup;
use frontend\backend\master\models\ProductGroupSearch;
use frontend\backend\master\models\Store;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductGroupController implements the CRUD actions for ProductGroup model.
 */
class ProductGroupController extends Controller
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
     * Lists all ProductGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductGroup model.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $GROUP_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID, $STORE_ID, $GROUP_ID, $YEAR_AT, $MONTH_AT)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($ID, $STORE_ID, $GROUP_ID, $YEAR_AT, $MONTH_AT),
        ]);
    }

    /**
     * Creates a new ProductGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGroup();
        if ($model->load(Yii::$app->request->post())) {
            $model->GROUP_NM=strtoupper($model->GROUP_NM);   
            $model->save(false);
            $models = Store::find()->where(['STORE_ID'=>$model->STORE_ID])->one();
            Yii::$app->session->setFlash('success', "Produk Group untuk Store <b>".$models->STORE_NM."</b> Berhasil Buat");
            return $this->redirect(array('/master/data-barang/index-group'));
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $GROUP_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID, $STORE_ID, $GROUP_ID, $YEAR_AT, $MONTH_AT)
    {
        $model = $this->findModel($ID, $STORE_ID, $GROUP_ID, $YEAR_AT, $MONTH_AT);
        $models = Store::find()->where(['STORE_ID'=>$STORE_ID])->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->GROUP_NM=strtoupper($model->GROUP_NM);      
            $model->save(false);      
            Yii::$app->session->setFlash('success', "Produk Group untuk Store <b>".$models->STORE_NM."</b> Berhasil ubah");
            return $this->redirect(array('/master/data-barang/index-group'));
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $GROUP_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID, $STORE_ID, $GROUP_ID, $YEAR_AT, $MONTH_AT)
    {
        $model = $this->findModel($ID, $STORE_ID, $GROUP_ID, $YEAR_AT, $MONTH_AT);
        $models = Store::find()->where(['STORE_ID'=>$STORE_ID])->one();
        $model->STATUS ="3";
        $model->update();

        Yii::$app->session->setFlash('error', "Produk Group untuk Store <b>".$models->STORE_NM."</b> Berhasil dihapus");
        return $this->redirect(array('/master/data-barang/index-group'));
    }
    /**
     * Finds the ProductGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID
     * @param string $STORE_ID
     * @param string $GROUP_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return ProductGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID, $STORE_ID, $GROUP_ID, $YEAR_AT, $MONTH_AT)
    {
        if (($model = ProductGroup::findOne(['ID' => $ID, 'STORE_ID' => $STORE_ID, 'GROUP_ID' => $GROUP_ID, 'YEAR_AT' => $YEAR_AT, 'MONTH_AT' => $MONTH_AT])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

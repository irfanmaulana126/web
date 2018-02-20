<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\helpers\view;

use common\models\Store;
use frontend\backend\master\models\Item;
use frontend\backend\master\models\ProductSearch;
use frontend\backend\master\models\ItemFdiscount;
use frontend\backend\master\models\ItemFdiscountSearch;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class FormulaController extends Controller
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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {		
		$paramCari=Yii::$app->getRequest()->getQueryParam('store_id');
        $paramCariItem=Yii::$app->getRequest()->getQueryParam('store_id');
        
		$modelOutlet=Store::find()->where(['STORE_ID'=>$paramCari])->one();//->andWhere('FIND_IN_SET("'.$this->ACCESS_UNIX.'", ACCESS_UNIX)')->one();
		if($modelOutlet){
		    $searchModel = new ProductSearch(['STORE_ID'=>$paramCari]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);			
		// print_r($dataProvider);die();
			///OUTLET ID.
		
			return $this->render('index', [
				'outletNm'=>$modelOutlet!=''?$modelOutlet->STORE_NM:'none',
				'searchModel' => $searchModel!=''?$searchModel:false,
				'dataProvider' => $dataProvider,
				'paramCariOutlet'=>$paramCari,
				'paramCariItem'=>$paramCariItem
			]);
		}else{
			$this->redirect(array('/site/alert'));
		}
    }

    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateHarga()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->renderAjax('_formHarga', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionCreateDiscount()
    {
        $model = new ItemFdiscount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->renderAjax('_formDiscount', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}

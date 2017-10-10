<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;
use yii\web\Request;
use common\models\Store;
use common\models\StoreSearch;
// use common\models\LocateKota;

class StoreController extends Controller
{
	 public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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

	public function actionIndex()
    {
		
		$searchModel = new StoreSearch();
        $dataProvider = $searchModel->searchUserStore(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
       //return 'asd';
    }
	
	/**
     * Displays a single Store model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model =  $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->ID]);
            return $this->redirect(['index']);
        } else {
           return $this->renderAjax('view', [
                'model' => $model,
            ]);
        }
    }
	
	/**
     * Displays a single Store model.
     * @param integer $id
     * @return mixed
     */
    public function actionReview($id)
    {
    	$model =  $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->ID]);
            return $this->redirect(['index']);
        } else {
           return $this->renderAjax('review', [
                'model' => $model,
            ]);
        }
    }
	
	/**
     * Depdrop Sub Kota - depedence Province
     * @author Piter
     * @since 1.1.0
     * @return mixed
     */
   public function actionKotaSub() {
    $out = [];
		if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$id = $parents[0];
				$model = LocateKota::find()->asArray()->where(['PROVINCE_ID'=>$id])->all();														
														
				foreach ($model as $key => $value) {
				   $out[] = ['id'=>$value['CITY_ID'],'name'=> $value['CITY_NAME']];
			    } 
				echo json_encode(['output'=>$out, 'selected'=>'']);
				return;
           }
       }
       echo Json::encode(['output'=>'', 'selected'=>'']);
   }
   
	protected function findModel($id)
    {
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionExpandDetail() {
		$id=$_POST['expandRowKey'];		
		if($id==0){ 
			//== Detail Toko ==
			//$modelToko=Store::find()->where(['STORE_ID'=>])->all();
			return $this->renderPartial('_detailToko',[
				//'data'=>$_POST['expandRowKey'],
				//'modelToko'=>$modelToko
			]);
		}elseif($id==1){
			//== Detail Prodak==
			return $this->renderPartial('_detailProduk',['data'=>$_POST['expandRowKey']]);
		}elseif($id==2){
			//== Detail Pelanggan==
			return $this->renderPartial('_detailPelanggan',['data'=>$_POST['expandRowKey']]);
		}elseif($id==3){
			//== Detail Karyawan==
			return $this->renderPartial('_detailkaryawan',['data'=>$_POST['expandRowKey']]);
		}elseif($id==4){
			//== Detail User Operatioal==
			return $this->renderPartial('_detailUserOps',['data'=>$_POST['expandRowKey']]);
		}
		// if (isset($_POST['expandRowKey'])) {
			// $model = \app\models\Book::findOne($_POST['expandRowKey']);
			// return $this->renderPartial('_book-details', ['model'=>$model]);
		// } else {
			// return '<div class="alert alert-danger">No data found</div>';
		// }
		
		
	}
}

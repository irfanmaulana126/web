<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use yii\web\Controller;
use frontend\backend\laporan\models\TransOpenclose;
use frontend\backend\laporan\models\TransOpencloseSearch;
use frontend\backend\laporan\models\TransStoranImage;

class MutasiController extends Controller
{
    public function actionIndex()
    {

		$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
        $searchModel = new TransOpencloseSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // print_r($dataProvider);die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'paramCari'=>$paramCari
        ]);
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
	 * IMAGE - DETAIL DISPLY 
	 * @author Piter Novian [ptr.nov@gmail.com]
	 * @since 2.0
	*/
	public function actionDisplyImage($id)
    {
		//print_r($tgl);
		//die();
		// $searchModelViewImg = new CustomercallTimevisitSearch(['TGL'=>$tgl,'USER_ID'=>$user_id]);
		// $dataProviderViewImg=$searchModelViewImg->search(Yii::$app->request->queryParams);
		// $listImg=$dataProviderViewImg->getModels();
		//if (Yii::$app->request->isAjax) {
			// $request= Yii::$app->request;
			// $id=$request->post('id');
			// $roDetail = Purchasedetail::findOne($id);
			// $roDetail->STATUS = 3;
			// $roDetail->save();
			// return true;
			// $model = new \yii\base\DynamicModel(['tanggal']);
			// $model->addRule(['tanggal'], 'safe');
			$modelStoran= TransStoranImage::find()->where(['OPENCLOSE_ID'=>$id])->one();
			// print_r($modelStoran);die();
			return $this->renderAjax('_viewImageModal',[
				'model'=>$modelStoran
			]);
			
		//}
    }
}

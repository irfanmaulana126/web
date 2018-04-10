<?php

namespace frontend\backend\payment\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\backend\sistem\models\Corp;
use frontend\backend\sistem\models\CorpSearch;
use frontend\backend\sistem\models\CorpImage;
use frontend\backend\sistem\models\CorpImageSearch;
use frontend\backend\sistem\models\DompetRekening;
use frontend\backend\sistem\models\DompetRekeningSearch;
use frontend\backend\sistem\models\DompetRekeningImage;
use frontend\backend\sistem\models\DompetRekeningImageSearch;
use frontend\backend\payment\models\StoreKasir;
use frontend\backend\payment\models\StoreKasirSearch;
use yii\helpers\Json;
use yii\web\Response;

class DefaultController extends Controller
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
    public function actionIndex()
    {
       
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $userID = (empty(Yii::$app->user->identity->ACCESS_ID)) ? '' : Yii::$app->user->identity->ACCESS_ID;

        $modelcorp = Corp::find()->where(['ACCESS_ID'=>$userID])->one();
        $modelcorpImg = CorpImage::find()->where(['ACCESS_ID'=>$modelcorp['ACCESS_ID']])->one();

        $modelRek = DompetRekening::findOne(['ACCESS_GROUP'=>$user]);
        $modelRekImg = DompetRekeningImage::findOne(['ACCESS_GROUP'=>$user]);
        if (empty($modelRek) && empty($modelRekImg)) {
            $modelRek = new DompetRekening();
            $modelRekImg = new DompetRekeningImage();
        }
        // print_r($modelcorpImg);die();
        if(empty($modelcorpImg)){
            $modelcorpImg = new CorpImage();
        }

        $searchModelperangkat = new StoreKasirSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderperangkat = $searchModelperangkat->search(Yii::$app->request->queryParams);
        
        if (Yii::$app->request->post('hasEditable')) {
            $settingId=\Yii::$app->request->post('editableKey');
            Yii::$app->response->format = Response::FORMAT_JSON;

                if (!empty($_POST['StoreKasir'])) {
                        $data = json_decode($settingId, true);
                        $setting = StoreKasir::find()->where(['KASIR_ID'=>$settingId])->one();
            
                        $out= Json::encode(['output'=>'','message'=>'']);
                        $post = [];
                        $posted = current($_POST['StoreKasir']);
                        $post['StoreKasir'] = $posted;
                        if ($setting->load($post)) { 
                            if($setting->KASIR_STT==0){
                                $setting->KASIR_STT=2;
                            }
                            $setting->save();
                            $output = $setting->KASIR_STT;
                        }
                    }
            
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
        return $this->render('index', [
            'modelcorp' => $modelcorp,
            'modelcorpImg' => $modelcorpImg,
            'modelRek' => $modelRek,
            'modelRekImg' => $modelRekImg,
            'modelRekImg' => $modelRekImg,
            'searchModelperangkat' => $searchModelperangkat,
            'dataProviderperangkat' => $dataProviderperangkat,
        ]);
    }
}

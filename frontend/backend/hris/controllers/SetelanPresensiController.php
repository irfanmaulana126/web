<?php

namespace frontend\backend\hris\controllers;
use Yii;
use frontend\backend\hris\models\HrdSettingIzin;
use frontend\backend\hris\models\HrdSettingIzinSearch;
use frontend\backend\hris\models\HrdSettingJamkerja;
use frontend\backend\hris\models\HrdSettingJamkerjaSearch;
use frontend\backend\hris\models\HrdSettingPeriode;
use frontend\backend\hris\models\HrdSettingPeriodeSearch;
use frontend\backend\hris\models\HrdSettingPot;
use frontend\backend\hris\models\HrdSettingPotSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SetelanPresensiController extends Controller
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
        
        $searchModelIzin = new HrdSettingIzinSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderIzin = $searchModelIzin->search(Yii::$app->request->queryParams);
        $searchModelJam = new HrdSettingJamkerjaSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderJam = $searchModelJam->search(Yii::$app->request->queryParams);
        $searchModelPeriode = new HrdSettingPeriodeSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderPeriode = $searchModelPeriode->search(Yii::$app->request->queryParams);
        $searchModelPot = new HrdSettingPotSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderPot = $searchModelPot->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModelIzin' => $searchModelIzin,
            'dataProviderIzin' => $dataProviderIzin,
            'searchModelJam' => $searchModelJam,
            'dataProviderJam' => $dataProviderJam,
            'searchModelPeriode' => $searchModelPeriode,
            'dataProviderPeriode' => $dataProviderPeriode,
            'searchModelPot' => $searchModelPot,
            'dataProviderPot' => $dataProviderPot,
        ]);
    }
    public function actionShift($STORE_ID,$ACCESS_GROUP)
    {
        $model = new HrdSettingJamkerja(['ACCESS_GROUP'=>$ACCESS_GROUP,'STORE_ID'=>$STORE_ID]);
        $data = HrdSettingJamkerja::find()->where(['ACCESS_GROUP'=>$ACCESS_GROUP,'STORE_ID'=>$STORE_ID])->all();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        } else {
            return $this->renderAjax('_form_jam',[
                'model'=>$model,
                'data'=>$data
            ]);
        }
    }
}

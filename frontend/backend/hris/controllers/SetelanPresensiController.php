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
use yii\helpers\Json;
use yii\web\Response;


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

        if (Yii::$app->request->post('hasEditable')) {
            $settingId=\Yii::$app->request->post('editableKey');
            Yii::$app->response->format = Response::FORMAT_JSON;

            $data = json_decode($settingId, true);
            $SHIFT1 = HrdSettingJamkerja::find()->where(['STORE_ID'=>$data['STORE_ID'],'YEAR_AT'=>$data['YEAR_AT'],'MONTH_AT'=>$data['MONTH_AT'],'SHIFT_ID'=>1])->one();
            $SHIFT2 = HrdSettingJamkerja::find()->where(['STORE_ID'=>$data['STORE_ID'],'YEAR_AT'=>$data['YEAR_AT'],'MONTH_AT'=>$data['MONTH_AT'],'SHIFT_ID'=>2])->one();
            $SHIFT3 = HrdSettingJamkerja::find()->where(['STORE_ID'=>$data['STORE_ID'],'YEAR_AT'=>$data['YEAR_AT'],'MONTH_AT'=>$data['MONTH_AT'],'SHIFT_ID'=>3])->one();
            $SHIFTEDIT = HrdSettingJamkerja::find()->where(['ID'=>$data['ID'],'STORE_ID'=>$data['STORE_ID'],'YEAR_AT'=>$data['YEAR_AT'],'MONTH_AT'=>$data['MONTH_AT']])->one();
           
            if ($SHIFTEDIT['SHIFT_ID']==$SHIFT1['SHIFT_ID']) {
                if ($SHIFTEDIT['SHIFT_OUT']>=$SHIFT2['SHIFT_IN'] && $SHIFTEDIT['SHIFT_OUT']<=$SHIFT3['SHIFT_IN']) {
                    $uji=1;
                } else {
                    $uji=0;
                }
            }else if ($SHIFTEDIT['SHIFT_ID']==$SHIFT2['SHIFT_ID']) {
                if ($SHIFTEDIT['SHIFT_OUT']>=$SHIFT3['SHIFT_IN'] && $SHIFTEDIT['SHIFT_OUT']<=$SHIFT1['SHIFT_IN']) {
                    $uji=1;
                } else {
                    $uji=0;
                }
            }else if ($SHIFTEDIT['SHIFT_ID']==$SHIFT3['SHIFT_ID']) {
                if ($SHIFTEDIT['SHIFT_OUT']>=$SHIFT1['SHIFT_IN'] && $SHIFTEDIT['SHIFT_OUT']<=$SHIFT2['SHIFT_IN']) {
                    $uji=1;
                } else {
                    $uji=0;
                }
            }          
                if (!empty($_POST['HrdSettingIzin'])) {
                        $data = json_decode($settingId, true);
                        $setting = HrdSettingIzin::find()->where(['ID'=>$data['ID'],'STORE_ID'=>$data['STORE_ID'],'YEAR_AT'=>$data['YEAR_AT'],'MONTH_AT'=>$data['MONTH_AT']])->one();
            
                        $out= Json::encode(['output'=>'','message'=>'']);
                        $post = [];
                        $posted = current($_POST['HrdSettingIzin']);
                        $post['HrdSettingIzin'] = $posted;
                        if ($setting->load($post)) {
                            $setting->save();
                            $output = $setting->IZIN_STT;
                        }
                    }

            if ($uji==1) {
                if(!empty($_POST['HrdSettingJamkerja'])){
                    $data = json_decode($settingId, true);
                    $setting = HrdSettingJamkerja::find()->where(['ID'=>$data['ID'],'STORE_ID'=>$data['STORE_ID'],'YEAR_AT'=>$data['YEAR_AT'],'MONTH_AT'=>$data['MONTH_AT']])->one();
        
                    $out= Json::encode(['output'=>'','message'=>'']);
                    $post = [];
                    $posted = current($_POST['HrdSettingJamkerja']);
                    $post['HrdSettingJamkerja'] = $posted;
                    if ($setting->load($post)) {
                        $setting->save();
                        $output = $setting->STATUS;
                    }
                }
            }
             else {
                Yii::$app->session->setFlash('error', "ERROR");
                $this->redirect(array('/hris/setelan-presensi#w14-tab1'));
            }
            
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
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
    public function actionShift($ID,$STORE_ID,$ACCESS_GROUP)
    {
        $model = HrdSettingJamkerja::findOne(['ID'=>$ID,'ACCESS_GROUP'=>$ACCESS_GROUP,'STORE_ID'=>$STORE_ID]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/hris/setelan-presensi#w14-tab1']);
        } else {
            return $this->renderAjax('_form_jam',[
                'model'=>$model
            ]);
        }
    }
    public function actionPeriode($ID)
    {
        $model = HrdSettingPeriode::findOne(['ID'=>$ID]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/hris/setelan-presensi#w14-tab2']);
        } else {
            return $this->renderAjax('_form_periode', [
                'model' => $model,
            ]);
        }
    }
    public function actionPotongan($ID)
    {
        $model = HrdSettingPot::findOne(['ID'=>$ID]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/hris/setelan-presensi#w14-tab3']);
        } else {
            return $this->renderAjax('_form_potongan', [
                'model' => $model,
            ]);
        }
    }
}

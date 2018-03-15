<?php

namespace frontend\backend\hris\controllers;

use Yii;
use frontend\backend\hris\models\KaryawanSearch;
use frontend\backend\hris\models\HrdSettingIzin;
use frontend\backend\hris\models\HrdSettingIzinSearch;
use frontend\backend\hris\models\HrdSettingJamkerja;
use frontend\backend\hris\models\HrdSettingJamkerjaSearch;
use frontend\backend\hris\models\HrdSettingPeriode;
use frontend\backend\hris\models\HrdSettingPeriodeSearch;
use frontend\backend\hris\models\HrdSettingPot;
use frontend\backend\hris\models\HrdSettingPotSearch;
use frontend\backend\hris\models\AbsenRekapSearch;
use frontend\backend\hris\models\PenggajianRekapSearch;
use frontend\backend\hris\models\StoreSearch;
class RekapController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionIndexKaryawan()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new KaryawanSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/karyawan/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexGaji()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new KaryawanSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/list-gaji/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexPresensi()
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
                if ($SHIFTEDIT['SHIFT_OUT']<=$SHIFT1['SHIFT_IN'] && $SHIFTEDIT['SHIFT_OUT']<=$SHIFT2['SHIFT_IN']) {
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
                Yii::$app->session->setFlash('error', "Terdapat data shift yang tidak sesuia harap sesuai kan shift sebelumnya terlebih dahulu");
                $this->redirect(array('/hris/setelan-presensi#w14-tab1'));
            }
            
            $out = Json::encode(['output'=>$output, 'message'=>'']);
            echo $out;
            return;
        }
        return $this->render('/setelan-presensi/index', [
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
    public function actionIndexLog()
    {
        return $this->render('/log-presensi/index');
    }
    public function actionIndexAbsen()
    {
        $paramCari='';
		//PencarianIndex
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');			
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$hsl = \Yii::$app->request->post();	
			$paramCari=$hsl['DynamicModel']['TAHUNBULAN'];
		};		
		
		//PUBLIC PARAMS	
		$cari=['WAKTU_MASUK'=>$paramCari];	
		// print_r($cari);die();
		//DINAMIK MODEL PARAMS
        $searchModel = new AbsenRekapSearch($cari);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		// print_r($dataProvider);die();
		if(empty($dataProvider)){
			Yii::$app->session->setFlash('error', "Data Tidak ada");
			// $this->redirect(array('/inventory/stock-product'));
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				// 'paramCari'=>$paramCari
			]);
		}else{
			return $this->render('/absen-rekap/index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				// 'paramCari'=>$paramCari
			]);
		}
    }
    public function actionIndexPenggajian()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $tanggal='';

        $modelPeriode = new \yii\base\DynamicModel([
			'TAHUNBULAN','TAHUN','BULAN'
		]);		
		$modelPeriode->addRule(['TAHUNBULAN'], 'required')
         ->addRule(['TAHUNBULAN','TAHUN','BULAN'], 'safe');			
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$hsl = \Yii::$app->request->post();	
			$tanggal=$hsl['DynamicModel']['TAHUNBULAN'];
        };		
        
        $paramCari=Yii::$app->getRequest()->getQueryParam('storeid');
        if ($paramCari==''){
            $modelGrp =Yii::$app->db->createCommand("select * from hrd_absen_rekap where ACCESS_GROUP ='".$user."' ORDER BY STORE_ID ASC")->queryOne();
            $cari = ['STORE_ID'=>$modelGrp['STORE_ID']];
            $search = HrdSettingPeriode::findOne(['ACCESS_GROUP'=>$user,'STORE_ID'=>$modelGrp['STORE_ID']]);
            if ($tanggal=='') {
                $date1=date('Y-m');
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            } else {
                $date1=$tanggal;
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            }            
        }else{
            $cari = ['STORE_ID'=>$paramCari];
            $search = HrdSettingPeriode::findOne(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari]);
            if ($tanggal=='') {
                $date1=date('Y-m');
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            } else {
                $date1=$tanggal;
                $date2=date('Y-m',strtotime('-1 month', strtotime($date1)));
                $date=[
                    'tanggal1'=>$date1.'-'.$search['TGL1'],
                    'tanggal2'=>$date2.'-'.$search['TGL2']
                ];
                $searchModel = new PenggajianRekapSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$cari,$date);
            }
        }

        $searchModelstore = new StoreSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderstore = $searchModelstore->search(Yii::$app->request->queryParams);
        $modelGrp =Yii::$app->db->createCommand("select * from hrd_absen_rekap where ACCESS_GROUP ='".$user."' ORDER BY STORE_ID ASC")->queryOne();
        $store = (empty($paramCari)) ? $modelGrp['STORE_ID'] : $paramCari ;
		// print_r($dataProvider);
		// die();
        return $this->render('/penggajian-rekap/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderstore' => $dataProviderstore,
            'date'=>$date,
            'store'=>$store
        ]);
    }

}

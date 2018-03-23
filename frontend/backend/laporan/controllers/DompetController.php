<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use frontend\backend\laporan\models\DompetTransaksi;
use frontend\backend\laporan\models\DompetTransaksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use ptrnov\postman4excel\Postman4ExcelBehavior;
use common\models\Store;

/**
 * DompetTransaksiController implements the CRUD actions for DompetTransaksi model.
 */
class DompetController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'export4excel' => [
				'class' => Postman4ExcelBehavior::className(),
				//'downloadPath'=>Yii::getAlias('@lukisongroup').'/cronjob/',
				//'downloadPath'=>'/var/www/backup/ExternalData/',
				'widgetType'=>'download',
			], 
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
     * Lists all DompetTransaksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('tgl');
		if ($paramCari!=''){
			$ambilTgl=date('Y-n-d',strtotime($paramCari.'-01'));
			$cari=[
				'TAHUN'=>date('Y',strtotime($ambilTgl)),
				'BULAN'=>date('n',strtotime($ambilTgl)),
				'ACCESS_GROUP'=>$user
			];			
		}else{
			//$cari=date('Y-n');
			$cari=[
				'TAHUN'=>date('Y'),//'2018',
				'BULAN'=>date('n'),//'2'
				'ACCESS_GROUP'=>$user//'2'
			];
		};
        $searchModel = new DompetTransaksiSearch($cari);
        $dataProvider = $searchModel->searchDompet(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cari'=>$cari,
        ]);
    }
    public function actionStoreDompet()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('tgl');
		
		$paramCari2=Yii::$app->getRequest()->getQueryParam('store');
		if ($paramCari2!=''){	
			$stores=store::find()->where(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari2])->orderBy(['STATUS'=>SORT_ASC])->one();					
		}else{
			$stores=store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->one();				
		};
		if ($paramCari!=''){
			$ambilTgl=date('Y-n-d',strtotime($paramCari.'-01'));
			$cari=[
				'TAHUN'=>date('Y',strtotime($ambilTgl)),
				'BULAN'=>date('n',strtotime($ambilTgl)),
				'ACCESS_GROUP'=>$user,
				'STORE_ID'=>$stores->STORE_ID,
			];			
		}else{
			//$cari=date('Y-n');
			
			$cari=[
				'TAHUN'=>date('Y'),//'2018',
				'BULAN'=>date('n'),//'2'
				'ACCESS_GROUP'=>$user,//'2'
				'STORE_ID'=>$stores->STORE_ID,
			];
		};
        $searchModel = new DompetTransaksiSearch($cari);
        $dataProvider = $searchModel->searchDompetStore(Yii::$app->request->queryParams);

        return $this->render('index_store', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionArusKasCetakpdf()
    {
		$paramCari=Yii::$app->getRequest()->getQueryParam('tgl');
		if ($paramCari!=''){
			$ambilTgl=date('Y-n-d',strtotime($paramCari.'-01'));
			$cari=[
				'TAHUN'=>date('Y',strtotime($ambilTgl)),
				'BULAN'=>date('n',strtotime($ambilTgl))
			];			
		}else{
			$cari=[
				'TAHUN'=>'2018',
				'BULAN'=>'2'
			];
		};
		$searchModel = new LaporanArusKas($cari);
		$dataProvider = $searchModel->searchArusKeuangan(Yii::$app->request->queryParams);

		$content= $this->renderPartial( '/dompet/indexPdf', [
			'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>''
        ]);

		/*PR TO WAWAN*/
		/*
		 * Render partial -> Add Css -> Sendmail
		 * @author ptrnov [piter@lukison]
		 * @since 1.2
		*/
		// $contentMailAttach= $this->renderPartial('sendmailcontent',[
			// 'poHeader' => $poHeader,
			// 'dataProvider' => $dataProvider,
		// ]);

		// $contentMailAttachBody= $this->renderPartial('postman_body',[
			// 'poHeader' => $poHeader,
			// 'dataProvider' => $dataProvider,
		// ]);


		$pdf = new Pdf([
			// set to use core fonts only
			'mode' => Pdf::MODE_CORE,
			// A4 paper format
			'format' => Pdf::FORMAT_A4,
			// portrait orientation
			'orientation' => Pdf::ORIENT_PORTRAIT,
			// stream to browser inline
			'destination' => Pdf::DEST_BROWSER,
			//'destination' => Pdf::DEST_FILE ,
			// your html content input
			'content' => $content,
			// format content from your own css file if needed or use the
			// enhanced bootstrap css built by Krajee for mPDF formatting
			//D:\xampp\htdocs\advanced\lukisongroup\web\widget\pdf-asset
			//'cssFile' => '@frontend/web/template/pdf-asset/kv-mpdf-bootstrap.min.css',
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			// any css to be embedded if required
			'cssInline' => '.kv-heading-1{font-size:12px}',
			 // set mPDF properties on the fly
			'options' => ['title' => 'Form Request Order','subject'=>'ro'],
			 // call mPDF methods on the fly
			'methods' => [
				'SetHeader'=>['Copyright@KG '.date("r")],
				'SetFooter'=>['{PAGENO}'],
			]
		]);
		/* KIRIM ATTACH emaiL */
		//$to=['piter@lukison.com'];
		//\Yii::$app->kirim_email->pdf($contentMailAttach,'PO',$to,'Purchase-Order',$contentMailAttachBody);
	
		return $pdf->render();
    }
}

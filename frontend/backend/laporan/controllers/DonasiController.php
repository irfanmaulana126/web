<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use frontend\backend\laporan\models\PtrKasirTh1aDonasi;
use frontend\backend\laporan\models\PtrKasirTh1aDonasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use ptrnov\postman4excel\Postman4ExcelBehavior;
use common\models\Store;

class DonasiController extends Controller
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
        $searchModel = new PtrKasirTh1aDonasiSearch($cari);
        $dataProvider = $searchModel->SearchDonasi(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cari'=>$cari,
        ]);
	}
	/**====================================
	* EXPORT DATA
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
	*/
	public function actionExport(){
		$modelPeriode = new \yii\base\DynamicModel([
			'TAHUN'
		]);		
		$modelPeriode->addRule(['TAHUN'], 'required')
         ->addRule(['TAHUN'], 'safe');
		 
		if ($modelPeriode->load(Yii::$app->request->post())) {
			$paramCari=$modelPeriode->TAHUN;
			$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
			$ambilTgl=date('Y-n-d',strtotime($paramCari.'-01'));
			$cari=[
				'TAHUN'=>date('Y',strtotime($ambilTgl)),
				'BULAN'=>date('n',strtotime($ambilTgl)),
				'ACCESS_GROUP'=>$user
			];	
		// print_r($cari);die();
		//DINAMIK MODEL PARAMS
		$searchModel = new PtrKasirTh1aDonasiSearch($cari);
        $dataProvider = $searchModel->SearchDonasi(Yii::$app->request->queryParams);
		$dinamikField=$dataProvider->allModels;
		// print_r($dinamikField);die();
		if (!empty($dinamikField)){
				$headerMerge[]=['DATA_TOKO'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'15']];
					
				$aryFieldColomn[]="NAMA_TOKO";
				$aryFieldColomnHeader[]="DATA_TOKO";
				if($dinamikField){
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						if($splt[0]=='IN'){
							//sheet_title-row1
							$aryFieldColomnHeader[]=$splt[1];
							//headerStyle-row1
							$headerMerge[]=[$splt[1]=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'2,0','width'=>'7']];				
							//sheet_title-row2
							$aryFieldColomn[]='JUMLAH MASUK';
							$columnMerge[]=['Closing'=>['font-size'=>'9','align'=>'center','color-font'=>'FFFFFF','color-background'=>'519CC6','merge'=>'1,0','width'=>'7']];
					
						};
					};
				
					$aryFieldColomn[]="JUMLAH MASUK";
				 } 			
				
				$setHeaderMerge=[];
				foreach($headerMerge as $key=>$val){
					$setHeaderMerge=array_merge($setHeaderMerge,$headerMerge[$key]);			
				}	
				// print_r($setHeaderMerge);
				// die();
				
				$excel_dataProdukStok = Postman4ExcelBehavior::excelDataFormat($dinamikField);
				$excel_titleProdukStok = $excel_dataProdukStok['excel_title'];
				$excel_ceilsProdukStok = $excel_dataProdukStok['excel_ceils'];

				
				// print_r($excel_ceilsProdukStok);
				// die();
				//DATA IMPORT
				$excel_content = [
					[
						'sheet_name' => 'Donasi-laporan',
						'sheet_title' => [
							$aryFieldColomnHeader,
							$aryFieldColomn
						],
						'ceils' => $excel_ceilsProdukStok,
						'freezePane' => 'A3',
						'columnGroup'=>false,
						'autoSize'=>false,
						'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
					   'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
					   'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),
					],
				];
				// print_r($excel_content);
				// die();
				$excel_file = "Donasi Laporan";
				$this->export4excel($excel_content, $excel_file,0);
			}else{
				Yii::$app->session->setFlash('error', "Data Tidak ada");
				$this->redirect(array('/laporan/donasi'));
			}
		}else{
			return $this->renderAjax('form_cari_export',[
				'modelPeriode' => $modelPeriode
			]);
		}		
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

		$content= $this->renderPartial( '/donasi/indexPdf', [
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

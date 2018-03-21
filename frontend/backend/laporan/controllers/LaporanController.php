<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use kartik\mpdf\Pdf;

use frontend\backend\laporan\models\JurnalTemplateTitleSearch;
use frontend\backend\laporan\models\JurnalTransaksiBulanSearch;
use frontend\backend\laporan\models\LaporanArusKas;
use common\models\Store;

class LaporanController extends \yii\web\Controller
{
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
        return $this->render('index');
    }
   
	public function actionIndexArus()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('tgl');
		if ($paramCari!=''){
			$ambilTgl=date('Y-n-d',strtotime($paramCari.'-01'));
			$cari=[
				'TAHUN'=>date('Y',strtotime($ambilTgl)),
				'BULAN'=>date('n',strtotime($ambilTgl))
			];			
		}else{
			//$cari=date('Y-n');
			$cari=[
				'TAHUN'=>'2018',
				'BULAN'=>'2'
			];
		};
		$paramCari2=Yii::$app->getRequest()->getQueryParam('store');
		if ($paramCari2!=''){	
			$stores=store::find()->where(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari2])->orderBy(['STATUS'=>SORT_ASC])->one();					
		}else{
			$stores=store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->one();				
		};
		
		$searchModel = new LaporanArusKas($cari);
		$dataProvider = $searchModel->searchArusKeuangan(Yii::$app->request->queryParams);
        
        return $this->render('/arus-uang/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
	
	/*
	 * Print PDF
	 * @author ptrnov <piter@lukison.com>
	 * @since 1.2
	*/
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

		$content= $this->renderPartial( '/arus-uang/indexPdf', [
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    public function actionIndexPenjualan()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		if ($paramCari!=''){
			$cari=$paramCari;	
		}else{
			$cari=date('Y-n');
		};
		$paramCari2=Yii::$app->getRequest()->getQueryParam('store');
		if ($paramCari2!=''){	
			$stores=store::find()->where(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari2])->orderBy(['STATUS'=>SORT_ASC])->one();					
		}else{
			$stores=store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->one();				
		};
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'PENJUALAN']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/sales/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexJurnal()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;    

        $searchModel = new JurnalTransaksiBulanSearch(['ACCESS_GROUP'=>$user,'TAHUN'=>date('Y'),'BULAN'=>date('n')]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/jurnal-transaksi-bulan/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexBuku()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		if ($paramCari!=''){
			$cari=$paramCari;	
		}else{
			$cari=date('Y-n');
		};
		$paramCari2=Yii::$app->getRequest()->getQueryParam('store');
		if ($paramCari2!=''){	
			$stores=store::find()->where(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari2])->orderBy(['STATUS'=>SORT_ASC])->one();					
		}else{
			$stores=store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->one();				
		};
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'Buku Besar']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/buku-besar/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexNeraca()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		if ($paramCari!=''){
			$cari=$paramCari;	
		}else{
			$cari=date('Y-n');
		};
		$paramCari2=Yii::$app->getRequest()->getQueryParam('store');
		if ($paramCari2!=''){	
			$stores=store::find()->where(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari2])->orderBy(['STATUS'=>SORT_ASC])->one();					
		}else{
			$stores=store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->one();				
		};
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'Neraca']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/neraca/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexPpob()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
		if ($paramCari!=''){
			$cari=$paramCari;	
		}else{
			$cari=date('Y-n');
		};
		$paramCari2=Yii::$app->getRequest()->getQueryParam('store');
		if ($paramCari2!=''){	
			$stores=store::find()->where(['ACCESS_GROUP'=>$user,'STORE_ID'=>$paramCari2])->orderBy(['STATUS'=>SORT_ASC])->one();					
		}else{
			$stores=store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->one();				
		};
		
        $searchModel = new JurnalTemplateTitleSearch(['RPT_GROUP_NM'=>'Neraca']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/ppob/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'cari'=>$cari,
			'store'=>$stores
        ]);
    }
    public function actionIndexDonasi()
    {
        return $this->render('/donasi/index');
    }
    public function actionIndexDompet()
    {
        return $this->render('/dompet/index');
    }

}

<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\UploadForm;
use yii\data\ArrayDataProvider;
use ptrnov\postman4excel\Postman4ExcelBehavior;
use frontend\backend\master\models\Store;
use frontend\backend\master\models\ProductGroup;
use frontend\backend\master\models\ProductUnit;
use frontend\backend\master\models\ProductGroupSearch;
use frontend\backend\master\models\Product;
use frontend\backend\master\models\ProductSearch;
use frontend\backend\master\models\AllStoreItemSearch;
use frontend\backend\master\models\ProductImage;
use frontend\backend\master\models\ProductDiscount;
use frontend\backend\master\models\ProductDiscountSearch;
use frontend\backend\master\models\ProductPromo;
use frontend\backend\master\models\ProductPromoSearch;
use frontend\backend\master\models\ProductHarga;
use frontend\backend\master\models\ProductHargaSearch;
use frontend\backend\master\models\ProductStock;
use frontend\backend\master\models\ProductStockSearch;
use frontend\backend\master\models\Industry;
use frontend\backend\master\models\IndustryGroup;
use frontend\backend\master\models\Customer;
use frontend\backend\master\models\CustomerSearch;
use frontend\backend\master\models\Supplier;
use frontend\backend\master\models\SupplierSearch;
use frontend\backend\master\models\PpobMasterDataSearch;
use frontend\backend\master\models\PpobMasterKtgSearch;
/**
 * ItemController implements the CRUD actions for Item model.
 */
class DataBarangController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
			/*EXCEl IMPORT*/
			'export4excel' => [
				'class' => Postman4ExcelBehavior::className(),
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
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
		return $this->render('index');
    }
    public function actionIndexProduk()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('_index_all_product', [
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexDiscount()
    {
        
		$paramCari=Yii::$app->getRequest()->getQueryParam('productid');
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->one();
        if (!empty($product)) {
            if(!empty($paramCari)){
                $product = ProductSearch::find()->where(['PRODUCT_ID'=>$paramCari,'STATUS'=>1])->one();
                $searchModelDiscount = new ProductDiscountSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$paramCari]);
            }else{
                $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->one();
                $searchModelDiscount = new ProductDiscountSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$product->PRODUCT_ID]);
            }
            $dataProviderDiscount = $searchModelDiscount->search(Yii::$app->request->queryParams);
            $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('_index_discount', [
                'searchModel'=>$searchModel,
                'dataProvider' => $dataProvider,
                'searchModelDiscount'=>$searchModelDiscount,
                'dataProviderDiscount' => $dataProviderDiscount,
                'product'=>$product
            ]);
        } else {            
            Yii::$app->session->setFlash('error', "Anda tidak memiliki Produk");
            return $this->redirect('index');
        }
    }
    public function actionIndexPromo()
    {
        $paramCari=Yii::$app->getRequest()->getQueryParam('productid');
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->one();
        // print_r($product);die();
        if (!empty($product)) {       
            if(!empty($paramCari)){
                $product = ProductSearch::find()->where(['PRODUCT_ID'=>$paramCari,'STATUS'=>1])->one();
                $searchModelPromo = new ProductPromoSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$paramCari,'STATUS'=>1]);
            }else{
                $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->one();
                $searchModelPromo = new ProductPromoSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$product->PRODUCT_ID,'STATUS'=>1]);
            }
            $dataProviderPromo = $searchModelPromo->search(Yii::$app->request->queryParams);
            $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
            // print_r($product);die();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('_index_promo', [
                'searchModel'=>$searchModel,
                'dataProvider' => $dataProvider,
                'searchModelPromo'=>$searchModelPromo,
                'dataProviderPromo' => $dataProviderPromo,
                'product'=>$product
            ]);
        } else {            
            Yii::$app->session->setFlash('error', "Anda tidak memiliki Produk");
            return $this->redirect('index');
        }
    }
    public function actionIndexHarga()
    {
        $paramCari=Yii::$app->getRequest()->getQueryParam('productid');
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->one();
        if (!empty($product)) { 
            if(!empty($paramCari)){
                $product = ProductSearch::find()->where(['PRODUCT_ID'=>$paramCari,'STATUS'=>1])->one();
                $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$paramCari,'STATUS'=>1]);
            }else{
                $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->one();
                $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$product->PRODUCT_ID,'STATUS'=>1]);
            }
            $dataProviderHarga = $searchModelHarga->search(Yii::$app->request->queryParams);
            $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('_index_harga', [
                'searchModel'=>$searchModel,
                'dataProvider' => $dataProvider,
                'searchModelHarga'=>$searchModelHarga,
                'dataProviderHarga' => $dataProviderHarga,
                'product'=>$product
            ]);
        } else {            
            Yii::$app->session->setFlash('error', "Anda tidak memiliki Produk");
            return $this->redirect('index');
        }
    }
    public function actionIndexStock()
    {
        $paramCari=Yii::$app->getRequest()->getQueryParam('productid');
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->one();
        if (!empty($product)) { 
            if(!empty($paramCari)){
                $product = ProductSearch::find()->where(['PRODUCT_ID'=>$paramCari,'STATUS'=>1])->one();
                $searchModelStock = new ProductStockSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$paramCari,'STATUS'=>1]);
            }else{
                $product = ProductSearch::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>1])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->one();
                $searchModelStock = new ProductStockSearch(['ACCESS_GROUP'=>$user,'PRODUCT_ID'=>$product->PRODUCT_ID,'STATUS'=>1]);
            }
            $dataProviderStock = $searchModelStock->search(Yii::$app->request->queryParams);
            $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('_index_stock', [
                'searchModel'=>$searchModel,
                'dataProvider' => $dataProvider,
                'searchModelStock'=>$searchModelStock,
                'dataProviderStock' => $dataProviderStock,
                'product'=>$product
            ]);
        } else {            
            Yii::$app->session->setFlash('error', "Anda tidak memiliki Produk");
            return $this->redirect('index');
        }
    }
    public function actionIndexSupplier()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new SupplierSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('_index_supplier', [
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
    public function actionIndexCustomer()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new CustomerSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('_index_customer', [
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexGroup()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModelGroup = new ProductGroupSearch(['ACCESS_GROUP'=>$user,'STATUS'=>1]);
        $dataProviderGroup = $searchModelGroup->search(Yii::$app->request->queryParams);
		return $this->render('_index_product_group', [
			'searchModelGroup'=>$searchModelGroup,
            'dataProviderGroup' => $dataProviderGroup,
        ]);
    }
    public function actionIndexPpob()
    {
        $paramCari=Yii::$app->getRequest()->getQueryParam('productid');
        if(!empty($paramCari)){
            $ktg = PpobMasterKtgSearch::find()->where(['STATUS'=>1,'KTG_ID'=>$paramCari])->one();
            $searchModelData = new PpobMasterDataSearch(['KTG_ID'=>$ktg->KTG_ID,'STATUS'=>1]);
        }else{
            $ktg = PpobMasterKtgSearch::find()->where(['STATUS'=>1])->one();
            $searchModelData = new PpobMasterDataSearch(['KTG_ID'=>$ktg->KTG_ID,'STATUS'=>1]);
        }        
        $searchModelKtg = new PpobMasterKtgSearch();
        $dataProviderKtg = $searchModelKtg->search(Yii::$app->request->queryParams);
        // $searchModelData = new PpobMasterDataSearch();
        $dataProviderData = $searchModelData->search(Yii::$app->request->queryParams);
		return $this->render('_index_product_ppob_detail', [
			'searchModelKtg'=>$searchModelKtg,
            'dataProviderKtg' => $dataProviderKtg,
			'searchModelData'=>$searchModelData,
            'dataProviderData' => $dataProviderData,
            'ktg'=>$ktg
        ]);
    }
    
    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndexOld()
    {
        $paramCari=Yii::$app->getRequest()->getQueryParam('TGL');
        if (empty($paramCari)) {
            $tahun = date('Y');
            $bulan = date('n');
        }else{
            $tanggal=explode('-',$paramCari);
            $tahun = $tanggal[0];
            $bulan = $tanggal[1];
            
        }
        // print_r($bulan);die();
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelGroup = new ProductGroupSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderGroup = $searchModelGroup->search(Yii::$app->request->queryParams);

        $searchModelDiscount = new ProductDiscountSearch(['ACCESS_GROUP'=>$user,'YEAR_AT'=>$tahun,'MONTH_AT'=>$bulan]);
        $dataProviderDiscount = $searchModelDiscount->search(Yii::$app->request->queryParams);

        $searchModelPromo = new ProductPromoSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderPromo = $searchModelPromo->search(Yii::$app->request->queryParams);

        $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>$user,'YEAR_AT'=>$tahun,'MONTH_AT'=>$bulan]);
        $dataProviderHarga = $searchModelHarga->search(Yii::$app->request->queryParams);

        $searchModelStock = new ProductStockSearch(['ACCESS_GROUP'=>$user,'YEAR_AT'=>$tahun,'MONTH_AT'=>$bulan]);
        $dataProviderStock = $searchModelStock->search(Yii::$app->request->queryParams);
        // print_r($searchModel);die();
		 return $this->render('indexOld', [
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
			'searchModelGroup'=>$searchModelGroup,
            'dataProviderGroup' => $dataProviderGroup,
			'searchModelDiscount'=>$searchModelDiscount,
            'dataProviderDiscount' => $dataProviderDiscount,
			'searchModelPromo'=>$searchModelPromo,
            'dataProviderPromo' => $dataProviderPromo,
			'searchModelHarga'=>$searchModelHarga,
            'dataProviderHarga' => $dataProviderHarga,
			'searchModelStock'=>$searchModelStock,
            'dataProviderStock' => $dataProviderStock,
        ]);		
    }
    
     /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {
            $model->CREATE_AT=date('Y-m-d H:i:s');
            $product=strtoupper($model->PRODUCT_NM);
            $model->PRODUCT_NM=$product;
            $data=store::find()->where(['STORE_ID'=>$model['STORE_ID']])->one();
            $model->INDUSTRY_ID=(empty($data->INDUSTRY_ID)) ? '' : $data->INDUSTRY_ID ;
            $model->INDUSTRY_GRP_ID=(empty($data->INDUSTRY_GRP_ID))?'':$data->INDUSTRY_GRP_ID;
            $model->INDUSTRY_NM=(empty($data->INDUSTRY_NM))?'':$data->INDUSTRY_NM;
            $model->INDUSTRY_GRP_NM=(empty($data->INDUSTRY_GRP_NM))?'':$data->INDUSTRY_GRP_NM;
            if($model->save(false)) {                
                $C=$model->getPrimaryKey();
                $modelCari=Product::find()->where(['ID'=>$C['ID']])->one();
                Yii::$app->session->setFlash('success', "Penyimpanan PRODUK <b>".$model->PRODUCT_NM."</b> Berhasil");
                return $this->redirect(['index-produk']);
            }
            else {
                $transaction->rollBack();
            }
        } else {
    //   print_r($store_id);die();
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionDiscount($ACCESS_GROUP,$PRODUCT_ID,$STORE_ID)
    {
        $model = new ProductDiscount();
        
        if ($model->load(Yii::$app->request->post())) {
            $models = Product::find()->where(['PRODUCT_ID'=>$PRODUCT_ID])->one();
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            $model->START_TIME=date('H:i:s');
            // print_r($model);die();
            // $model->save();
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Discount Produk <b>".$models->PRODUCT_NM."</b> Berhasil");
            return $this->redirect(['index-discount','productid'=>$PRODUCT_ID]);
           }
        } else{
            $product = ProductDiscountSearch::find()->where(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID])->orderBy(['PERIODE_TGL1'=>SORT_DESC])->one();
            $productdetail = ProductSearch::find()->joinWith('store')->where(['store.ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'store.STORE_ID'=>$STORE_ID])->one();
            $searchModel = new ProductDiscountSearch(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
            return $this->renderAjax('_form_discount', [
                'model' =>  $model,
                'searchModel'=>$searchModel,
                'dataProvider' => $dataProvider,
                'product'=>$product,
                'productdetail'=>$productdetail
            ]);
        }
    }
    
    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionPromo($ACCESS_GROUP,$PRODUCT_ID,$STORE_ID)
    {
        $model = new ProductPromo();

        if ($model->load(Yii::$app->request->post())) {
            $models = Product::find()->where(['PRODUCT_ID'=>$PRODUCT_ID])->one();
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            date_default_timezone_set('Asia/Jakarta');
            $model->START_TIME=date('H:i:s');
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Promo Produk <b>".$models->PRODUCT_NM."</b> Berhasil");
            return $this->redirect(['index-promo','productid'=>$PRODUCT_ID]);
           }
        }
        $product = ProductPromoSearch::find()->where(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID])->orderBy(['PERIODE_TGL1'=>SORT_DESC])->one();
        $productdetail = ProductSearch::find()->joinWith('store')->where(['store.ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'store.STORE_ID'=>$STORE_ID])->one();
        $searchModel = new ProductPromoSearch(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('_form_promo', [
            'model' =>  $model,
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
            'product'=>$product,
            'productdetail'=>$productdetail
        ]);
    }
    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionHarga($ACCESS_GROUP,$PRODUCT_ID,$STORE_ID)
    {
        $model = new ProductHarga();
    
        if ($model->load(Yii::$app->request->post())) {
            $models = Product::find()->where(['PRODUCT_ID'=>$PRODUCT_ID])->one();
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            date_default_timezone_set('Asia/Jakarta');
            $model->START_TIME=date('H:i:s');
            
            // print_r($model);die();
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Harga Produk <b>".$models->PRODUCT_NM."</b> Berhasil");
            return $this->redirect(['index-harga','productid'=>$PRODUCT_ID]);
           }
        }
        $product = ProductHargaSearch::find()->where(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID])->orderBy(['PERIODE_TGL1'=>SORT_DESC])->one();
        $productdetail = ProductSearch::find()->joinWith('store')->where(['store.ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'store.STORE_ID'=>$STORE_ID])->one();
        $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID]);
        $dataProviderHarga = $searchModelHarga->search(Yii::$app->request->queryParams);

        return $this->renderAjax('_form_harga', [
            'model' =>  $model,
			'searchModelHarga'=>$searchModelHarga,
            'dataProviderHarga' => $dataProviderHarga,
            'product'=>$product,
            'productdetail'=>$productdetail
        ]);
    }
    /**
     * Creates a new ProductStock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionStock($ACCESS_GROUP,$PRODUCT_ID,$STORE_ID)
    {
        $model = new ProductStock();
        if ($model->load(Yii::$app->request->post())) {
            $models = Product::find()->where(['PRODUCT_ID'=>$PRODUCT_ID])->one();
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            date_default_timezone_set('Asia/Jakarta');
            $model->INPUT_TIME=date('H:i:s');
            $model->INPUT_DATE=date('Y-m-d');
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Stock Produk <b>".$models->PRODUCT_NM."</b> Berhasil");
            return $this->redirect(['index-stock','productid'=>$PRODUCT_ID]);
           }
        }
        $productdetail = ProductSearch::find()->joinWith('store')->where(['store.ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'store.STORE_ID'=>$STORE_ID])->one();
        
        return $this->renderAjax('_form_stock', [
            'model' => $model,
            'productdetail'=>$productdetail
        ]);
    }
    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->STATUS ="3";
        $model->save(false);
        // print_r($model);die();                    
        Yii::$app->session->setFlash('error', "Data Produk <b>".$model->PRODUCT_NM."</b> Berhasil dihapus");
        return $this->redirect(['index-produk']);
        
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
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
        $image = ProductImage::find()->where(['PRODUCT_ID'=>$model['PRODUCT_ID']])->one();
        // print_r($image);die();
        if(empty($image)){
            $image = new ProductImage();
        }

        // $transaction = Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post()) && $image->load(Yii::$app->request->post())) { 
            // print(UploadedFile::getInstance($image, 'PRODUCT_IMAGE'));die();  
                    $data=store::find()->where(['STORE_ID'=>$model['STORE_ID']])->one();
                    $dataunit=ProductUnit::find()->where(['UNIT_ID'=>$model['UNIT_ID']])->one();
                    $model->PRODUCT_NM=strtoupper($model->PRODUCT_NM);
                    $model->INDUSTRY_ID=(empty($data->INDUSTRY_ID)) ? '' : $data->INDUSTRY_ID ;
                    $model->INDUSTRY_GRP_ID=(empty($data->INDUSTRY_GRP_ID))?'':$data->INDUSTRY_GRP_ID;
                    $model->INDUSTRY_NM=(empty($data->INDUSTRY_NM))?'':$data->INDUSTRY_NM;
                    $model->INDUSTRY_GRP_NM=(empty($data->INDUSTRY_GRP_NM))?'':$data->INDUSTRY_GRP_NM;
                    $model->PRODUCT_SIZE_UNIT=(empty($dataunit->UNIT_NM))?'':$dataunit->UNIT_NM;
                    date_default_timezone_set('Asia/Jakarta');
                    $model->CREATE_AT=date('Y-m-d H:i:s');
                    // $model->save(false);
                    if($model->save(false)) {    
                        if (!empty(UploadedFile::getInstance($image, 'PRODUCT_IMAGE'))) {
                            $transaction = Yii::$app->db->beginTransaction();
                            $C=$model->getPrimaryKey();
                            $s=$C['ID'];
                            $modelCari=Product::find()->where(['ID'=>$s])->one();
                            // $image->CREATE_AT=date('Y-m-d H:i:s');
                            // $gambar = UploadedFile::getInstance($image, 'PRODUCT_IMAGE');
                            // $gambar->saveAs(Yii::getAlias('@frontend/web/img/') . '.' . $gambar->extension);
                            // $image->PRODUCT_IMAGE = 'gambar.' . $gambar->extension;
                            // $image->ACCESS_GROUP='123';//$modelCari->ACCESS_GROUP;
                            // $image->STORE_ID='123';//$modelCari->STORE_ID;
                            $image->PRODUCT_ID=$modelCari->PRODUCT_ID;
                            $upload_file = $image->uploadImage();
                            $data_base64 = $upload_file != ''? $this->saveimage(file_get_contents($upload_file->tempName)): ''; //call function saveimage using base64
                            $image->PRODUCT_IMAGE = 'data:image/*;charset=utf-8;base64,'.$data_base64;
        
                            // $image->PRODUCT_ID=$model->PRODUCT_ID;
                            // $image->ACCESS_GROUP=$model->ACCESS_GROUP;
                            // $C=$model->getPrimaryKey();
                            // $s=$C['STORE_ID'];
                            $image->save();
                            
                           // print_r($C);die();
                            // $model->addProductImage($image);
                            
                            $transaction->commit();


                    $transaction = Yii::$app->db->beginTransaction();
                    $image->PRODUCT_ID=$model['PRODUCT_ID'];
                    $upload_file = $image->uploadImage();
                    $data_base64 = $upload_file != ''? $this->saveimage(file_get_contents($upload_file->tempName)): ''; //call function saveimage using base64
                    $image->PRODUCT_IMAGE = 'data:image/*;charset=utf-8;base64,'.$data_base64;
                    // print_r($image->PRODUCT_ID);die();
                    Yii::$app->db->createCommand("
                    UPDATE product_image SET PRODUCT_IMAGE='".$image->PRODUCT_IMAGE."' WHERE PRODUCT_ID='".$image->PRODUCT_ID."'")->execute();
                    // $image->update();
                    
                    $transaction->commit();
                }
            // else {
            //         $transaction->rollBack();
            //     }
            
            Yii::$app->session->setFlash('success', "Perubahan Data PRODUK <b>".$model->PRODUCT_NM."</b> Berhasil di rubah");
            return $this->redirect(['index-produk']);
            }                               
            
        } else {
            return $this->renderAjax('update', [
                'model' => $model,                
                'image'=>$image,
            ]);
        }
    }
    public function saveimage($base64)
    {
    $base64 = str_replace('data:image/jpg;base64,', '', $base64);
    $base64 = base64_encode($base64);
    $base64 = str_replace('data:image/jpg;base64,', '+', $base64);
    return $base64;
    }

    /**
     * Depdrop Sub unit - depedence Province
     * @author Piter
     * @since 1.1.0
     * @return mixed
     */
    public function actionUnit() {
        $out = [];
            if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                    $id = $parents[0];
                    $model = ProductUnit::find()->asArray()->where(['UNIT_ID_GRP'=>$id])->all();														
                                                            
                    foreach ($model as $key => $value) {
                    $out[] = ['id'=>$value['UNIT_ID'],'name'=> $value['UNIT_NM']];
                    } 
                    echo json_encode(['output'=>$out, 'selected'=>'']);
                    return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
/**====================================
	* UPLOAD OPNAME - FORMAT
	* @return mixed
	* @author piter [ptr.nov@gmail.com]
	* @since 1.2
	* ====================================
    */
    public function actionUploadFile(){
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        
        $modelPeriode = new Product;
		 
		if ($modelPeriode->load(Yii::$app->request->post())) {
            $storeId = $modelPeriode->STORE_ID;
			$modelPeriode->uploadExport = UploadedFile::getInstance($modelPeriode, 'uploadExport');
            // print_r($modelPeriode->uploadExport);die();
            if ($modelPeriode->upload()) {			
                $file='uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension.'';
                // print_r($file);die();	
				try{
					$FileType = \PHPExcel_IOFactory::identify($file);
					$objReader = \PHPExcel_IOFactory::createReader($FileType);
					$objPHPExcel = $objReader->load($file);
				}catch(Exception $e){
					die('error');
                }
                /**
                 *  Sebelum Upload jadi Tabel
                 */
                // $sheet = $objPHPExcel->getSheet(0);
                //     $highestRow = $sheet->getHighestRow();
                //     $highestColumn=$sheet->getHighestColumn();
                //     for($row = 1; $row <= $highestRow; $row++){
                //         $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
                //             if ($row==1) {
                //                 continue;
                //             }
                //             $datas[] = array(   
                //                 'PRODUCT_ID'=> $rowData[0][0],
                //                 'PRODUCT_NM'=> $rowData[0][1],
                //                 'PRODUCT_QR'=> $rowData[0][2],
                //                 'PRODUCT_WARNA'=> $rowData[0][3],
                //                 'PRODUCT_SIZE'=> $rowData[0][4],
                //                 'PRODUCT_SIZE_UNIT'=> $rowData[0][5],
                //                 'PRODUCT_HEADLINE'=> $rowData[0][6],
                //             );
                            
                //     }
                if ($storeId=='-') {
                    
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn=$sheet->getHighestColumn();
                    $rowData = $sheet->rangeToArray('A1:'.$highestColumn.'1',NULL,TRUE,FALSE);
                    $data=$rowData[0][0];
                        if ($data<>"PRODUCT_ID") {                            
                            unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                            Yii::$app->session->setFlash('error', "Template Tidak sesuia dikarenakan produk tidak memiliki kode produk");
                            return $this->redirect('index-produk');
                        }else{
                        for($row = 1; $row <= $highestRow; $row++){
                            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
                            // print_r($rowData[0][0]);die();
                            
                                // print_r($rowData[0][0]);die();
                                if ($row==1) {
                                    continue;
                                }
        
                                if (!empty($rowData[0][0])) {
                                    $product = Product::find()->where(['PRODUCT_ID'=>$rowData[0][0]])->one();
                                    // $product->PRODUCT_ID = $rowData[0][0];
                                    $product->PRODUCT_NM = $rowData[0][1];
                                    $product->PRODUCT_QR = $rowData[0][2];
                                    $product->PRODUCT_WARNA = $rowData[0][3];
                                    $product->PRODUCT_HEADLINE = $rowData[0][4];
                                    $product->DCRP_DETIL = $rowData[0][5];
                                    $product->save(false);
                                    // unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                                    // Yii::$app->session->setFlash('success', "Data telah disimpan");
                                    // return $this->redirect('index-produk');
                                } else if(empty($rowData[0][0]) && !empty($rowData[0][1])){
                                    $dataserror[]=['STORE_ID'=>'','PRODUCT_NM'=>$rowData[0][1],'PRODUCT_QR'=> $rowData[0][2],'PRODUCT_WARNA'=> $rowData[0][3],'PRODUCT_HEADLINE'=> $rowData[0][4],'DCRP_DETIL'=>$rowData[0][5]];
                                    // unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                                    // Yii::$app->session->setFlash('warning', "Terdapat Kode prodak yang kosong dan Data telah diperbarui");
                                    // return $this->redirect('index-produk');
                                }
                                // else{
                                //     unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                                //     Yii::$app->session->setFlash('success', "Data telah diperbarui");
                                //     return $this->redirect('index-produk');
                                // }
                                // print_r($branch->getErrors());
                                // print_r($rowData);
                            }
                            $dataProvider = new ArrayDataProvider([
                                'allModels'=>$dataserror
                            ]);
                            // print_r($dataProvider);die();
                            if(!empty($dataProvider)){
                                unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                                return $this->render('modal_error',[
                                    'dataProvider' => $dataProvider
                                ]);
                            // print_r($dataserror);die();
                            }else{
                                Yii::$app->session->setFlash('success', "Data telah diperbarui");
                                unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                                return $this->redirect('index-produk');
                            }
                        }

                } else {
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn=$sheet->getHighestColumn();                    
                    $rowData = $sheet->rangeToArray('A1:'.$highestColumn.'1',NULL,TRUE,FALSE);
                    $data=$rowData[0][0];
                    if ($data<>"PRODUCT_ID") {                            
                        unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                        Yii::$app->session->setFlash('error', "Template Tidak sesuia dikarenakan produk tidak memiliki kode produk");
                        return $this->redirect('index-produk');
                    }else if($data=="PRODUCT_NM"){
                    for($row = 1; $row <= $highestRow; $row++){
                        $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
    
                        if ($row==1) {
                            continue;
                        }
                        $data=store::find()->where(['STORE_ID'=>$storeId])->one();
                        
                        
                        $product = new Product;
                        $product->ACCESS_GROUP = $user;
                        $product->STORE_ID = $storeId;
                        $product->PRODUCT_NM = $rowData[0][0];
                        $product->PRODUCT_QR = $rowData[0][1];
                        $product->PRODUCT_WARNA = $rowData[0][2];
                        $product->PRODUCT_HEADLINE = $rowData[0][3];
                        $product->DCRP_DETIL = $rowData[0][4];
                        $product->INDUSTRY_ID=(empty($data->INDUSTRY_ID)) ? '' : $data->INDUSTRY_ID ;
                        $product->INDUSTRY_GRP_ID=(empty($data->INDUSTRY_GRP_ID))?'':$data->INDUSTRY_GRP_ID;
                        $product->INDUSTRY_NM=(empty($data->INDUSTRY_NM))?'':$data->INDUSTRY_NM;
                        $product->INDUSTRY_GRP_NM=(empty($data->INDUSTRY_GRP_NM))?'':$data->INDUSTRY_GRP_NM;
                        $product->CREATE_AT=date('Y-m-d H:i:s');
                        $product->save(false);
    
                        // print_r($branch->getErrors());
                        // print_r($rowData);
                    }
                    unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                    return $this->redirect('index-produk');
                    }else if($data=="PRODUCT_ID"){
                        for($row = 1; $row <= $highestRow; $row++){
                            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
        
                            if ($row==1) {
                                continue;
                            }
                            $data=store::find()->where(['STORE_ID'=>$storeId])->one();
                            
                            
                            $product = new Product;
                            if(!empty($rowData[0][0])){
                                $product->PRODUCT_ID = $rowData[0][0];
                                $product->PRODUCT_NM = $rowData[0][1];
                                $product->PRODUCT_QR = $rowData[0][2];
                                $product->PRODUCT_WARNA = $rowData[0][3];
                                $product->PRODUCT_HEADLINE = $rowData[0][4];
                                $product->DCRP_DETIL = $rowData[0][5];
                                $product->update(); 
                            }else if(empty($rowData[0][0])&&!empty($rowData[0][1])){
                               
                                $product->ACCESS_GROUP = $user;
                                $product->STORE_ID = $storeId;
                                $product->PRODUCT_NM = $rowData[0][1];
                                $product->PRODUCT_QR = $rowData[0][2];
                                $product->PRODUCT_WARNA = $rowData[0][3];
                                $product->PRODUCT_HEADLINE = $rowData[0][4];
                                $product->DCRP_DETIL = $rowData[0][5];
                                $product->INDUSTRY_ID=(empty($data->INDUSTRY_ID)) ? '' : $data->INDUSTRY_ID ;
                                $product->INDUSTRY_GRP_ID=(empty($data->INDUSTRY_GRP_ID))?'':$data->INDUSTRY_GRP_ID;
                                $product->INDUSTRY_NM=(empty($data->INDUSTRY_NM))?'':$data->INDUSTRY_NM;
                                $product->INDUSTRY_GRP_NM=(empty($data->INDUSTRY_GRP_NM))?'':$data->INDUSTRY_GRP_NM;
                                $product->CREATE_AT=date('Y-m-d H:i:s');
                                $product->save(false);
                            }
                            
                            
                            // print_r($branch->getErrors());
                            // print_r($rowData);
                        }
                        // print_r($product);
                        // die();
                        
                    unlink('uploads/'.$modelPeriode->uploadExport->baseName.'.'.$modelPeriode->uploadExport->extension);
                    return $this->redirect('index-produk');
                    }
                }
            }else{
                Yii::$app->session->setFlash('error', "Gagal Upload");
                return $this->redirect(['index-produk']);
            }
		}else{
			return $this->renderAjax('form_upload',[
				'modelPeriode' => $modelPeriode
			]);
		}
    }
    public function actionBatchUpdate()
{
    // $sourceModel = ProductStockClosingSearch::find()->indexBy('UNIX_BULAN_ID')->all();
	// $sourceModel = (Yii::$app->request->isPost);
    // $model  = new ProductStockClosingSearch;
	// $model->load(Yii::$app->request->post());
	$sourceModelProduk = new Product();
    $sourceModelStore = new store();
    $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
	if ($sourceModelProduk->load(Yii::$app->request->post())) {
		$hsl = Yii::$app->request->post();	
		$paramCari=$hsl['kvTabForm']['0']['STORE_ID'];
	};
    // print_r(Yii::$app->request->post(['kvTabForm']['0']));die();
    if (!$sourceModelProduk->load(Yii::$app->request->post(['kvTabForm']['0']))) {
        // $count = 0;
        foreach (Yii::$app->request->post(['kvTabForm']['0']) as $index => $datas) {
            $data=store::find()->where(['STORE_ID'=>$datas['STORE_ID']])->one();
                $ACCESS_GROUP = $user;
                $STORE_ID = $datas['STORE_ID'];
                $PRODUCT_NM =$datas['PRODUCT_NM'] ;
                $PRODUCT_QR = $datas['PRODUCT_QR'];
                $PRODUCT_WARNA = $datas['PRODUCT_WARNA'];
                $PRODUCT_HEADLINE = $datas['PRODUCT_HEADLINE'];
                $DCRP_DETIL =$datas['DCRP_DETIL'];
                $INDUSTRY_ID=(empty($data->INDUSTRY_ID)) ? '' : $data->INDUSTRY_ID ;
                $INDUSTRY_GRP_ID=(empty($data->INDUSTRY_GRP_ID))?'':$data->INDUSTRY_GRP_ID;
                $INDUSTRY_NM=(empty($data->INDUSTRY_NM))?'':$data->INDUSTRY_NM;
                $INDUSTRY_GRP_NM=(empty($data->INDUSTRY_GRP_NM))?'':$data->INDUSTRY_GRP_NM;
                $CREATE_AT=date('Y-m-d H:i:s');
                Yii::$app->db->createCommand("
            INSERT INTO product (ACCESS_GROUP,STORE_ID,PRODUCT_NM,PRODUCT_QR,PRODUCT_WARNA,PRODUCT_HEADLINE,DCRP_DETIL,INDUSTRY_ID,INDUSTRY_GRP_ID,INDUSTRY_NM,INDUSTRY_GRP_NM,CREATE_AT)
            VALUES ('".$ACCESS_GROUP."','".$STORE_ID."','".$PRODUCT_NM."','".$PRODUCT_QR."','".$PRODUCT_WARNA."','".$PRODUCT_HEADLINE."','".$DCRP_DETIL."','".$INDUSTRY_ID."','".$INDUSTRY_GRP_ID."','".$INDUSTRY_NM."','".$INDUSTRY_GRP_NM."','".$CREATE_AT."')")->execute();
        
                // $sourceModelProduk->save(false);
			// foreach($model as $mod){
				// print_r($datas['UNIX_BULAN_ID']);
				// Yii::$app->db->createCommand("
				// UPDATE product SET STOCK_INPUT_ACTUAL='".$datas['STOCK_INPUT_ACTUAL']."', WHERE UNIX_BULAN_ID='".$datas['UNIX_BULAN_ID']."'")->execute();
				// $sourceModel->UNIX_BULAN_ID=$datas['UNIX_BULAN_ID'];
				// $sourceModel->STOCK_INPUT_ACTUAL=$datas['STOCK_INPUT_ACTUAL'];
				// $model = ProductStockClosingSearch::find()->where(['UNIX_BULAN_ID'=>$datas['']])->one();
				// $sourceModel->update();
			// }
		}
        // die();
        $datas=Yii::$app->request->post(['kvTabForm']['0']);
        unset($datas);
        Yii::$app->session->setFlash('success', "Processed records successfully.");
		return $this->redirect(['/master/data-barang/index-produk']); // redirect to your next desired page

    } 
}
    public function actionExport()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->searchExcelExport(Yii::$app->request->queryParams);
		$model=$dataProvider->allModels;
		
		$excel_dataProduk= Postman4ExcelBehavior::excelDataFormat($model);		
        $excel_titleDataProduk = $excel_dataProduk['excel_title'];
        $excel_ceilsDataProduk = $excel_dataProduk['excel_ceils'];

		//DATA IMPORT
        // print_r($excel_dataKaryawan);die();
		$excel_content[] = 
			[
				'sheet_name' => 'data-Produk',
                'sheet_title' => [
					['PRODUCT_ID' ,'PRODUCT_NM','PRODUCT_QR','PRODUCT_WARNA','PRODUCT_HEADLINE','DCRP_DETIL']
				],
			    'ceils' => $excel_ceilsDataProduk,
				'freezePane' => 'A2',
				'columnGroup'=>false,
                'autoSize'=>false,
                'unlockCell'=>'B,J,'.(count($excel_ceilsDataProduk)+50).'',
                'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                'headerStyle'=>[	
					[
						'PRODUCT_ID' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_QR' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_WARNA' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],					
						'PRODUCT_HEADLINE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],			
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
				],
			],
				'contentStyle'=>[
					[
						'PRODUCT_ID' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_QR' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_WARNA' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],						
						'PRODUCT_HEADLINE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],					
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],	
					]
				],
			'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
			'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),			
		];
		// print_r($excel_ceilsDatakaryawan);
		// die();
		$excel_file = "Data-Produk-".$user."";
		$this->export4excel($excel_content, $excel_file,0); 

		// return $this->redirect(['index']);
    }
    public function actionExportPromo()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->searchExcelExport(Yii::$app->request->queryParams);
		$model=$dataProvider->allModels;
		
		$excel_dataProduk= Postman4ExcelBehavior::excelDataFormat($model);		
        $excel_titleDataProduk = $excel_dataProduk['excel_title'];
        $excel_ceilsDataProduk = $excel_dataProduk['excel_ceils'];

		//DATA IMPORT
        // print_r($excel_dataKaryawan);die();
		$excel_content[] = 
			[
				'sheet_name' => 'data-Produk',
                'sheet_title' => [
					['PRODUCT_ID','PRODUCT_NM','PRODUCT_QR','PRODUCT_WARNA','PRODUCT_SIZE','PRODUCT_SIZE_UNIT','PRODUCT_HEADLINE','INDUSTRY_NM','INDUSTRY_GRP_NM','DCRP_DETIL']
				],
			    'ceils' => $excel_ceilsDataProduk,
				'freezePane' => 'A2',
				'columnGroup'=>false,
                'autoSize'=>false,
                'unlockCell'=>'B,J,'.(count($excel_ceilsDataProduk)+1).'',
                'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                'headerStyle'=>[	
					[
						'PRODUCT_ID' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_QR' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_WARNA' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_SIZE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_SIZE_UNIT' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_HEADLINE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_GRP_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
				],
			],
				'contentStyle'=>[
					[
						'PRODUCT_ID' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_QR' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_WARNA' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_SIZE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_SIZE_UNIT' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_HEADLINE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_GRP_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],	
					]
				],
			'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
			'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),			
		];
		// print_r($excel_ceilsDatakaryawan);
		// die();
		$excel_file = "Data-Produk-".$user."";
		$this->export4excel($excel_content, $excel_file,0); 

		// return $this->redirect(['index']);
    }
    public function actionDownloadTemplate()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $cel = array('0' => array('1' => '','2' => '','3' => '','4' => '','5' => ''));
       $excel_content[] = 
			[
				'sheet_name' => 'data-Produk',
                'sheet_title' => [
					['NAMA PRODUK','QR PRODUK','WARNA PRODUK','PRODUK HEADLINE','DCRP DETIL']
                ],
                
			    'ceils' =>$cel,
				'freezePane' => 'A2',
				'columnGroup'=>false,
                'autoSize'=>false,
                'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                'headerStyle'=>[	
					[
						'PRODUCT_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PRODUCT_QR' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_WARNA' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_SIZE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_SIZE_UNIT' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PRODUCT_HEADLINE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_GRP_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
				],
			],
			'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
			'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),			
		];
		// print_r($excel_ceilsDatakaryawan);
		// die();
		$excel_file = "Template-Produk-".$user."";
		$this->export4excel($excel_content, $excel_file,0); 

		// return $this->redirect(['index']);
    }
    public function actionCaraUpload()
    {
        return $this->renderAjax('cara_upload');
    }
}

<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\web\UploadedFile;
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
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new ProductSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelGroup = new ProductGroupSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderGroup = $searchModelGroup->search(Yii::$app->request->queryParams);

        $searchModelDiscount = new ProductDiscountSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderDiscount = $searchModelDiscount->search(Yii::$app->request->queryParams);

        $searchModelPromo = new ProductPromoSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderPromo = $searchModelPromo->search(Yii::$app->request->queryParams);

        $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderHarga = $searchModelHarga->search(Yii::$app->request->queryParams);

        $searchModelStock = new ProductStockSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderStock = $searchModelStock->search(Yii::$app->request->queryParams);
        // print_r($searchModel);die();
		 return $this->render('index', [
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
		
		/* $paramCari=Yii::$app->getRequest()->getQueryParam('outlet_code');
		//Get 
		$modelOutlet=Store::find()->where(['OUTLET_CODE'=>$paramCari])->one();//->andWhere('FIND_IN_SET("'.$this->ACCESS_UNIX.'", ACCESS_UNIX)')->one();
		if($modelOutlet){
		    $searchModel = new ItemSearch(['OUTLET_CODE'=>$paramCari]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);			
		
		///OUTLET ID.
		
        return $this->render('index', [
			'outletNm'=>$modelOutlet!=''?$modelOutlet->OUTLET_NM:'none',
            'searchModel' => $searchModel!=''?$searchModel:false,
            'dataProvider' => $dataProvider,
        ]);
		}else{
			$this->redirect(array('/site/alert'));
		} */
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
            if($model->save(false)) {                
                Yii::$app->session->setFlash('success', "Penyimpanan Harga Berhasil");
                return $this->redirect(['index']);
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
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            $model->START_TIME=date('H:i:s');
            // print_r($model);die();
            // $model->save();
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Discount Berhasil");
            return $this->redirect(['index']);
           }
        } else{
            return $this->renderAjax('_form_discount', [
                'model' => $model,
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
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            $model->START_TIME=date('H:i:s');
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Promo Berhasil");
            return $this->redirect(['index']);
           }
        }

        return $this->renderAjax('_form_promo', [
            'model' => $model,
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
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            $model->START_TIME=date('H:i:s');
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Harga Berhasil");
            return $this->redirect(['index']);
           }
        }
        $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID]);
        $dataProviderHarga = $searchModelHarga->search(Yii::$app->request->queryParams);

        return $this->renderAjax('_form_harga', [
            'model' =>  $model,
			'searchModelHarga'=>$searchModelHarga,
            'dataProviderHarga' => $dataProviderHarga,
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
            $model->PRODUCT_ID=$PRODUCT_ID;
            $model->ACCESS_GROUP=$ACCESS_GROUP;
            $model->STORE_ID=$STORE_ID;
            $model->INPUT_TIME=date('H:i:s');
            $model->INPUT_DATE=date('Y-m-d');
           if ($model->save(false)) {
            Yii::$app->session->setFlash('success', "Penyimpanan Stock Berhasil");
            return $this->redirect(['index']);
           }
        }

        return $this->renderAjax('_form_stock', [
            'model' => $model,
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
        $model->update();
        // print_r($model);die();                    
        Yii::$app->session->setFlash('error', "Data Berhasil dihapus");
        return $this->redirect(['index']);
        
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

        if ($model->load(Yii::$app->request->post()) && $image->load(Yii::$app->request->post())) { 
            // print(UploadedFile::getInstance($image, 'PRODUCT_IMAGE'));die();      
                if (!empty(UploadedFile::getInstance($image, 'PRODUCT_IMAGE'))) {
                    $data=store::find()->where(['STORE_ID'=>$model['STORE_ID']])->one();
                    $dataunit=ProductUnit::find()->where(['UNIT_ID'=>$model['UNIT_ID']])->one();
                    $model->INDUSTRY_ID=$data->INDUSTRY_ID;
                    $model->INDUSTRY_GRP_ID=$data->INDUSTRY_GRP_ID;
                    $model->INDUSTRY_NM=$data->INDUSTRY_NM;
                    $model->INDUSTRY_GRP_NM=$data->INDUSTRY_GRP_NM;
                    $model->PRODUCT_SIZE_UNIT=$dataunit->UNIT_NM;
                    $model->CREATE_AT=date('Y-m-d H:i:s');
                    if($model->save(false)) {
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
                               
            Yii::$app->session->setFlash('success', "Perubahan Data Berhasil");
            return $this->redirect(['index']);
            }
            else {
                $transaction->rollBack();
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
    

}

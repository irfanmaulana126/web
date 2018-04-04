<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;
use yii\web\Request;
use frontend\backend\master\models\Store;
use frontend\backend\master\models\StoreSearch;
use common\models\LocateKota;
use frontend\backend\master\models\Industry;
use yii\web\UploadedFile;
use ptrnov\postman4excel\Postman4ExcelBehavior;
use frontend\backend\master\models\Product;
use frontend\backend\master\models\ProductImage;
use frontend\backend\master\models\ProductUnit;
use frontend\backend\master\models\ProductDiscount;
use frontend\backend\master\models\ProductDiscountSearch;
use frontend\backend\master\models\ProductPromo;
use frontend\backend\master\models\ProductPromoSearch;
use frontend\backend\master\models\ProductHarga;
use frontend\backend\master\models\ProductHargaSearch;
use frontend\backend\master\models\ProductStock;
use frontend\backend\master\models\ProductStockSearch;
use frontend\backend\master\models\StoreKasir;
use frontend\backend\master\models\StoreKasirSearch;
use frontend\backend\master\models\StoreMembershipPaketSearch;

class StoreController extends Controller
{
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
                    'delete' => ['post'],
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
        // print_r($user);die();
        $model= Store::find()->where(['ACCESS_GROUP'=>$user,'STATUS'=>['0','1','2','4']])->all();
		$searchModel = new StoreSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		// print_r($user);die();
		return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
       //return 'asd';
    }
	
	/**
     * Displays a single Store model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->ID]);
            return $this->redirect(['index']);
        } else {
           return $this->renderAjax('view', [
                'model' => $model,
            ]);
        }
    }
	
	/**
     * Displays a single Store model.
     * @param integer $id
     * @return mixed
     */
    public function actionReview($id)
    {
    	$model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
           return $this->renderAjax('review', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionCreate()
    {
    	$model = new Store();

        if ($model->load(Yii::$app->request->post())) {
            $model->ACCESS_GROUP=Yii::$app->user->identity->ACCESS_GROUP;
            $model->STORE_NM=strtoupper($model->STORE_NM);
            $model->DATE_START=date('Y-m-d H:i:s');
            $model->CREATE_AT=date('Y-m-d H:i:s');
            if ($model->save(false)) {
                
                Yii::$app->session->setFlash('success', "Penyimpanan Store <b>".$model->STORE_NM."</b> Berhasil");
                return $this->redirect(['index']);   
            }
        } else {
           return $this->renderAjax('form_create', [
                'model' => $model,
            ]);
        }
    }
    public function actionDevice($id)
    {
        // print_r($id);die();
        $model = new StoreKasir();
        if ($model->load(Yii::$app->request->post())) {            
            $model->STORE_ID=$id;
            // print_r($model);die();
            if ($model->save(false)) {
                
                Yii::$app->session->setFlash('success', "Perangkat <b>".$model->KASIR_NM."</b> derhasil dibuat");
                return $this->redirect(['index#w20-tab5']);   
            }
        } else {
           return $this->renderAjax('_form_setting', [
                'model' => $model,
            ]);
        }
    }
    public function actionUpdate($id)
    {
    	$model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->STORE_NM=strtoupper($model->STORE_NM);
            if ($model->save(false)) {
                
            Yii::$app->session->setFlash('success', "Perubahan Toko <b>".$model->STORE_NM."</b> Berhasil");
                return $this->redirect(['index']);   
            }
        } else {
           return $this->renderAjax('form_update', [
                'model' => $model,
            ]);
        }
    }

	public function actionDelete($id)
    {
        // $this->findModel($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT)->delete();
        $model = $this->findModel($id);
        $model->STATUS ="3";
        $model->save(false);
        // Yii::$app->session->setFlash('error', "Data Berhasil dihapus");

        Yii::$app->session->setFlash('success', "Penghapusan Toko <b>".$model->STORE_NM."</b> Berhasil");
        return $this->redirect(['index']);
    }
	/**
     * Depdrop Sub Kota - depedence Province
     * @author Piter
     * @since 1.1.0
     * @return mixed
     */
   public function actionKota() {
    $out = [];
		if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$id = $parents[0];
				$model = LocateKota::find()->asArray()->where(['PROVINCE_ID'=>$id])->all();														
														
				foreach ($model as $key => $value) {
				   $out[] = ['id'=>$value['CITY_ID'],'name'=> $value['CITY_NAME']];
			    } 
				echo json_encode(['output'=>$out, 'selected'=>'']);
				return;
           }
       }
       echo Json::encode(['output'=>'', 'selected'=>'']);
   }
   
	protected function findModel($id)
    {
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionRestore(){
       
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        // print_r($user);die();
        $modelPeriode = new Store();
        $datas = StoreSearch::find()->where(['and','ACCESS_GROUP='.$user.'','STATUS=3'])->all();
        $items = ArrayHelper::map($datas, 'STORE_ID', 'STORE_NM');
        // print_r($items);die();
		if ($modelPeriode->load(Yii::$app->request->post())) {
                // $modelPeriode;
                // print_r($modelPeriode);die();
            foreach ($modelPeriode['STATUS'] as $value) {
                $datas = Store::findOne(['STORE_ID' => $value]);
                $datas->STATUS=2;
                // print_r($datas);die();
                $datas->save(false);
            }
            
	// $id=Yii::$app->request->cookies;
    //         $storeId=$id->getValue('STORE_ID');
    //         print_r($storeId);die();
            $tes=Yii::$app->response->cookies->remove('STORE_ID');
            // print_r($tes);die();
            
            Yii::$app->session->setFlash('success', "Restore Berhasil");
            return $this->redirect('/master/store');
        }else {
            return $this->renderAjax('form_restore',[
				'modelPeriode' => $modelPeriode,
                'items'=>$items
			]);
	   }
	}

	public function actionExpandDetail() {
		$id=$_POST['expandRowKey'];		
		if($id==0){ 
			//== Detail Toko ==
			//$modelToko=Store::find()->where(['STORE_ID'=>])->all();
			return $this->renderPartial('_detailToko',[
				//'data'=>$_POST['expandRowKey'],
				//'modelToko'=>$modelToko
			]);
		}elseif($id==1){
			//== Detail Prodak==
			return $this->renderPartial('_detailProduk',['data'=>$_POST['expandRowKey']]);
		}elseif($id==2){
			//== Detail Pelanggan==
			return $this->renderPartial('_detailPelanggan',['data'=>$_POST['expandRowKey']]);
		}elseif($id==3){
			//== Detail Karyawan==
			return $this->renderPartial('_detailkaryawan',['data'=>$_POST['expandRowKey']]);
		}elseif($id==4){
			//== Detail User Operatioal==
			return $this->renderPartial('_detailUserOps',['data'=>$_POST['expandRowKey']]);
		}
		// if (isset($_POST['expandRowKey'])) {
			// $model = \app\models\Book::findOne($_POST['expandRowKey']);
			// return $this->renderPartial('_book-details', ['model'=>$model]);
		// } else {
			// return '<div class="alert alert-danger">No data found</div>';
		// }
		
		
	}
    /**
     * Depdrop Sub Industry - depedence Province
     * @author Piter
     * @since 1.1.0
     * @return mixed
     */
    public function actionIndustry() {
        $out = [];
            if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                    $id = $parents[0];
                    $model = Industry::find()->asArray()->where(['INDUSTRY_GRP_ID'=>$id])->all();														
                                                            
                    foreach ($model as $key => $value) {
                    $out[] = ['id'=>$value['INDUSTRY_ID'],'name'=> $value['INDUSTRY_NM']];
                    } 
                    echo json_encode(['output'=>$out, 'selected'=>'']);
                    return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdateproduk($id)
    {
        $model = Product::findOne($id);        
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
                    $model->INDUSTRY_ID=$data->INDUSTRY_ID;
                    $model->INDUSTRY_GRP_ID=$data->INDUSTRY_GRP_ID;
                    $model->INDUSTRY_NM=$data->INDUSTRY_NM;
                    $model->INDUSTRY_GRP_NM=$data->INDUSTRY_GRP_NM;
                    $model->PRODUCT_SIZE_UNIT=$dataunit->UNIT_NM;
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
            
            Yii::$app->session->setFlash('success', "Perubahan Data Berhasil");
            return $this->redirect(array('/master/store#w17-tab1'));
            }                               
            
        } else {
            return $this->renderAjax('/data-barang/update', [
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
            return $this->redirect(array('/master/store#w17-tab1'));
           }
        } else{
            $searchModel = new ProductDiscountSearch(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
            return $this->renderAjax('/data-barang/_form_discount', [
                'model' => $model,
                'searchModel'=>$searchModel,
                'dataProvider' => $dataProvider,
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
            return $this->redirect(array('/master/store#w17-tab1'));
           }
        }
        $searchModel = new ProductPromoSearch(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('/data-barang/_form_promo', [
            'model' => $model,
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
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
            return $this->redirect(array('/master/store#w17-tab1'));
           }
        }
        $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>$ACCESS_GROUP,'PRODUCT_ID'=>$PRODUCT_ID,'STORE_ID'=>$STORE_ID]);
        $dataProviderHarga = $searchModelHarga->search(Yii::$app->request->queryParams);

        return $this->renderAjax('/data-barang/_form_harga', [
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
            return $this->redirect(array('/master/store#w17-tab1'));
           }
        }

        return $this->renderAjax('/data-barang/_form_stock', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing StoreKasir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSwitch($KASIR_ID)
    {
        $model = StoreKasir::findOne($KASIR_ID);;

        if ($model->load(Yii::$app->request->post())) {
            
            // print_r($model->PERANGKAT_UUID);die();
            Yii::$app->db->createCommand()
            ->update('STORE_KASIR', ['PERANGKAT_UUID' => $model->PERANGKAT_UUID], 'KASIR_ID="'.$model->KASIR.'"')
            ->execute();
            Yii::$app->db->createCommand()
            ->update('STORE_KASIR', ['PERANGKAT_UUID' => null], 'KASIR_ID="'.$model->KASIR_ID.'"')
            ->execute();

                return $this->redirect(['index#w20-tab5']);
        }

        return $this->renderAjax('_form_switch', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing StoreKasir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBayar($KASIR_ID)
    {
        $model = StoreKasir::findOne($KASIR_ID);;

        if ($model->load(Yii::$app->request->post())) {
            // print_r($model);die();
            if ($model->save(false)) {
                
                Yii::$app->session->setFlash('success', "Perangkat derhasil dibuat");
                return $this->redirect(['index#w20-tab5']);   
            }
        }

        return $this->renderAjax('_form_setting', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreKasir model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteKasir($id)
    {
       // $this->findModel($ID, $PRODUCT_ID, $YEAR_AT, $MONTH_AT)->delete();
       $model = StoreKasir::findOne($id);
       $model->STATUS ="3";
       $model->update();
       // Yii::$app->session->setFlash('error', "Data Berhasil dihapus");

       Yii::$app->session->setFlash('success', "Penghapusan Berhasil");
       return $this->redirect(['index']);
    }
    public function actionExport()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
        $searchModel = new Store();
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
					['STORE_NM','PROVINCE_NM','CITY_NAME','LATITUDE','LONGITUDE','ALAMAT','PIC','TLP','FAX','INDUSTRY_NM','INDUSTRY_GRP_NM','DCRP_DETIL','STATUS']
				],
			    'ceils' => $excel_ceilsDataProduk,
				'freezePane' => 'A2',
				'columnGroup'=>false,
                'autoSize'=>false,
                'headerColor' => Postman4ExcelBehavior::getCssClass("header"),
                'headerStyle'=>[	
					[
						'STORE_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PROVINCE_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'CITY_NAME' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'LATITUDE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'LONGITUDE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'ALAMAT' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PIC' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'TLP' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'FAX' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_GRP_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'STATUS' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
				],
			],
				'contentStyle'=>[
					[
						'STORE_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'PROVINCE_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],
						'CITY_NAME' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'LATITUDE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'LONGITUDE' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'ALAMAT' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'PIC' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'TLP' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'FAX' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'INDUSTRY_GRP_NM' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'DCRP_DETIL' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],				
						'STATUS' =>['font-size'=>'9','width'=>'15','valign'=>'center','align'=>'center'],	
					]
				],
			'oddCssClass' => Postman4ExcelBehavior::getCssClass("odd"),
			'evenCssClass' => Postman4ExcelBehavior::getCssClass("even"),			
		];
		// print_r($excel_ceilsDatakaryawan);
		// die();
		$excel_file = "data-Store";
		$this->export4excel($excel_content, $excel_file,0); 

		// return $this->redirect(['index']);
    }
    public function actionPaket()
    {
        $searchModel = new StoreMembershipPaketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderAjax('paket', [
            'dataProvider' => $dataProvider,
        ]);
    }
}

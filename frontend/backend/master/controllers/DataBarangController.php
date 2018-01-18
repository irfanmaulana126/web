<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Store;
use yii\web\UploadedFile;
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

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model=new Product;
        $searchModel = new AllStoreItemSearch(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelDiscount = new ProductDiscountSearch(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP]);
        $dataProviderDiscount = $searchModelDiscount->search(Yii::$app->request->queryParams);

        $searchModelPromo = new ProductPromoSearch(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP]);
        $dataProviderPromo = $searchModelPromo->search(Yii::$app->request->queryParams);

        $searchModelHarga = new ProductHargaSearch(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP]);
        $dataProviderHarga = $searchModelHarga->search(Yii::$app->request->queryParams);
		 return $this->render('index', [
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
			'searchModelDiscount'=>$searchModelDiscount,
            'dataProviderDiscount' => $dataProviderDiscount,
			'searchModelPromo'=>$searchModelPromo,
            'dataProviderPromo' => $dataProviderPromo,
			'searchModelHarga'=>$searchModelHarga,
            'dataProviderHarga' => $dataProviderHarga,
            'model'=>$model,
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
        $image = new ProductImage();

        if ($model->load(Yii::$app->request->post()) && $image->load(Yii::$app->request->post())) {
            $model->CREATE_AT=date('Y-m-d H:i:s');
            if($model->save(false)) {
                $transaction = Yii::$app->db->beginTransaction();
            $image->CREATE_AT=date('Y-m-d H:i:s');
            $gambar = UploadedFile::getInstance($image, 'PRODUCT_IMAGE');
            $gambar->saveAs(Yii::getAlias('@frontend/web/img/') . '.' . $gambar->extension);
            $image->PRODUCT_IMAGE = 'gambar.' . $gambar->extension;
            $image->STORE_ID=$model->STORE_ID;
            $image->save(false);
                $transaction->commit();
                return $this->redirect(['index']);
            }
            else {
                $transaction->rollBack();
            }
        } else {
    //   print_r($store_id);die();
            return $this->renderAjax('_form', [
                'model' => $model,
                'image'=>$image,
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
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->STATUS ="3";
        $model->update();
        // print_r($model);die();
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

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }
}

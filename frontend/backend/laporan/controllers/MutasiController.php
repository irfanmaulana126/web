<?php

namespace frontend\backend\laporan\controllers;

use Yii;
use yii\web\Controller;
use frontend\backend\laporan\models\TransOpenclose;
use frontend\backend\laporan\models\TransOpencloseSearch;
use frontend\backend\laporan\models\TransStoranImage;

class MutasiController extends Controller
{
    public function actionIndex()
    {

		$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
		$paramCari=Yii::$app->getRequest()->getQueryParam('id');
        $searchModel = new TransOpencloseSearch(['ACCESS_GROUP'=>$user]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'paramCari'=>$paramCari
        ]);
    }
	
	/**
	 * IMAGE - DETAIL DISPLY 
	 * @author Piter Novian [ptr.nov@gmail.com]
	 * @since 2.0
	*/
	public function actionDisplyImage($id)
    {
		//print_r($tgl);
		//die();
		// $searchModelViewImg = new CustomercallTimevisitSearch(['TGL'=>$tgl,'USER_ID'=>$user_id]);
		// $dataProviderViewImg=$searchModelViewImg->search(Yii::$app->request->queryParams);
		// $listImg=$dataProviderViewImg->getModels();
		//if (Yii::$app->request->isAjax) {
			// $request= Yii::$app->request;
			// $id=$request->post('id');
			// $roDetail = Purchasedetail::findOne($id);
			// $roDetail->STATUS = 3;
			// $roDetail->save();
			// return true;
			// $model = new \yii\base\DynamicModel(['tanggal']);
			// $model->addRule(['tanggal'], 'safe');
			$modelStoran= TransStoranImage::find()->where(['OPENCLOSE_ID'=>$id])->one();
			// print_r($modelStoran);die();
			return $this->renderAjax('_viewImageModal',[
				'model'=>$modelStoran
			]);
			
		//}
    }
}

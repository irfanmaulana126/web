<?php

namespace frontend\backend\sistem\controllers;

use Yii;
use frontend\backend\sistem\models\Corp;
use frontend\backend\sistem\models\CorpSearch;
use frontend\backend\sistem\models\CorpImage;
use frontend\backend\sistem\models\CorpImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CorpController implements the CRUD actions for Corp model.
 */
class CorpController extends Controller
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
     * Lists all Corp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CorpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Corp model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $image = CorpImage::find()->where(['ACCESS_ID'=>$model['ACCESS_ID']])->one();
        // print_r($image);die();
        if(empty($image)){
            $image = new CorpImage();
        }
        return $this->renderAjax('view', [
            'model' => $model,
            'image' => $image,
        ]);
    }

    /**
     * Creates a new Corp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Corp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Corp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = CorpImage::find()->where(['ACCESS_ID'=>$model['ACCESS_ID']])->one();
        // print_r($image);die();
        if(empty($image)){
            $image = new CorpImage();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!empty(UploadedFile::getInstance($image, 'CORP_64'))) {
                $transaction = Yii::$app->db->beginTransaction();
                $image->ACCESS_ID=$model['ACCESS_ID'];
                $upload_file = $image->uploadImage();
                $data_base64 = $upload_file != ''? $this->saveimage(file_get_contents($upload_file->tempName)): ''; //call function saveimage using base64
                $image->CORP_64 = 'data:image/*;charset=utf-8;base64,'.$data_base64;
                Yii::$app->db->createCommand("
                UPDATE corp_64 SET CORP_64='".$image->CORP_64."' WHERE ACCESS_ID='".$image->ACCESS_ID."'")->execute();
                $transaction->commit();
            }
        Yii::$app->session->setFlash('success', "Perubahan Data Berhasil");
            return $this->redirect(['/sistem/user-profile']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'image' => $image,
            ]);
        }
    }

    /**
     * Deletes an existing Corp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function saveimage($base64)
    {
    $base64 = str_replace('data:image/jpg;base64,', '', $base64);
    $base64 = base64_encode($base64);
    $base64 = str_replace('data:image/jpg;base64,', '+', $base64);
    return $base64;
    }
    /**
     * Finds the Corp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Corp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Corp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

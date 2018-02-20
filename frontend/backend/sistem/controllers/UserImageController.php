<?php

namespace frontend\backend\sistem\controllers;

use Yii;
use frontend\backend\sistem\models\UserImage;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
use kartik\widgets\ActiveForm;
class UserImageController extends Controller
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
    public function actionUpdate($ACCESS_ID)
    {

        $model = new UserImage;  

        if ($model->load(Yii::$app->request->post())) {
            $data=UploadedFile::getInstance($model, 'ACCESS_IMAGE');
            // print_r($data->size);die();
            if($data->size>=512000){
                Yii::$app->session->setFlash('error', 'Ukuran File anda '.$data->size.' bytes Terlalu Besar. Maksimal 51200 bytes/500KB');
                $this->redirect(array('/sistem/user-profile')); 
            }else{
                if (!empty(UploadedFile::getInstance($model, 'ACCESS_IMAGE'))) {
                    $transaction = Yii::$app->db->beginTransaction();
                    $upload_file = $model->uploadImage();
                    $data_base64 = $upload_file != ''? $this->saveimage(file_get_contents($upload_file->tempName)): ''; //call function saveimage using base64
                    $model->ACCESS_IMAGE = 'data:image/*;charset=utf-8;base64,'.$data_base64;                           
                    $transaction->commit();


                        $transaction = Yii::$app->db->beginTransaction();
                        $upload_file = $model->uploadImage();
                        $data_base64 = $upload_file != ''? $this->saveimage(file_get_contents($upload_file->tempName)): ''; //call function saveimage using base64
                        $model->ACCESS_IMAGE = 'data:image/*;charset=utf-8;base64,'.$data_base64;
                        $count =  UserImage::find()->where(['ACCESS_ID' =>$ACCESS_ID ])->count();
                        if ($count==0) {
                            Yii::$app->db->createCommand("INSERT INTO user_image (ACCESS_ID, ACCESS_IMAGE, CREATE_AT)VALUES ('".$ACCESS_ID."', '".$model->ACCESS_IMAGE."', '".date('Y-m-d')."');")->execute();
                        } else if($count==1){
                            Yii::$app->db->createCommand("UPDATE user_image SET ACCESS_IMAGE='".$model->ACCESS_IMAGE."' WHERE ACCESS_ID='".$ACCESS_ID."'")->execute();
                        }
                        $transaction->commit();
                    }

                Yii::$app->session->setFlash('success', "Berhasil Di Perbarui");
                $this->redirect(array('/sistem/user-profile')); 
                }
        }
        // $errores = $model->getErrors();
        // print_r($errores);die();
        // Yii::$app->session->setFlash('error', $errores);
        $this->redirect(array('/sistem/user-profile')); 
    }

    public function saveimage($base64)
    {
    $base64 = str_replace('data:image/jpg;base64,', '', $base64);
    $base64 = base64_encode($base64);
    $base64 = str_replace('data:image/jpg;base64,', '+', $base64);
    return $base64;
    }
    protected function findModel($ACCESS_ID)
    {
        if (($model = UserImage::findOne(['ACCESS_ID' => $ACCESS_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}

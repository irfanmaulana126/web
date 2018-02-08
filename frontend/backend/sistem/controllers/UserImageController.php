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
    public function actionValImage(){
        $model = new UserImage;
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if (!$model->validate()) {
                return ActiveForm::validate($model);
            }
        }
    }
    public function actionUpdate($ACCESS_ID)
    {

        $model = new UserImage;  

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->validate()){
                // throw new NotAcceptableHttpException('Tiene errores de validación en la forma');
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

<?php

namespace frontend\backend\sistem\controllers;

use Yii;
use frontend\backend\sistem\models\User;
use frontend\backend\sistem\models\UserProfile;
use frontend\backend\sistem\models\UserProfileSearch;
use frontend\backend\sistem\models\UserImage;
use frontend\backend\sistem\models\Store;
use frontend\backend\sistem\models\StoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends Controller
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
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = (empty(Yii::$app->user->identity->ACCESS_ID)) ? '' : Yii::$app->user->identity->ACCESS_ID;
        
        $dataProvider = UserProfileSearch::find()->where(['ACCESS_ID'=>$user])->one();
        $dataProviderimage = UserImage::find()->where(['ACCESS_ID'=>$user])->one();
        $searchModelstore = new StoreSearch(['ACCESS_GROUP'=>$user]);
        $dataProviderstore = $searchModelstore->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModelstore' => $searchModelstore,
            'dataProviderstore' => $dataProviderstore,
            'dataProviderimage'=>$dataProviderimage
        ]);
    }

    /**
     * Displays a single UserProfile model.
     * @param string $ID
     * @param string $ACCESS_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ID, $ACCESS_ID, $YEAR_AT, $MONTH_AT)
    {
        return $this->render('view', [
            'model' => $this->findModel($ID, $ACCESS_ID, $YEAR_AT, $MONTH_AT),
        ]);
    }

    /**
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ID' => $model->ID, 'ACCESS_ID' => $model->ACCESS_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ID
     * @param string $ACCESS_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ACCESS_ID)
    {
        $model = $this->findModel($ACCESS_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Change Password Berhasil");
            return $this->redirect(['index']);      
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ID
     * @param string $ACCESS_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ACCESS_ID)
    {
        $this->findModel($ACCESS_ID)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionChange($ACCESS_ID)
    {
        $model =  User::findOne(['ACCESS_ID' => $ACCESS_ID]);
        if ($model->load(Yii::$app->request->post())) {
            $model->Password = $model->newPassword;
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', "Change Password Berhasil");
                return $this->redirect(['index']);   
            }
        return $this->redirect(['index']);
        }

        return $this->renderAjax('change', [
            'model' => $model,
        ]);
    }
    /**
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ID
     * @param string $ACCESS_ID
     * @param integer $YEAR_AT
     * @param integer $MONTH_AT
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ACCESS_ID)
    {
        if (($model = UserProfile::findOne(['ACCESS_ID' => $ACCESS_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

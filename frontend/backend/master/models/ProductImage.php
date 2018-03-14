<?php

namespace frontend\backend\master\models;

use Yii;
use yii\web\UploadedFile;
use frontend\backend\master\models\Product;

Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/backend/master/image/';
 
class ProductImage extends \yii\db\ActiveRecord
{

	public $upload_file;
	public $image;
	public static function getDb()
    {
        return Yii::$app->get('api_dbkg');
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_GROUP','CREATE_AT', 'UPDATE_AT','PRODUCT_IMAGE'], 'safe'],
            [['STATUS'], 'integer'],
            [['upload_file'], 'file', 'skipOnEmpty' => true,'extensions'=>'jpg,png', 'mimeTypes'=>'image/jpeg, image/png',],
			[['PRODUCT_IMAGE'],'file','skipOnEmpty'=>TRUE,'extensions'=>'jpg, png'],
            [['CREATE_BY', 'UPDATE_BY', 'PRODUCT_ID', 'STORE_ID'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
            'STATUS' => Yii::t('app', 'Status'),
            'ACCESS_GROUP' => Yii::t('app', 'Access Unix'),
            'PRODUCT_ID' => Yii::t('app', 'Item  ID'),
            'STORE_ID' => Yii::t('app', 'Outlet  Code'),
            'PRODUCT_IMAGE' => Yii::t('app', 'IMAGE'),
        ];
    }
	// public function fields()
	// {
	// 	return [			
	// 		'CREATE_AT'=>function($model){
	// 			return $model->CREATE_AT;
	// 		},
	// 		'UPDATE_AT'=>function($model){
	// 			return $model->UPDATE_AT;
	// 		},					
	// 		'IMG64'=>function($model){
	// 			return $model->IMG64!=''?$model->IMG64:$this->blankImage;
	// 		}	
	// 	];
	// }
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'PRODUCT_IMAGE');
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        // store the source file name
        //$this->filename = $image->name;
        $tmp = explode('.', $image->name);
        $ext = end($tmp);
        // generate a unique file name
        // $this->EMP_IMG = 'wan-'.date('ymdHis').".{$ext}"; //$image->name;//Yii::$app->security->generateRandomString().".{$ext}";
        // the uploaded image instance
        return $image;
    }
	public function getProduct()
    {
        return $this->hasOne(Product::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }
	
}


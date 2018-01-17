<?php

namespace frontend\backend\master\models;

use Yii;
use yii\web\UploadedFile;

Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/backend/master/image/';
 
class ProductImage extends \yii\db\ActiveRecord
{
	public $imageTmp;
	
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
	public function fields()
	{
		return [			
			'CREATE_AT'=>function($model){
				return $model->CREATE_AT;
			},
			'UPDATE_AT'=>function($model){
				return $model->UPDATE_AT;
			},					
			'IMG64'=>function($model){
				return $model->IMG64!=''?$model->IMG64:$this->blankImage;
			}	
		];
	}
	
	
	
}


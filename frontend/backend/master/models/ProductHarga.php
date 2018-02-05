<?php

namespace frontend\backend\master\models;

use Yii;
use frontend\backend\master\models\Product;
use frontend\backend\master\models\Store;
/**
 * This is the model class for table "product_harga".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PRODUCT_ID
 * @property string $PERIODE_TGL1
 * @property string $PERIODE_TGL2
 * @property string $START_TIME
 * @property string $HARGA_JUAL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class ProductHarga extends \yii\db\ActiveRecord
{
    public $margin;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_harga';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('production_api');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODUCT_ID', 'YEAR_AT', 'margin','MONTH_AT','PERIODE_TGL1', 'PERIODE_TGL2','HPP', 'HARGA_JUAL','PPN'], 'required'],
            [['PERIODE_TGL1', 'PERIODE_TGL2', 'START_TIME', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['HARGA_JUAL','PPN'], 'number'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['PRODUCT_ID'], 'string', 'max' => 35],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'PRODUCT_ID' => 'Product  ID',
            'PERIODE_TGL1' => 'Periode  Tanggal awal',
            'PERIODE_TGL2' => 'Periode  Tanggal Akhir',
            'START_TIME' => 'Start  Time',
            'HARGA_JUAL' => 'Harga  Jual',
            'PPN' => 'PPN',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Deskripsi',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
    public function getStore()
    {
        if ($this->STORE_ID){
            return $this->hasOne(Store::className(),['STORE_ID'=>'STORE_ID']);
        }else{
            return '';
        }
    }
    public function getProduct()
    {
        return $this->hasOne(Product::className(),['PRODUCT_ID'=>'PRODUCT_ID']);
    }


    public function getPRODUCT_NM(){
        $result=$this->product;
        return $result=$result->PRODUCT_NM?:'';
    }
    public function getSTORE_NM(){
        $result=$this->store;
        return $result!=''?$result->STORE_NM:'';
    }
}

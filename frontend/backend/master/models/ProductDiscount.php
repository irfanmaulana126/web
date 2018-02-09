<?php

namespace frontend\backend\master\models;

use Yii;
use frontend\backend\master\models\Product;
use frontend\backend\master\models\Store;
/**
 * This is the model class for table "product_discount".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PRODUCT_ID
 * @property string $PERIODE_TGL1
 * @property string $PERIODE_TGL2
 * @property string $START_TIME
 * @property string $DISCOUNT Harga Jual
 * @property string $CREATE_BY USER pembuat
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY user Ubah
 * @property string $UPDATE_AT Tanggal diubah
 * @property int $STATUS
 * @property string $DCRP_DETIL
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 */
class ProductDiscount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODUCT_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['PERIODE_TGL1', 'PERIODE_TGL2', 'START_TIME', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DISCOUNT'], 'number'],
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
            'ACCESS_GROUP' => 'ACCESS GROUP',
            'STORE_ID' => 'STORE ID',
            'PRODUCT_ID' => 'PRODUCT ID',
            'PERIODE_TGL1' => 'PERIODE TANGGAL AWAL',
            'PERIODE_TGL2' => 'Periode  TANGGAL AKHIR',
            'START_TIME' => 'START TIME',
            'DISCOUNT' => 'DISCOUNT',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'STATUS',
            'DCRP_DETIL' => 'DESKRIPSI',
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
        // if ($this->PRODUCT_ID){
            return $this->hasOne(Product::className(),['PRODUCT_ID'=>'PRODUCT_ID']);
        // }else{
        //     return '';
        // }
    }

    public function getPRODUCT_NM(){
        $result=$this->product;
        // print_r($result);die();
        return $result=$result['PRODUCT_NM']?:'';
    }
    public function getSTORE_NM(){
        $result=$this->store;
        return $result!=''?$result->STORE_NM:'';
    }
}

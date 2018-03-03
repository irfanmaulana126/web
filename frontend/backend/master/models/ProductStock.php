<?php

namespace frontend\backend\master\models;

use Yii;
use frontend\backend\master\models\Product;
use frontend\backend\master\models\Store;

/**
 * This is the model class for table "product_stock".
 *
 * @property string $ID
 * @property string $STOK_UNIK
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PRODUCT_ID
 * @property string $SUPPLIER_ID
 * @property string $SUPPLIER_NM
 * @property double $LAST_STOCK Jumlah Stock Yang lalu < INPUT_DATE & INPUT_TIME
 * @property string $INPUT_DATE Stock Masuk = INPUT_DATE
 * @property string $INPUT_TIME Stock Masuk = INPUT_TIME
 * @property double $INPUT_STOCK Jumlah Stock Masuk = INPUT_TIME
 * @property string $CURRENT_DATE Stock berjalan >=INPUT_DATE
 * @property string $CURRENT_TIME Stock berjalan >=INPUT_TIME
 * @property double $CURRENT_STOCK Jumlah Stock berjalan >=INPUT_DATE & INPUT_TIME
 * @property double $SISA_STOCK Sisa Stock berjalan >=INPUT_DATE & INPUT_TIME
 * @property string $CREATE_BY USER pembuat
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY user Ubah
 * @property string $UPDATE_AT Tanggal diubah
 * @property string $CREATE_UUID
 * @property string $UPDATE_UUID
 * @property int $STATUS
 * @property string $DCRP_DETIL
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 */
class ProductStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODUCT_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['LAST_STOCK', 'INPUT_STOCK', 'CURRENT_STOCK', 'SISA_STOCK'], 'number'],
            [['INPUT_DATE', 'INPUT_TIME', 'CURRENT_DATE', 'CURRENT_TIME', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['DCRP_DETIL'], 'string'],
            [['STOK_UNIK', 'SUPPLIER_ID'], 'string', 'max' => 100],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['PRODUCT_ID'], 'string', 'max' => 35],
            [['SUPPLIER_NM', 'CREATE_UUID', 'UPDATE_UUID'], 'string', 'max' => 255],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['STOK_UNIK', 'YEAR_AT', 'MONTH_AT'], 'unique', 'targetAttribute' => ['STOK_UNIK', 'YEAR_AT', 'MONTH_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'STOK_UNIK' => 'Stok  Unik',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'PRODUCT_ID' => 'Product  ID',
            'SUPPLIER_ID' => 'Supplier  ID',
            'SUPPLIER_NM' => 'Supplier  Nm',
            'LAST_STOCK' => 'Last  Stock',
            'INPUT_DATE' => 'Input  Date',
            'INPUT_TIME' => 'Input  Time',
            'INPUT_STOCK' => 'Input  Stock',
            'CURRENT_DATE' => 'Current  Date',
            'CURRENT_TIME' => 'Current  Time',
            'CURRENT_STOCK' => 'Current  Stock',
            'SISA_STOCK' => 'Sisa  Stock',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'CREATE_UUID' => 'Create  Uuid',
            'UPDATE_UUID' => 'Update  Uuid',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
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

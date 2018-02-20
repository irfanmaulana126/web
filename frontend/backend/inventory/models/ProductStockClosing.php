<?php

namespace frontend\backend\inventory\models;

use Yii;
use frontend\backend\master\models\Store;
use frontend\backend\master\models\Product;
/**
 * This is the model class for table "product_stock_closing".
 *
 * @property string $UNIX_BULAN_ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PRODUCT_ID
 * @property string $TAHUN
 * @property int $BULAN Stock Masuk = INPUT_DATE
 * @property double $STOCK_AWAL Jumlah Stock Yang lalu < INPUT_DATE & INPUT_TIME
 * @property double $STOCK_BARU
 * @property double $STOCK_TERJUAL
 * @property double $STOCK_REFUND
 * @property double $STOCK_AKHIR
 * @property double $STOCK_BALANCE_CLOSING
 * @property double $STOCK_INPUT_ACTUAL
 * @property double $STOCK_AKHIR_ACTUAL
 * @property double $STOCK_AWAL_ACTUAL
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
class ProductStockClosing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_stock_closing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UNIX_BULAN_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['BULAN', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['STOK_CLOSING','STOCK_BALANCE_BULAN','STOCK_AWAL', 'STOCK_BARU', 'STOCK_TERJUAL', 'STOCK_REFUND', 'STOCK_AKHIR', 'STOCK_BALANCE_CLOSING', 'STOCK_INPUT_ACTUAL', 'STOCK_AKHIR_ACTUAL', 'STOCK_AWAL_ACTUAL'], 'number'],
            [['CREATE_AT', 'UPDATE_AT','storeNm','produkNm'], 'safe'],
            [['DCRP_DETIL'], 'string'],
            [['UNIX_BULAN_ID'], 'string', 'max' => 150],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['PRODUCT_ID'], 'string', 'max' => 35],
            [['TAHUN'], 'string', 'max' => 5],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['CREATE_UUID', 'UPDATE_UUID'], 'string', 'max' => 255],
            [['UNIX_BULAN_ID', 'ACCESS_GROUP', 'STORE_ID', 'PRODUCT_ID', 'TAHUN', 'BULAN', 'YEAR_AT', 'MONTH_AT'], 'unique', 'targetAttribute' => ['UNIX_BULAN_ID', 'ACCESS_GROUP', 'STORE_ID', 'PRODUCT_ID', 'TAHUN', 'BULAN', 'YEAR_AT', 'MONTH_AT']],
            [['UNIX_BULAN_ID', 'YEAR_AT', 'MONTH_AT'], 'unique', 'targetAttribute' => ['UNIX_BULAN_ID', 'YEAR_AT', 'MONTH_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNIX_BULAN_ID' => 'UNIX_BULAN_ID',
            'ACCESS_GROUP' => 'ACCESS_GROUP',
            'STORE_ID' => 'STORE_ID',
            'PRODUCT_ID' => 'PRODUCT_ID',
            'TAHUN' => 'TAHUN',
            'BULAN' => 'BULAN',
            'STOCK_AWAL' => 'STOCK_AWAL',
            'STOCK_BARU' => 'STOCK_BARU',
            'STOCK_TERJUAL' => 'STOCK_TERJUAL',
            'STOCK_REFUND' => 'STOCK_REFUND',
            'STOCK_AKHIR' => 'STOCK_AKHIR',
            'STOCK_BALANCE_CLOSING' => 'STOCK_BALANCE_CLOSING',
            'STOK_CLOSING' => 'STOK_CLOSING',
            'STOCK_INPUT_ACTUAL' => 'STOCK_INPUT_ACTUAL',
            'STOCK_BALANCE_BULAN' => 'BALANCE_BULAN',
            'STOCK_AKHIR_ACTUAL' => 'STOCK_AKHIR_ACTUAL',
            'STOCK_AWAL_ACTUAL' => 'STOCK_AWAL_ACTUAL',
            'CREATE_BY' => 'CREATE_BY',
            'CREATE_AT' => 'CREATE_AT',
            'UPDATE_BY' => 'UPDATE_BY',
            'UPDATE_AT' => 'UPDATE_AT',
            'CREATE_UUID' => 'CREATE_UUID',
            'UPDATE_UUID' => 'UPDATE_UUID',
            'STATUS' => 'STATUS',
            'DCRP_DETIL' => 'DCRP_DETIL',
            'YEAR_AT' => 'YEAR_AT',
            'MONTH_AT' => 'MONTH_AT',
        ];
    }
	
	public function getStoreTbl(){
		return $this->hasOne(Store::className(), ['STORE_ID' => 'STORE_ID']);
	}	
	public function getStoreNm(){
		$rslt = $this->storeTbl['STORE_NM'];
		if ($rslt){
			return $rslt;
		}else{
			return "none";
		}; 
	}
	
	public function getProdukTbl(){
		return $this->hasOne(Product::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
	}	
	public function getProdukNm(){
		$rslt = $this->produkTbl['PRODUCT_NM'];
		if ($rslt){
			return $rslt;
		}else{
			return "none";
		}; 
	}
}

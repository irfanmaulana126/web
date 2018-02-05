<?php

namespace frontend\backend\master\models;

use Yii;

use frontend\backend\master\models\Store;
use frontend\backend\master\models\ProductImage;
/**
 * This is the model class for table "product".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $GROUP_ID
 * @property string $PRODUCT_ID
 * @property string $PRODUCT_QR Untuk barcode sendiri
 * @property string $PRODUCT_NM
 * @property string $PRODUCT_WARNA
 * @property string $PRODUCT_SIZE nilai isi 
 * @property string $PRODUCT_SIZE_UNIT satuan ukuran isi; join tbl satuan.UNIT_ID
 * @property string $PRODUCT_HEADLINE keterangan header prodak item
 * @property string $UNIT_ID id satuan dalam jual; join tbl satuan.UNIT_ID
 * @property double $STOCK_LEVEL Minimum Stock Notify
 * @property double $CURRENT_STOCK
 * @property string $CURRENT_HPP
 * @property string $CURRENT_PRICE
 * @property string $INDUSTRY_ID
 * @property string $INDUSTRY_NM
 * @property string $INDUSTRY_GRP_ID
 * @property string $INDUSTRY_GRP_NM
 * @property string $IMG_FILE
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
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STORE_ID', 'PRODUCT_ID','STOCK_LEVEL', 'YEAR_AT','PRODUCT_NM', 'MONTH_AT'], 'required'],
            [['PRODUCT_SIZE', 'STOCK_LEVEL', 'CURRENT_STOCK', 'CURRENT_HPP', 'CURRENT_PRICE','PPN'], 'number'],
            [['INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['GROUP_ID', 'PRODUCT_QR', 'PRODUCT_NM', 'PRODUCT_HEADLINE'], 'string', 'max' => 100],
            [['PRODUCT_ID'], 'string', 'max' => 35],
            [['PRODUCT_WARNA', 'PRODUCT_SIZE_UNIT', 'UNIT_ID', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['INDUSTRY_NM', 'INDUSTRY_GRP_NM', 'IMG_FILE', 'CREATE_UUID', 'UPDATE_UUID'], 'string', 'max' => 255],
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
            'STORE_ID' => 'Store',
            'GROUP_ID' => 'Group Product',
            'PRODUCT_ID' => 'Product  ID',
            'PRODUCT_QR' => 'Product  QR',
            'PRODUCT_NM' => 'Nama Produk',
            'PRODUCT_WARNA' => 'Warna Produk',
            'PRODUCT_SIZE' => 'Size Produk',
            'PRODUCT_SIZE_UNIT' => 'Size Unit Produk',
            'PRODUCT_HEADLINE' => 'Produk Headline',
            'UNIT_ID' => 'Unit Produk',
            'STOCK_LEVEL' => 'Stock Level',
            'CURRENT_STOCK' => 'Current Stock',
            'CURRENT_HPP' => 'Current  Hpp',
            'CURRENT_PRICE' => 'Harga',
            'CURRENT_PPN' => 'PPN',
            'INDUSTRY_ID' => 'Industry  ID',
            'INDUSTRY_NM' => 'Industri',
            'INDUSTRY_GRP_ID' => 'Industry  Grp  ID',
            'INDUSTRY_GRP_NM' => 'Group Industri',
            'IMG_FILE' => 'Gambar',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'CREATE_UUID' => 'Create  Uuid',
            'UPDATE_UUID' => 'Update  Uuid',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Deskripsi',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
    public function getProductHargaTbl(){
		//Check Table Harga where PRODUCT_ID,PERIODE_TGL1 AND PERIODE_TGL2 to current_date
		$modalHarga= ProductHarga::find()->where("
			PRODUCT_ID='".$this->PRODUCT_ID."' AND 
			('".date('Y-m-d')."' BETWEEN PERIODE_TGL1 AND PERIODE_TGL2)
		")->one();
		
		if($modalHarga){
			//Jika ditemukan data pada table harga, maka harga tersebut di simpan pada table "product->CURRENT_PRICE"
			$modalProduct = Product::find()->where(['PRODUCT_ID' =>$this->PRODUCT_ID])->one();
			$modalProduct->CURRENT_PRICE=$modalHarga->HARGA_JUAL;
			$modalProduct->save();
			return  $modalHarga->HARGA_JUAL;
		}else{
			//Jika Tidak ditemukan perubahan data pada table harga, seting default CURRENT_PRICE
			//return  0;
			return $this->CURRENT_PRICE!=''?$this->CURRENT_PRICE:'0';	
		}
	}	
	
	/*
	 * CURRENT STOCK 
	 * Join to Table Stock where PRODUCT_ID, (current_date PERIODE_TGL1 AND PERIODE_TGL2)
	*/
	public function getProductStockTbl(){
		$modalStock= ProductStock::find()->where("
			PRODUCT_ID='".$this->PRODUCT_ID."' AND INPUT_DATE='".date('Y-m-d')."'
		")->one();
		if($modalStock){			
			return  $modalStock->INPUT_STOCK;
		}else{
			return  0;	
		}
    }
    public function getStore()
    {
        if ($this->STORE_ID){
            return $this->hasOne(Store::className(),['STORE_ID'=>'STORE_ID']);
        }else{
            return '';
        }
    }
    public function getImage()
    {
        return $this->hasOne(ProductImage::className(),['PRODUCT_ID'=>'PRODUCT_ID']);
    }
    public function getGambar(){
        $result=$this->image;
        return $result!=''?$result->PRODUCT_IMAGE:'';
    }
    public function getSTORE_NM(){
        $result=$this->store;
        return $result!=''?$result->STORE_NM:'';
    }
}

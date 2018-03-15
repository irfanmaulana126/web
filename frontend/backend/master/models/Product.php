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

    public $uploadExport;
    public $state_2;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uploadExport'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx, xls'],
            [['STORE_ID', 'PRODUCT_ID','STOCK_LEVEL', 'YEAR_AT','PRODUCT_NM', 'MONTH_AT'], 'required'],
            [['PRODUCT_SIZE', 'STOCK_LEVEL', 'CURRENT_STOCK', 'CURRENT_HPP', 'CURRENT_PPN','CURRENT_PRICE'], 'number'],
            [['INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT','state_2'], 'safe'],
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
            'ACCESS_GROUP' => 'ACCESS GROUP',
            'STORE_ID' => 'STORE',
            'GROUP_ID' => 'GROUP PPRODUK',
            'PRODUCT_ID' => 'PRODUCT ID',
            'PRODUCT_QR' => 'PRODUCT QR',
            'PRODUCT_NM' => 'NAMA PRODUK',
            'PRODUCT_WARNA' => 'WARNA PRODUK',
            'PRODUCT_SIZE' => 'SIZE PRODUK',
            'PRODUCT_SIZE_UNIT' => 'SIZE UNIT PRODUK',
            'PRODUCT_HEADLINE' => 'PRODUK HEADLINE',
            'UNIT_ID' => 'UNIT PRODUK',
            'STOCK_LEVEL' => 'STOCK LEVEL',
            'CURRENT_STOCK' => 'STOCK',
            'CURRENT_HPP' => 'CURRENT HPP',
            'CURRENT_PRICE' => 'HARGA',
            'CURRENT_PPN' => 'PPN',
            'INDUSTRY_ID' => 'INDUSTRI ID',
            'INDUSTRY_NM' => 'INDUSTRI',
            'INDUSTRY_GRP_ID' => 'INDUSTRI GROUP ',
            'INDUSTRY_GRP_NM' => 'GROUP INDUSTRI',
            'IMG_FILE' => 'GAMBAR',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'CREATE_UUID' => 'Create  Uuid',
            'UPDATE_UUID' => 'Update  Uuid',
            'STATUS' => 'STATUS',
            'DCRP_DETIL' => 'DESKRIPSI',
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
    public function upload()
    {
        if (!$this->validate()) {
            $this->uploadExport->saveAs('uploads/' . $this->uploadExport->baseName . '.' . $this->uploadExport->extension);
            // print_r('true');die();
            return true;
        } else {
            // print_r('false');die();
            return false;
        }
    } 
}

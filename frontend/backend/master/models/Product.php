<?php

namespace frontend\backend\master\models;

use Yii;
use frontend\backend\master\models\ProductHarga;
use frontend\backend\master\models\ProductStock;

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
            [['STORE_ID', 'PRODUCT_ID','UNIT_ID_GRP','PRODUCT_NM','PRODUCT_SIZE','PRODUCT_SIZE_UNIT','PRODUCT_HEADLINE','CURRENT_STOCK','CURRENT_PRICE','PRODUCT_QR','PRODUCT_WARNA','STATUS','STOCK_LEVEL','CURRENT_HPP','UNIT_ID'], 'required'],
            [['CURRENT_STOCK'], 'integer'],
            [['PRODUCT_QR','CURRENT_PRICE','PRODUCT_SIZE','PRODUCT_NM','PRODUCT_SIZE_UNIT','PRODUCT_HEADLINE'], 'string',],
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
            'STORE_ID' => 'Nama Toko',
            'GROUP_ID' => 'Group  ID',
            'PRODUCT_ID' => 'Kode Produk',
            'PRODUCT_QR' => 'Kode QR',
            'PRODUCT_NM' => 'Nama Produk',
            'PRODUCT_WARNA' => 'Product  Warna',
            'PRODUCT_SIZE' => 'Product  Size',
            'PRODUCT_SIZE_UNIT' => 'Product  Size  Unit',
            'PRODUCT_HEADLINE' => 'Product  Headline',
            'UNIT_ID' => 'Unit  ID',
            'UNIT_ID_GRP'=>'Unit Group',
            'STOCK_LEVEL' => 'Stock  Level',
            'CURRENT_STOCK'=>'Current Stock',
            'CURRENT_HPP'=>'Current HPP',
            'CURRENT_PRICE'=>'Current Price',
            'INDUSTRY_ID' => 'Industry  ID',
            'INDUSTRY_NM' => 'Industry  Nm',
            'INDUSTRY_GRP_NM' => 'Industry  Grp  Nm',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
	
	/*
	 * CURRENT PRICE 
	 * Join to Table Harga where PRODUCT_ID, (current_date PERIODE_TGL1 AND PERIODE_TGL2)
	*/
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

}

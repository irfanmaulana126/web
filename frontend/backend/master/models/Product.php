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
            [['ACCESS_GROUP', 'STORE_ID', 'PRODUCT_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['GROUP_ID', 'UNIT_ID', 'INDUSTRY_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['PRODUCT_SIZE', 'STOCK_LEVEL'], 'number'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['productHargaTbl','productStockTbl'], 'safe'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['PRODUCT_ID'], 'string', 'max' => 35],
            [['PRODUCT_QR', 'PRODUCT_NM', 'PRODUCT_HEADLINE'], 'string', 'max' => 100],
            [['PRODUCT_WARNA', 'PRODUCT_SIZE_UNIT', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['INDUSTRY_NM', 'INDUSTRY_GRP_NM'], 'string', 'max' => 255],
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
            'GROUP_ID' => 'Group  ID',
            'PRODUCT_ID' => 'Product  ID',
            'PRODUCT_QR' => 'Product  Qr',
            'PRODUCT_NM' => 'Product  Nm',
            'PRODUCT_WARNA' => 'Product  Warna',
            'PRODUCT_SIZE' => 'Product  Size',
            'PRODUCT_SIZE_UNIT' => 'Product  Size  Unit',
            'PRODUCT_HEADLINE' => 'Product  Headline',
            'UNIT_ID' => 'Unit  ID',
            'STOCK_LEVEL' => 'Stock  Level',
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

<?php

namespace frontend\backend\laporan\models;

use Yii;
use frontend\backend\laporan\models\TransPenjualanHeader;
use common\models\Store;
/**
 * This is the model class for table "trans_penjualan_detail".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $ACCESS_ID
 * @property integer $GOLONGAN
 * @property string $TRANS_ID
 * @property string $OFLINE_ID
 * @property string $TRANS_DATE
 * @property string $PRODUCT_ID
 * @property string $PRODUCT_NM
 * @property string $PRODUCT_PROVIDER
 * @property string $PRODUCT_PROVIDER_NO
 * @property string $PRODUCT_PROVIDER_NM
 * @property double $PRODUCT_QTY
 * @property string $UNIT_ID
 * @property string $UNIT_NM
 * @property string $HARGA_JUAL
 * @property string $DISCOUNT
 * @property string $PROMO
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class TransPenjualanDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_penjualan_detail';
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
            [['STORE_ID', 'ACCESS_ID', 'TRANS_ID', 'TRANS_DATE', 'PRODUCT_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['GOLONGAN', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['TRANS_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['PRODUCT_QTY', 'HARGA_JUAL', 'DISCOUNT'], 'number'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP', 'ACCESS_ID'], 'string', 'max' => 15],
            [['STORE_ID', 'UNIT_ID'], 'string', 'max' => 20],
            [['TRANS_ID', 'UNIT_NM', 'PROMO', 'UPDATE_BY'], 'string', 'max' => 50],
            [['OFLINE_ID', 'PRODUCT_PROVIDER', 'PRODUCT_PROVIDER_NO', 'PRODUCT_PROVIDER_NM'], 'string', 'max' => 255],
            [['PRODUCT_ID'], 'string', 'max' => 35],
            [['PRODUCT_NM'], 'string', 'max' => 100],
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
            'ACCESS_ID' => 'Access  ID',
            'GOLONGAN' => 'Golongan',
            'TRANS_ID' => 'Trans  ID',
            'OFLINE_ID' => 'Ofline  ID',
            'TRANS_DATE' => 'Trans  Date',
            'PRODUCT_ID' => 'Product  ID',
            'PRODUCT_NM' => 'Product  Nm',
            'PRODUCT_PROVIDER' => 'Product  Provider',
            'PRODUCT_PROVIDER_NO' => 'Product  Provider  No',
            'PRODUCT_PROVIDER_NM' => 'Product  Provider  Nm',
            'PRODUCT_QTY' => 'Product  Qty',
            'UNIT_ID' => 'Unit  ID',
            'UNIT_NM' => 'Unit  Nm',
            'HARGA_JUAL' => 'Harga  Jual',
            'DISCOUNT' => 'Discount',
            'PROMO' => 'Promo',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
			/* 'opencloseId'=>'opencloseId',
			'ppn'=>'ppn',
			'totalHarga'=>'totalHarga',
			'merchantId'=>'merchantId',
			'typaPayId'=>'typaPayId',
			'typePayNm'=>'typePayNm',
			'bankId'=>'bankId',
			'typePayNm'=>'typePayNm',
			'bankId'=>'bankId',
			'bankNm'=>'bankNm',
			'merchantNm'=>'merchantNm',
			'merchantNo'=>'merchantNo',
			'customerId'=>'customerId',
			'customerNm'=>'customerNm',
			'customerEmail'=>'customerEmail',
			'customerPhone'=>'customerPhone',
			'storeNm'=>'storeNm' */
        ];
    }
		
	// public function getTranHeaderTbl(){		
		// return $this->hasOne(TransPenjualanHeader::className(), ['TRANS_ID' => 'TRANS_ID']);
	// }
	// public function getOpencloseId(){
		// return $this->tranHeaderTbl->OPENCLOSE_ID;
	// }	
	// public function getPpn(){
		// return $this->tranHeaderTbl->PPN;
	// }
	// public function getTotalHarga(){
		// return $this->tranHeaderTbl->TOTAL_HARGA;
	// }
	// public function getMerchantId(){
		// return $this->tranHeaderTbl->MERCHANT_ID;
	// }
	// public function getTypaPayId(){
		// return $this->tranHeaderTbl->TYPE_PAY_ID;
	// }
	// public function getTypePayNm(){
		// return $this->tranHeaderTbl->TYPE_PAY_NM;
	// }
	// public function getBankId(){
		// return $this->tranHeaderTbl->BANK_ID;
	// }
	// public function getBankNm(){
		// return $this->tranHeaderTbl->BANK_NM;
	// }
	// public function getMerchantNm(){
		// return $this->tranHeaderTbl->MERCHANT_NM;
	// }
	// public function getMerchantNo(){
		// return $this->tranHeaderTbl->MERCHANT_NO;
	// }
	// public function getCustomerId(){
		// return $this->tranHeaderTbl->CONSUMER_ID;
	// }
	// public function getCustomerNm(){
		// return $this->tranHeaderTbl->CONSUMER_NM;
	// }
	// public function getCustomerEmail(){
		// return $this->tranHeaderTbl->CONSUMER_EMAIL;
	// }
	// public function getCustomerPhone(){
		// return $this->tranHeaderTbl->CONSUMER_PHONE;
	// }
	// public function getStoreTbl(){
		// return $this->hasOne(Store::className(), ['STORE_ID' => 'STORE_ID']);
	// }	
	// public function getStoreNm(){
		// $rslt = $this->storeTbl['STORE_NM'];
		// if ($rslt){
			// return $rslt;
		// }else{
			// return "none";
		// }; 
	// }
}

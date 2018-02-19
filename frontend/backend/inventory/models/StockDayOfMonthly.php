<?php

namespace frontend\backend\inventory\models;

use Yii;
use frontend\backend\master\models\Product;
/**
 * This is the model class for table "ptr_kasir_inv1c".
 *
 * @property string $UNIX_INV_MONTH
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PRODUCT_ID
 * @property string $TGL
 * @property string $TAHUN
 * @property int $BULAN
 * @property string $LALU
 * @property string $MASUK
 * @property string $TERJUAL
 * @property string $OPNAME
 * @property string $SISA
 * @property string $STOCK_LAST_MONTH
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 */
class StockDayOfMonthly extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ptr_kasir_inv1c';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UNIX_INV_MONTH', 'PRODUCT_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['TGL', 'CREATE_AT', 'UPDATE_AT','produkNm'], 'safe'],
            [['BULAN', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['LALU', 'MASUK', 'TERJUAL', 'OPNAME', 'SISA', 'STOCK_LAST_MONTH'], 'number'],
            [['UNIX_INV_MONTH', 'PRODUCT_ID'], 'string', 'max' => 100],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TAHUN'], 'string', 'max' => 5],
            [['UNIX_INV_MONTH', 'PRODUCT_ID', 'TGL', 'YEAR_AT', 'MONTH_AT'], 'unique', 'targetAttribute' => ['UNIX_INV_MONTH', 'PRODUCT_ID', 'TGL', 'YEAR_AT', 'MONTH_AT']],
            [['UNIX_INV_MONTH', 'YEAR_AT', 'MONTH_AT'], 'unique', 'targetAttribute' => ['UNIX_INV_MONTH', 'YEAR_AT', 'MONTH_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNIX_INV_MONTH' => 'Unix  Inv  Month',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'PRODUCT_ID' => 'Product  ID',
            'TGL' => 'Tgl',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'LALU' => 'Lalu',
            'MASUK' => 'Masuk',
            'TERJUAL' => 'Terjual',
            'OPNAME' => 'Opname',
            'SISA' => 'Sisa',
            'STOCK_LAST_MONTH' => 'Stock  Last  Month',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
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

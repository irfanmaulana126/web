<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "ptr_kasir_td1".
 *
 * @property string $TRANS_UNIK
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $ACCESS_ID ACCESS USER
 * @property int $GOLONGAN 1=KG(pembelian);2=PPOB(pembelian);3=PPOP(pembayaran)
 * @property string $TRANS_ID TRANSAKSI ID
 * @property string $OFLINE_ID
 * @property string $TRANS_DATE Tanggal Transaksi
 * @property int $TRANS_TYPE
 * @property int $TYPE_PAY_ID
 * @property string $TYPE_PAY_NM
 * @property int $BANK_ID
 * @property string $BANK_NM
 * @property string $PRODUCT_ID
 * @property string $PRODUCT_NM
 * @property string $PRODUCT_PROVIDER
 * @property string $PRODUCT_PROVIDER_NO
 * @property string $PRODUCT_PROVIDER_NM
 * @property double $PRODUCT_QTY
 * @property string $UNIT_ID id satuan dalam jual; join tbl satuan.UNIT_ID
 * @property string $UNIT_NM
 * @property string $HPP
 * @property string $PPN
 * @property string $HARGA_JUAL Harga Jual
 * @property string $DISCOUNT
 * @property string $PROMO
 * @property string $JML_HPP
 * @property string $JML_DISCOUNT
 * @property string $JML_PPN
 * @property string $JML_HARGAJUAL
 * @property string $JML_JUALPPNDISCOUNT
 * @property string $JML_PROMO
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY user Ubah
 * @property string $UPDATE_AT Tanggal diubah
 * @property int $STATUS 0=open, 1=close; 2=refund
 * @property string $DCRP_DETIL
 * @property int $MONTH_AT
 * @property int $YEAR_AT
 */
class PtrKasirTd1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ptr_kasir_td1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_UNIK', 'MONTH_AT', 'YEAR_AT'], 'required'],
            [['GOLONGAN', 'TRANS_TYPE', 'TYPE_PAY_ID', 'BANK_ID', 'STATUS', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['TRANS_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['PRODUCT_QTY', 'HPP', 'PPN', 'HARGA_JUAL', 'DISCOUNT', 'PROMO', 'JML_HPP', 'JML_DISCOUNT', 'JML_PPN', 'JML_HARGAJUAL', 'JML_JUALPPNDISCOUNT', 'JML_PROMO'], 'number'],
            [['DCRP_DETIL'], 'string'],
            [['TRANS_UNIK', 'TYPE_PAY_NM', 'BANK_NM'], 'string', 'max' => 150],
            [['ACCESS_GROUP', 'ACCESS_ID'], 'string', 'max' => 15],
            [['STORE_ID', 'UNIT_ID'], 'string', 'max' => 20],
            [['TRANS_ID'], 'string', 'max' => 70],
            [['OFLINE_ID', 'PRODUCT_PROVIDER', 'PRODUCT_PROVIDER_NO', 'PRODUCT_PROVIDER_NM'], 'string', 'max' => 255],
            [['PRODUCT_ID', 'PRODUCT_NM'], 'string', 'max' => 100],
            [['UNIT_NM', 'UPDATE_BY'], 'string', 'max' => 50],
            [['TRANS_UNIK', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['TRANS_UNIK', 'MONTH_AT', 'YEAR_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANS_UNIK' => 'Trans  Unik',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'ACCESS_ID' => 'Access  ID',
            'GOLONGAN' => 'Golongan',
            'TRANS_ID' => 'Trans  ID',
            'OFLINE_ID' => 'Ofline  ID',
            'TRANS_DATE' => 'Trans  Date',
            'TRANS_TYPE' => 'Trans  Type',
            'TYPE_PAY_ID' => 'Type  Pay  ID',
            'TYPE_PAY_NM' => 'Type  Pay  Nm',
            'BANK_ID' => 'Bank  ID',
            'BANK_NM' => 'Bank  Nm',
            'PRODUCT_ID' => 'Product  ID',
            'PRODUCT_NM' => 'Product  Nm',
            'PRODUCT_PROVIDER' => 'Product  Provider',
            'PRODUCT_PROVIDER_NO' => 'Product  Provider  No',
            'PRODUCT_PROVIDER_NM' => 'Product  Provider  Nm',
            'PRODUCT_QTY' => 'Product  Qty',
            'UNIT_ID' => 'Unit  ID',
            'UNIT_NM' => 'Unit  Nm',
            'HPP' => 'Hpp',
            'PPN' => 'Ppn',
            'HARGA_JUAL' => 'Harga  Jual',
            'DISCOUNT' => 'Discount',
            'PROMO' => 'Promo',
            'JML_HPP' => 'Jml  Hpp',
            'JML_DISCOUNT' => 'Jml  Discount',
            'JML_PPN' => 'Jml  Ppn',
            'JML_HARGAJUAL' => 'Jml  Hargajual',
            'JML_JUALPPNDISCOUNT' => 'Jml  Jualppndiscount',
            'JML_PROMO' => 'Jml  Promo',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'MONTH_AT' => 'Month  At',
            'YEAR_AT' => 'Year  At',
        ];
    }
}

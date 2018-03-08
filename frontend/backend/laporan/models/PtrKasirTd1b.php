<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "ptr_kasir_td1b".
 *
 * @property string $TRANS_WEEK
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TRANS_DATE
 * @property string $TAHUN
 * @property int $BULAN
 * @property int $MINGGU
 * @property string $PRODUCT_ID
 * @property string $PRODUCT_NM
 * @property string $PRODUCT_PROVIDER
 * @property string $PRODUCT_PROVIDER_NO
 * @property string $PRODUCT_PROVIDER_NM
 * @property string $UNIT_NM
 * @property int $TRANS_TYPE
 * @property string $SUB_TOTAL_QTY
 * @property string $SUB_TOTAL_HPP
 * @property string $SUB_TOTAL_PPN
 * @property string $SUB_TOTAL_JUAL
 * @property string $SUB_TOTAL_DISCOUNT
 * @property string $SUB_TOTAL_PROMO
 * @property string $PRODUK_SUBTTL_QTY
 * @property string $PRODUK_SUBTTL_HPP
 * @property string $PRODUK_SUBTTL_DISCOUNT
 * @property string $PRODUK_SUBTTL_PPN
 * @property string $PRODUK_SUBTTL_PROMO
 * @property string $PRODUK_SUBTTL_HARGAJUAL
 * @property string $PRODUK_JUALPPNDISCOUNT
 * @property string $REFUND_SUBTTL_QTY
 * @property string $REFUND_SUBTTL_HPP
 * @property string $REFUND_SUBTTL_DISCOUNT
 * @property string $REFUND_SUBTTL_PPN
 * @property string $REFUND_SUBTTL_PROMO
 * @property string $REFUND_SUBTTL_HARGAJUAL
 * @property string $REFUND_JUALPPNDISCOUNT
 * @property string $PPOB_SUBTTL_QTY
 * @property string $PPOB_SUBTTL_HPP
 * @property string $PPOB_SUBTTL_JUAL
 * @property string $OTHER_SUBTTL_QTY
 * @property string $OTHER_SUBTTL_HPP
 * @property string $OTHER_SUBTTL_JUAL
 * @property string $PRODUK_TUNAI_JUALPPNDISCOUNT
 * @property string $PRODUK_NONTUNAI_JUALPPNDISCOUNT
 * @property string $PPOB_TUNAI_JUAL
 * @property string $PPOB_NONTUNAI_JUAL
 * @property string $OTHER_TUNAI_JUAL
 * @property string $OTHER_NONTUNAI_JUAL
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property int $MONTH_AT
 * @property int $YEAR_AT
 */
class PtrKasirTd1b extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ptr_kasir_td1b';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_WEEK', 'MONTH_AT', 'YEAR_AT'], 'required'],
            [['TRANS_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['BULAN', 'MINGGU', 'TRANS_TYPE', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['SUB_TOTAL_QTY', 'SUB_TOTAL_HPP', 'SUB_TOTAL_PPN', 'SUB_TOTAL_JUAL', 'SUB_TOTAL_DISCOUNT', 'SUB_TOTAL_PROMO', 'PRODUK_SUBTTL_QTY', 'PRODUK_SUBTTL_HPP', 'PRODUK_SUBTTL_DISCOUNT', 'PRODUK_SUBTTL_PPN', 'PRODUK_SUBTTL_PROMO', 'PRODUK_SUBTTL_HARGAJUAL', 'PRODUK_JUALPPNDISCOUNT', 'REFUND_SUBTTL_QTY', 'REFUND_SUBTTL_HPP', 'REFUND_SUBTTL_DISCOUNT', 'REFUND_SUBTTL_PPN', 'REFUND_SUBTTL_PROMO', 'REFUND_SUBTTL_HARGAJUAL', 'REFUND_JUALPPNDISCOUNT', 'PPOB_SUBTTL_QTY', 'PPOB_SUBTTL_HPP', 'PPOB_SUBTTL_JUAL', 'OTHER_SUBTTL_QTY', 'OTHER_SUBTTL_HPP', 'OTHER_SUBTTL_JUAL', 'PRODUK_TUNAI_JUALPPNDISCOUNT', 'PRODUK_NONTUNAI_JUALPPNDISCOUNT', 'PPOB_TUNAI_JUAL', 'PPOB_NONTUNAI_JUAL', 'OTHER_TUNAI_JUAL', 'OTHER_NONTUNAI_JUAL'], 'number'],
            [['TRANS_WEEK', 'PRODUCT_NM'], 'string', 'max' => 100],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TAHUN'], 'string', 'max' => 5],
            [['PRODUCT_ID', 'UNIT_NM'], 'string', 'max' => 50],
            [['PRODUCT_PROVIDER', 'PRODUCT_PROVIDER_NO', 'PRODUCT_PROVIDER_NM'], 'string', 'max' => 255],
            [['TRANS_WEEK', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['TRANS_WEEK', 'MONTH_AT', 'YEAR_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANS_WEEK' => 'Trans  Week',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'TRANS_DATE' => 'Trans  Date',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'MINGGU' => 'Minggu',
            'PRODUCT_ID' => 'Product  ID',
            'PRODUCT_NM' => 'Product  Nm',
            'PRODUCT_PROVIDER' => 'Product  Provider',
            'PRODUCT_PROVIDER_NO' => 'Product  Provider  No',
            'PRODUCT_PROVIDER_NM' => 'Product  Provider  Nm',
            'UNIT_NM' => 'Unit  Nm',
            'TRANS_TYPE' => 'Trans  Type',
            'SUB_TOTAL_QTY' => 'Sub  Total  Qty',
            'SUB_TOTAL_HPP' => 'Sub  Total  Hpp',
            'SUB_TOTAL_PPN' => 'Sub  Total  Ppn',
            'SUB_TOTAL_JUAL' => 'Sub  Total  Jual',
            'SUB_TOTAL_DISCOUNT' => 'Sub  Total  Discount',
            'SUB_TOTAL_PROMO' => 'Sub  Total  Promo',
            'PRODUK_SUBTTL_QTY' => 'Produk  Subttl  Qty',
            'PRODUK_SUBTTL_HPP' => 'Produk  Subttl  Hpp',
            'PRODUK_SUBTTL_DISCOUNT' => 'Produk  Subttl  Discount',
            'PRODUK_SUBTTL_PPN' => 'Produk  Subttl  Ppn',
            'PRODUK_SUBTTL_PROMO' => 'Produk  Subttl  Promo',
            'PRODUK_SUBTTL_HARGAJUAL' => 'Produk  Subttl  Hargajual',
            'PRODUK_JUALPPNDISCOUNT' => 'Produk  Jualppndiscount',
            'REFUND_SUBTTL_QTY' => 'Refund  Subttl  Qty',
            'REFUND_SUBTTL_HPP' => 'Refund  Subttl  Hpp',
            'REFUND_SUBTTL_DISCOUNT' => 'Refund  Subttl  Discount',
            'REFUND_SUBTTL_PPN' => 'Refund  Subttl  Ppn',
            'REFUND_SUBTTL_PROMO' => 'Refund  Subttl  Promo',
            'REFUND_SUBTTL_HARGAJUAL' => 'Refund  Subttl  Hargajual',
            'REFUND_JUALPPNDISCOUNT' => 'Refund  Jualppndiscount',
            'PPOB_SUBTTL_QTY' => 'Ppob  Subttl  Qty',
            'PPOB_SUBTTL_HPP' => 'Ppob  Subttl  Hpp',
            'PPOB_SUBTTL_JUAL' => 'Ppob  Subttl  Jual',
            'OTHER_SUBTTL_QTY' => 'Other  Subttl  Qty',
            'OTHER_SUBTTL_HPP' => 'Other  Subttl  Hpp',
            'OTHER_SUBTTL_JUAL' => 'Other  Subttl  Jual',
            'PRODUK_TUNAI_JUALPPNDISCOUNT' => 'Produk  Tunai  Jualppndiscount',
            'PRODUK_NONTUNAI_JUALPPNDISCOUNT' => 'Produk  Nontunai  Jualppndiscount',
            'PPOB_TUNAI_JUAL' => 'Ppob  Tunai  Jual',
            'PPOB_NONTUNAI_JUAL' => 'Ppob  Nontunai  Jual',
            'OTHER_TUNAI_JUAL' => 'Other  Tunai  Jual',
            'OTHER_NONTUNAI_JUAL' => 'Other  Nontunai  Jual',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'MONTH_AT' => 'Month  At',
            'YEAR_AT' => 'Year  At',
        ];
    }
}

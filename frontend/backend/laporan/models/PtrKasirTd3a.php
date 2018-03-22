<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "ptr_kasir_td3a".
 *
 * @property string $TRANS_DAY
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TRANS_DATE
 * @property string $TAHUN
 * @property int $BULAN
 * @property string $PRODUK_TTL_QTY
 * @property string $PRODUK_TTL_HPP
 * @property string $PRODUK_TTL_DISCOUNT
 * @property string $PRODUK_TTL_PPN
 * @property string $PRODUK_TTL_PROMO
 * @property string $PRODUK_TTL_HARGAJUAL
 * @property string $PRODUK_TTL_JUALPPNDISCOUNT
 * @property string $REFUND_TTL_QTY
 * @property string $REFUND_TTL_HPP
 * @property string $REFUND_TTL_DISCOUNT
 * @property string $REFUND_TTL_PPN
 * @property string $REFUND_TTL_PROMO
 * @property string $REFUND_TTL_HARGAJUAL
 * @property string $REFUND_TTL_JUALPPNDISCOUNT
 * @property string $PPOB_TTL_QTY
 * @property string $PPOB_TTL_HPP
 * @property string $PPOB_TTL_JUAL
 * @property string $OTHER_TTL_QTY
 * @property string $OTHER_TTL_HPP
 * @property string $OTHER_TTL_JUAL
 * @property string $TOTAL_QTY
 * @property string $TOTAL_JUAL
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
class PtrKasirTd3a extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ptr_kasir_td3a';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_DAY', 'MONTH_AT', 'YEAR_AT'], 'required'],
            [['TRANS_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['BULAN', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['PRODUK_TTL_QTY', 'PRODUK_TTL_HPP', 'PRODUK_TTL_DISCOUNT', 'PRODUK_TTL_PPN', 'PRODUK_TTL_PROMO', 'PRODUK_TTL_HARGAJUAL', 'PRODUK_TTL_JUALPPNDISCOUNT', 'REFUND_TTL_QTY', 'REFUND_TTL_HPP', 'REFUND_TTL_DISCOUNT', 'REFUND_TTL_PPN', 'REFUND_TTL_PROMO', 'REFUND_TTL_HARGAJUAL', 'REFUND_TTL_JUALPPNDISCOUNT', 'PPOB_TTL_QTY', 'PPOB_TTL_HPP', 'PPOB_TTL_JUAL', 'OTHER_TTL_QTY', 'OTHER_TTL_HPP', 'OTHER_TTL_JUAL', 'TOTAL_QTY', 'TOTAL_JUAL', 'PRODUK_TUNAI_JUALPPNDISCOUNT', 'PRODUK_NONTUNAI_JUALPPNDISCOUNT', 'PPOB_TUNAI_JUAL', 'PPOB_NONTUNAI_JUAL', 'OTHER_TUNAI_JUAL', 'OTHER_NONTUNAI_JUAL'], 'number'],
            [['TRANS_DAY'], 'string', 'max' => 100],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TAHUN'], 'string', 'max' => 5],
            [['TRANS_DAY', 'TRANS_DATE', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['TRANS_DAY', 'TRANS_DATE', 'MONTH_AT', 'YEAR_AT']],
            [['TRANS_DAY', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['TRANS_DAY', 'MONTH_AT', 'YEAR_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANS_DAY' => 'Trans  Day',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'TRANS_DATE' => 'Trans  Date',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'PRODUK_TTL_QTY' => 'Produk  Ttl  Qty',
            'PRODUK_TTL_HPP' => 'Produk  Ttl  Hpp',
            'PRODUK_TTL_DISCOUNT' => 'Produk  Ttl  Discount',
            'PRODUK_TTL_PPN' => 'Produk  Ttl  Ppn',
            'PRODUK_TTL_PROMO' => 'Produk  Ttl  Promo',
            'PRODUK_TTL_HARGAJUAL' => 'Produk  Ttl  Hargajual',
            'PRODUK_TTL_JUALPPNDISCOUNT' => 'Produk  Ttl  Jualppndiscount',
            'REFUND_TTL_QTY' => 'Refund  Ttl  Qty',
            'REFUND_TTL_HPP' => 'Refund  Ttl  Hpp',
            'REFUND_TTL_DISCOUNT' => 'Refund  Ttl  Discount',
            'REFUND_TTL_PPN' => 'Refund  Ttl  Ppn',
            'REFUND_TTL_PROMO' => 'Refund  Ttl  Promo',
            'REFUND_TTL_HARGAJUAL' => 'Refund  Ttl  Hargajual',
            'REFUND_TTL_JUALPPNDISCOUNT' => 'Refund  Ttl  Jualppndiscount',
            'PPOB_TTL_QTY' => 'Ppob  Ttl  Qty',
            'PPOB_TTL_HPP' => 'Ppob  Ttl  Hpp',
            'PPOB_TTL_JUAL' => 'Ppob  Ttl  Jual',
            'OTHER_TTL_QTY' => 'Other  Ttl  Qty',
            'OTHER_TTL_HPP' => 'Other  Ttl  Hpp',
            'OTHER_TTL_JUAL' => 'Other  Ttl  Jual',
            'TOTAL_QTY' => 'Total  Qty',
            'TOTAL_JUAL' => 'Total  Jual',
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

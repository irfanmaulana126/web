<?php

namespace frontend\backend\dashboard\models;

use Yii;

/**
 * This is the model class for table "ptr_kasir_td3b".
 *
 * @property string $TRANS_WEEK
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TRANS_DATE
 * @property string $TAHUN
 * @property int $BULAN
 * @property int $MINGGU
 * @property string $TOTAL_QTY
 * @property string $TOTAL_QTY_PRODUK
 * @property string $TOTAL_QTY_PPOB
 * @property string $TOTAL_PRODUK
 * @property string $TOTAL_PPOB
 * @property string $TOTAL_HPP
 * @property string $TOTAL_JUAL
 * @property string $TOTAL_DISCOUNT
 * @property string $TOTAL_PROMO
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 */
class WeeklySales extends \yii\db\ActiveRecord
{
	public static function getDb()
    {
        return Yii::$app->get('production_api');
    }
    
    public static function tableName()
    {
        return 'ptr_kasir_td3b';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANS_WEEK'], 'required'],
            [['TRANS_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['BULAN', 'MINGGU'], 'integer'],
            [['PRODUK_TOTAL_QTY', 'PRODUK_TOTAL_HARGAJUAL', 'PRODUK_AVERAGE_PPN','PRODUK_TOTAL_HPP',
			  'PRODUK_TOTAL_DISCOUNT','PRODUK_TOTAL_JUALPPN',
			  'PRODUK_TOTAL_PROMO', 'REFUND_TOTAL_QTY', 'REFUND_TOTAL_HPP','REFUND_TOTAL_JUALPPN',
  			  'PPOB_TOTAL_QTY', 'PPOB_TOTAL_JUAL','OTHER_TOTAL_QTY','OTHER_TOTAL_JUAL','TOTAL_QTY','TOTAL_JUAL'
			], 'safe'],
			[['TRANS_WEEK'], 'string', 'max' => 100],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TAHUN'], 'string', 'max' => 5],
            [['TRANS_WEEK'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANS_MONTH' => 'Trans  Month',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'TRANS_DATE' => 'Trans  Date',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
			'PRODUK_TOTAL_QTY' => 'PRODUK_TOTAL_QTY',
			'PRODUK_TOTAL_HARGAJUAL' => 'PRODUK_TOTAL_HARGAJUAL',
			'PRODUK_AVERAGE_PPN' => 'PRODUK_AVERAGE_PPN',
			'PRODUK_TOTAL_HPP' => 'PRODUK_TOTAL_HPP',
			'PRODUK_TOTAL_DISCOUNT' => 'PRODUK_TOTAL_DISCOUNT',
			'PRODUK_TOTAL_JUALPPN' => 'PRODUK_TOTAL_JUALPPN',			
			'PRODUK_TOTAL_PROMO' => 'PRODUK_TOTAL_PROMO',
			'REFUND_TOTAL_QTY' => 'REFUND_TOTAL_QTY',
			'REFUND_TOTAL_HPP' => 'REFUND_TOTAL_HPP',
			'REFUND_TOTAL_JUALPPN' => 'REFUND_TOTAL_JUALPPN',
			'PPOB_TOTAL_QTY' => 'PPOB_TOTAL_QTY',
			'PPOB_TOTAL_JUAL' => 'PPOB_TOTAL_JUAL',
			'OTHER_TOTAL_QTY' => 'OTHER_TOTAL_QTY',
			'OTHER_TOTAL_JUAL' => 'OTHER_TOTAL_JUAL',
			'TOTAL_QTY' => 'TOTAL_QTY',
			'TOTAL_JUAL' => 'TOTAL_JUAL',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At'			
        ];
    }
	
	public function fields()
	{
		return [			
			'TAHUN'=>function($model){
				return $model->TAHUN;
			},
			'BULAN'=>function($model){
				return $model->BULAN;
			},
			'PRODUK_TOTAL_QTY'=>function($model){
				return $model->PRODUK_TOTAL_QTY;
			},
			'PRODUK_TOTAL_HARGAJUAL'=>function($model){
				return $model->PRODUK_TOTAL_HARGAJUAL;
			},
			'PRODUK_AVERAGE_PPN'=>function($model){
				return $model->PRODUK_AVERAGE_PPN;
			},
			'PRODUK_TOTAL_HPP'=>function($model){
				return $model->PRODUK_TOTAL_HPP;
			},
			'PRODUK_TOTAL_DISCOUNT'=>function($model){
				return $model->PRODUK_TOTAL_DISCOUNT;
			},
			'PRODUK_TOTAL_JUALPPN'=>function($model){
				return $model->PRODUK_TOTAL_JUALPPN;
			},
			'PRODUK_TOTAL_PROMO'=>function($model){
				return $model->PRODUK_TOTAL_PROMO;
			},
			'REFUND_TOTAL_QTY'=>function($model){
				return $model->REFUND_TOTAL_QTY;
			},
			'REFUND_TOTAL_HPP'=>function($model){
				return $model->REFUND_TOTAL_HPP;
			},
			'REFUND_TOTAL_JUALPPN'=>function($model){
				return $model->REFUND_TOTAL_JUALPPN;
			},
			'PPOB_TOTAL_QTY'=>function($model){
				return $model->PPOB_TOTAL_QTY;
			},
			'PPOB_TOTAL_JUAL'=>function($model){
				return $model->PPOB_TOTAL_JUAL;
			},
			'TOTAL_QTY_OTHER'=>function($model){
				return $model->TOTAL_QTY_OTHER;
			},
			'OTHER_TOTAL_QTY'=>function($model){
				return $model->OTHER_TOTAL_QTY;
			},
			'TOTAL_QTY'=>function($model){
				return $model->TOTAL_QTY;
			},
			'TOTAL_JUAL'=>function($model){
				return $model->TOTAL_JUAL;
			}
		];
	}
}

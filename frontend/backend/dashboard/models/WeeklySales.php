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
             [['TOTAL_QTY_PRODUK', 'TOTAL_HPP_PRODUK', 'TOTAL_PPN_PRODUK','TOTAL_JUAL_PRODUK','TOTAL_DISCOUNT_PRODUK','TOTAL_PROMO_PRODUK',
			  'TOTAL_QTY_PPOB', 'TOTAL_JUAL_PPOB', 'TOTAL_QTY_OTHER','TOTAL_JUAL_OTHER',
  			  'TOTAL_QTY', 'TOTAL_JUAL',
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
            'TRANS_WEEK' => 'Trans  Week',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'TRANS_DATE' => 'Trans  Date',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'MINGGU' => 'Minggu',
            'TOTAL_QTY_PRODUK' => 'TOTAL_QTY_PRODUK',
			'TOTAL_HPP_PRODUK' => 'TOTAL_HPP_PRODUK',
			'TOTAL_PPN_PRODUK' => 'TOTAL_PPN_PRODUK',
			'TOTAL_JUAL_PRODUK' => 'TOTAL_JUAL_PRODUK',
			'TOTAL_DISCOUNT_PRODUK' => 'TOTAL_DISCOUNT_PRODUK',
			'TOTAL_PROMO_PRODUK' => 'TOTAL_PROMO_PRODUK',
			'TOTAL_QTY_PPOB' => 'TOTAL_QTY_PPOB',
			'TOTAL_JUAL_PPOB' => 'TOTAL_JUAL_PPOB',
			'TOTAL_QTY_OTHER' => 'TOTAL_QTY_OTHER',
			'TOTAL_JUAL_OTHER' => 'TOTAL_JUAL_OTHER',
			'TOTAL_QTY' => 'TOTAL_QTY',
			'TOTAL_JUAL' => 'TOTAL_JUAL',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
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
			'MINGGU'=>function($model){
				return $model->MINGGU;
			},
			'TOTAL_QTY_PRODUK'=>function($model){
				return $model->TOTAL_QTY_PRODUK;
			},
			'TOTAL_HPP_PRODUK'=>function($model){
				return $model->TOTAL_HPP_PRODUK;
			},
			'TOTAL_PPN_PRODUK'=>function($model){
				return $model->TOTAL_PPN_PRODUK;
			},
			'TOTAL_JUAL_PRODUK'=>function($model){
				return $model->TOTAL_JUAL_PRODUK;
			},
			'TOTAL_DISCOUNT_PRODUK'=>function($model){
				return $model->TOTAL_DISCOUNT_PRODUK;
			},
			'TOTAL_PROMO_PRODUK'=>function($model){
				return $model->TOTAL_PROMO_PRODUK;
			},
			'TOTAL_QTY_PPOB'=>function($model){
				return $model->TOTAL_QTY_PPOB;
			},
			'TOTAL_JUAL_PPOB'=>function($model){
				return $model->TOTAL_JUAL_PPOB;
			},
			'TOTAL_QTY_OTHER'=>function($model){
				return $model->TOTAL_QTY_OTHER;
			},
			'TOTAL_JUAL_OTHER'=>function($model){
				return $model->TOTAL_JUAL_OTHER;
			},
			'TOTAL_QTY'=>function($model){
				return $model->TOTAL_QTY;
			},
			'TOTAL_JUAL'=>function($model){
				return $model->TOTAL_JUAL;
			},
		];
	}
}

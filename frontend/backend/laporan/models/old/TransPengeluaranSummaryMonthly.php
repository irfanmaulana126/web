<?php

namespace frontend\backend\laporan\models;

use Yii;
use common\models\Store;
/**
 * This is the model class for table "trans_pengeluaran_summary_monthly".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TAHUN
 * @property integer $BULAN
 * @property string $TTL_1
 * @property string $TTL_2
 * @property string $TTL_3
 * @property string $TTL_4
 * @property string $TTL_5
 * @property string $TTL_6
 * @property string $TTL_7
 * @property string $TTL_8
 * @property string $TTL_9
 * @property double $CNT_1
 * @property double $CNT_2
 * @property double $CNT_3
 * @property double $CNT_4
 * @property double $CNT_5
 * @property double $CNT_6
 * @property double $CNT_7
 * @property double $CNT_8
 * @property double $CNT_9
 * @property string $KETERANGAN
 * @property integer $STATUS
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 */
class TransPengeluaranSummaryMonthly extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_pengeluaran_summary_monthly';
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
            [['BULAN', 'STATUS'], 'integer'],
            [['TTL_1', 'TTL_2', 'TTL_3', 'TTL_4', 'TTL_5', 'TTL_6', 'TTL_7', 'TTL_8', 'TTL_9', 'CNT_1', 'CNT_2', 'CNT_3', 'CNT_4', 'CNT_5', 'CNT_6', 'CNT_7', 'CNT_8', 'CNT_9'], 'number'],
            [['KETERANGAN'], 'string'],
            [['CREATE_AT', 'UPDATE_AT','storeNm','totalPengeluaran'], 'safe'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TAHUN'], 'string', 'max' => 5],
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
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'TTL_1' => 'Ttl 1',
            'TTL_2' => 'Ttl 2',
            'TTL_3' => 'Ttl 3',
            'TTL_4' => 'Ttl 4',
            'TTL_5' => 'Ttl 5',
            'TTL_6' => 'Ttl 6',
            'TTL_7' => 'Ttl 7',
            'TTL_8' => 'Ttl 8',
            'TTL_9' => 'Ttl 9',
            'CNT_1' => 'Cnt 1',
            'CNT_2' => 'Cnt 2',
            'CNT_3' => 'Cnt 3',
            'CNT_4' => 'Cnt 4',
            'CNT_5' => 'Cnt 5',
            'CNT_6' => 'Cnt 6',
            'CNT_7' => 'Cnt 7',
            'CNT_8' => 'Cnt 8',
            'CNT_9' => 'Cnt 9',
            'KETERANGAN' => 'Keterangan',
            'STATUS' => 'Status',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
        ];
    }
	
	public function getStoreTbl(){
		return $this->hasOne(Store::className(), ['STORE_ID' => 'STORE_ID']);
	}
	
	public function getStoreNm(){
		return $this->storeTbl->STORE_NM;
	}
	
	public function getTotalPengeluaran(){
		 $rslt= $this->TTL_1 + $this->TTL_2 + $this->TTL_3 + $this->TTL_4 + $this->TTL_5 + $this->TTL_6 + $this->TTL_7 + $this->TTL_8 + $this->TTL_9;
		 return $rslt;
	}
}

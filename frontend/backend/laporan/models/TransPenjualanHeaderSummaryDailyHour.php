<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "trans_penjualan_header_summary_daily_hour".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TAHUN
 * @property integer $BULAN
 * @property string $TGL
 * @property integer $VAL1
 * @property integer $VAL2
 * @property integer $VAL3
 * @property integer $VAL4
 * @property integer $VAL5
 * @property integer $VAL6
 * @property integer $VAL7
 * @property integer $VAL8
 * @property integer $VAL9
 * @property integer $VAL10
 * @property integer $VAL11
 * @property integer $VAL12
 * @property integer $VAL13
 * @property integer $VAL14
 * @property integer $VAL15
 * @property integer $VAL16
 * @property integer $VAL17
 * @property integer $VAL18
 * @property integer $VAL19
 * @property integer $VAL20
 * @property integer $VAL21
 * @property integer $VAL22
 * @property integer $VAL23
 * @property integer $VAL24
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property string $KETERANGAN
 */
class TransPenjualanHeaderSummaryDailyHour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_penjualan_header_summary_daily_hour';
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
            [['BULAN', 'VAL1', 'VAL2', 'VAL3', 'VAL4', 'VAL5', 'VAL6', 'VAL7', 'VAL8', 'VAL9', 'VAL10', 'VAL11', 'VAL12', 'VAL13', 'VAL14', 'VAL15', 'VAL16', 'VAL17', 'VAL18', 'VAL19', 'VAL20', 'VAL21', 'VAL22', 'VAL23', 'VAL24'], 'integer'],
            [['TGL', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['KETERANGAN'], 'string'],
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
            'TGL' => 'Tgl',
            'VAL1' => 'Val1',
            'VAL2' => 'Val2',
            'VAL3' => 'Val3',
            'VAL4' => 'Val4',
            'VAL5' => 'Val5',
            'VAL6' => 'Val6',
            'VAL7' => 'Val7',
            'VAL8' => 'Val8',
            'VAL9' => 'Val9',
            'VAL10' => 'Val10',
            'VAL11' => 'Val11',
            'VAL12' => 'Val12',
            'VAL13' => 'Val13',
            'VAL14' => 'Val14',
            'VAL15' => 'Val15',
            'VAL16' => 'Val16',
            'VAL17' => 'Val17',
            'VAL18' => 'Val18',
            'VAL19' => 'Val19',
            'VAL20' => 'Val20',
            'VAL21' => 'Val21',
            'VAL22' => 'Val22',
            'VAL23' => 'Val23',
            'VAL24' => 'Val24',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'KETERANGAN' => 'Keterangan',
        ];
    }
}

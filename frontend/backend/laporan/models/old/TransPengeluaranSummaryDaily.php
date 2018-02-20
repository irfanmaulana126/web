<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "trans_pengeluaran_summary_daily".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TAHUN
 * @property integer $BULAN
 * @property string $TGL
 * @property integer $ACCOUNT_ID
 * @property string $ACCOUNT_NM
 * @property string $TOTAL_RUPIAH
 * @property string $TOTAL_QTY
 * @property string $KETERANGAN
 * @property integer $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class TransPengeluaranSummaryDaily extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_pengeluaran_summary_daily';
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
            [['ACCESS_GROUP', 'STORE_ID', 'TGL', 'ACCOUNT_ID'], 'required'],
            [['BULAN', 'ACCOUNT_ID', 'STATUS'], 'integer'],
            [['TGL', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TOTAL_RUPIAH', 'TOTAL_QTY'], 'number'],
            [['KETERANGAN'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TAHUN'], 'string', 'max' => 5],
            [['ACCOUNT_NM'], 'string', 'max' => 100],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'ACCOUNT_ID' => 'Account  ID',
            'ACCOUNT_NM' => 'Account  Nm',
            'TOTAL_RUPIAH' => 'Total  Rupiah',
            'TOTAL_QTY' => 'Total  Qty',
            'KETERANGAN' => 'Keterangan',
            'STATUS' => 'Status',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "ptr_kasir_th1a_donasi".
 *
 * @property string $TRANS_ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $STORE_NM
 * @property string $TRANS_DATE
 * @property int $TAHUN
 * @property int $BULAN
 * @property string $TGL
 * @property string $JUMLAH_DONASI
 * @property int $STT 0=belum di donasikan; 1=sudah di donasikan
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_AT Tanggal diubah
 * @property int $MONTH_AT
 * @property int $YEAR_AT
 */
class PtrKasirTh1aDonasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ptr_kasir_th1a_donasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_GROUP', 'STORE_ID', 'MONTH_AT', 'YEAR_AT'], 'required'],
            [['TRANS_DATE', 'TGL', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TAHUN', 'BULAN', 'STT', 'MONTH_AT', 'YEAR_AT'], 'integer'],
            [['JUMLAH_DONASI'], 'number'],
            [['TRANS_ID', 'STORE_ID'], 'string', 'max' => 100],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_NM'], 'string', 'max' => 255],
            [['TRANS_ID', 'ACCESS_GROUP', 'STORE_ID', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['TRANS_ID', 'ACCESS_GROUP', 'STORE_ID', 'MONTH_AT', 'YEAR_AT']],
            [['STORE_ID', 'MONTH_AT', 'YEAR_AT'], 'unique', 'targetAttribute' => ['STORE_ID', 'MONTH_AT', 'YEAR_AT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANS_ID' => 'Trans  ID',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'STORE_NM' => 'Store  Nm',
            'TRANS_DATE' => 'Trans  Date',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'TGL' => 'Tgl',
            'JUMLAH_DONASI' => 'Jumlah  Donasi',
            'STT' => 'Stt',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'MONTH_AT' => 'Month  At',
            'YEAR_AT' => 'Year  At',
        ];
    }
}

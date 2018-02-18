<?php

namespace frontend\backend\payment\models;

use Yii;

/**
 * This is the model class for table "store_kasir".
 *
 * @property string $KASIR_ID
 * @property string $KASIR_NM
 * @property string $ACCESS_GROUP ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PERANGKAT_UUID NAMA PAKET
 * @property int $KASIR_STT 0=TRIAL (14 hari) ;1=Active; 2=Deactive (BALUM BAYAR) 3=Delete
 * @property string $KASIR_STT_NM
 * @property int $DOMPET_AUTODEBET 0=tidak; 1=autodebet
 * @property string $DOMPET_AUTODEBET_NM
 * @property int $PAYMENT_METHODE 0=Debet Dompet KG; 1=kartu kredit; 2=Transfer manual; 
 * @property string $PAYMENT_METHODE_NM
 * @property int $PAKET_ID PAKET DEFAULT
 * @property string $DATE_START TANGGAL PEMBAYARAN
 * @property string $DATE_END TANGGAL AKHIR PEMBAYARAN. FORMULA  1. Jumlah Pembayaran  2. lama waktu aktif.  3. 8 Hari sebelum berakhir masa tengang.      a. create invoice.      b. show list masa tengang.      c. send invoice email.      d. prosess pembayaran
 * @property string $KONTRAK_DURASI
 * @property string $KONTRAK_DATE
 * @property int $STATUS 0=deaktif;1=aktif
 * @property string $CREATE_BY USER CREATED
 * @property string $UPDATE_BY USER UPDATE
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_AT Tanggal di update
 */
class StoreKasir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_kasir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['KASIR_ID'], 'required'],
            [['KASIR_STT', 'DOMPET_AUTODEBET', 'PAYMENT_METHODE', 'PAKET_ID', 'STATUS'], 'integer'],
            [['DATE_START', 'DATE_END', 'KONTRAK_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['KASIR_ID', 'PERANGKAT_UUID', 'PAYMENT_METHODE_NM'], 'string', 'max' => 100],
            [['KASIR_NM', 'ACCESS_GROUP', 'STORE_ID', 'KASIR_STT_NM', 'DOMPET_AUTODEBET_NM', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['KONTRAK_DURASI'], 'string', 'max' => 255],
            [['KASIR_ID', 'ACCESS_GROUP', 'STORE_ID'], 'unique', 'targetAttribute' => ['KASIR_ID', 'ACCESS_GROUP', 'STORE_ID']],
            [['KASIR_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'KASIR_ID' => 'Kasir  ID',
            'KASIR_NM' => 'Kasir  Nm',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'PERANGKAT_UUID' => 'Perangkat  Uuid',
            'KASIR_STT' => 'Kasir  Stt',
            'KASIR_STT_NM' => 'Kasir  Stt  Nm',
            'DOMPET_AUTODEBET' => 'Dompet  Autodebet',
            'DOMPET_AUTODEBET_NM' => 'Dompet  Autodebet  Nm',
            'PAYMENT_METHODE' => 'Payment  Methode',
            'PAYMENT_METHODE_NM' => 'Payment  Methode  Nm',
            'PAKET_ID' => 'Paket  ID',
            'DATE_START' => 'Date  Start',
            'DATE_END' => 'Date  End',
            'KONTRAK_DURASI' => 'Kontrak  Durasi',
            'KONTRAK_DATE' => 'Kontrak  Date',
            'STATUS' => 'Status',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

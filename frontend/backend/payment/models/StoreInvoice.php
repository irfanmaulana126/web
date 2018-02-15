<?php

namespace frontend\backend\payment\models;

use Yii;

/**
 * This is the model class for table "store_membership".
 *
 * @property int $ID RECEVED & RELEASE: ID UNIX, POSTING URL DAN AJAX
 * @property string $ACCESS_GROUP ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $KASIR_ID
 * @property int $STORE_STT 0=TRIAL 1=Active;  2=deactive (BALUM BAYAR) 3=delete  Update by DATE_START-DATE_END Join to Stote.Status
 * @property string $STORE_STT_NM
 * @property string $STORE_DATE_END_LATES
 * @property string $STORE_DATE_START Tanggal untuk update store
 * @property string $STORE_DATE_END Tanggal untuk update store
 * @property string $FAKTURE_NO kode [ACCESS_UNIX.OUTLET_CODE.TimeStamp].  AUTO GENERATE [masa tenggang 8 hari]
 * @property string $FAKTURE_DATE_START invoice kirim dari "FAKTURE_TEMPO" sebelum tanggal berakhir, tanggal END di tabel store, jika sudah habis pengajuan pengaktifan kembali kembali
 * @property int $FAKTURE_TEMPO 8 Hari, invoice expired =   STATUS=3
 * @property string $FAKTURE_DATE_END FAKTURE_DATE_START - FAKTURE_TEMPO atau tanggal akhit di store
 * @property int $PAYMENT_STT 0=TRIAL;  1= LUNAS;  2= BELUM BAYAR; 3= INVOICE EXPIRED/Dibatalkan
 * @property string $PAYMENT_STT_NM
 * @property string $PAYMENT_DATE Tanggal Pembayaran
 * @property int $PAYMENT_METHODE 0=Debet Dompet KG; 1=kartu kredit; 2=Transfer manual; 
 * @property string $PAYMENT_METHODE_NM
 * @property int $DOMPET_AUTODEBET  0=tidak;1=Autodebet dompet KG
 * @property string $PAKET_ID TANGGAL AKHIR PEMBAYARAN. FORMULA  1. Jumlah Pembayaran 2. lama waktu aktif
 * @property string $PAKET_GROUP Jika  DATE FROM table Store.END_DATE.
 * @property string $PAKET_NM
 * @property int $PAKET_DURATION
 * @property int $PAKET_DURATION_BONUS
 * @property string $HARGA_BULAN
 * @property string $HARGA_HARI
 * @property string $HARGA_PAKET
 * @property string $HARGA_PAKET_HARI
 * @property string $CREATE_BY USER CREATED
 * @property string $UPDATE_BY USER UPDATE
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_AT Tanggal di update
 */
class StoreInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_membership';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STORE_STT', 'FAKTURE_TEMPO', 'PAYMENT_STT', 'PAYMENT_METHODE', 'DOMPET_AUTODEBET', 'PAKET_ID', 'PAKET_DURATION', 'PAKET_DURATION_BONUS'], 'integer'],
            [['STORE_DATE_END_LATES', 'STORE_DATE_START', 'STORE_DATE_END', 'FAKTURE_DATE_START', 'FAKTURE_DATE_END', 'PAYMENT_DATE', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['FAKTURE_NO'], 'required'],
            [['HARGA_BULAN', 'HARGA_HARI', 'HARGA_PAKET', 'HARGA_PAKET_HARI'], 'number'],
            [['ACCESS_GROUP', 'STORE_ID', 'STORE_STT_NM', 'FAKTURE_NO', 'PAYMENT_STT_NM', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['KASIR_ID', 'PAYMENT_METHODE_NM', 'PAKET_GROUP', 'PAKET_NM'], 'string', 'max' => 100],
            [['KASIR_ID', 'FAKTURE_DATE_START', 'FAKTURE_DATE_END'], 'unique', 'targetAttribute' => ['KASIR_ID', 'FAKTURE_DATE_START', 'FAKTURE_DATE_END']],
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
            'KASIR_ID' => 'Kasir  ID',
            'STORE_STT' => 'Store  Stt',
            'STORE_STT_NM' => 'Store  Stt  Nm',
            'STORE_DATE_END_LATES' => 'Store  Date  End  Lates',
            'STORE_DATE_START' => 'Store  Date  Start',
            'STORE_DATE_END' => 'Store  Date  End',
            'FAKTURE_NO' => 'Fakture  No',
            'FAKTURE_DATE_START' => 'Fakture  Date  Start',
            'FAKTURE_TEMPO' => 'Fakture  Tempo',
            'FAKTURE_DATE_END' => 'Fakture  Date  End',
            'PAYMENT_STT' => 'Payment  Stt',
            'PAYMENT_STT_NM' => 'Payment  Stt  Nm',
            'PAYMENT_DATE' => 'Payment  Date',
            'PAYMENT_METHODE' => 'Payment  Methode',
            'PAYMENT_METHODE_NM' => 'Payment  Methode  Nm',
            'DOMPET_AUTODEBET' => 'Dompet  Autodebet',
            'PAKET_ID' => 'Paket  ID',
            'PAKET_GROUP' => 'Paket  Group',
            'PAKET_NM' => 'Paket  Nm',
            'PAKET_DURATION' => 'Paket  Duration',
            'PAKET_DURATION_BONUS' => 'Paket  Duration  Bonus',
            'HARGA_BULAN' => 'Harga  Bulan',
            'HARGA_HARI' => 'Harga  Hari',
            'HARGA_PAKET' => 'Harga  Paket',
            'HARGA_PAKET_HARI' => 'Harga  Paket  Hari',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

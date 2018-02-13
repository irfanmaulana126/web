<?php

namespace frontend\backend\master\models;

use Yii;

/**
 * This is the model class for table "store_membership_paket".
 *
 * @property string $PAKET_ID RECEVED & RELEASE: ID UNIX, POSTING URL DAN AJAX
 * @property string $PAKET_GROUP HOME|PREMIUM|PRO
 * @property string $PAKET_NM
 * @property int $PAKET_DURATION DURATION 1 bulan 3 bulan = gratis 15 hari. 6 bulan = gratis 30 hari 12 bulan = gratis 60 hari
 * @property int $PAKET_DURATION_BONUS
 * @property string $HARGA_BULAN
 * @property string $HARGA_HARI
 * @property string $HARGA_PAKET TANGGAL AKHIR PEMBAYARAN. FORMULA  1. Jumlah Pembayaran 2. lama waktu aktif
 * @property string $HARGA_PAKET_HARI
 * @property int $PAKET_STT 0=deactive    1=active
 * @property string $PAKET_STT_NM
 * @property string $CREATE_BY USER CREATED
 * @property string $UPDATE_BY USER UPDATE
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_AT Tanggal di update
 */
class StoreMembershipPaket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_membership_paket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PAKET_DURATION', 'PAKET_DURATION_BONUS', 'PAKET_STT'], 'integer'],
            [['HARGA_BULAN', 'HARGA_HARI', 'HARGA_PAKET', 'HARGA_PAKET_HARI'], 'number'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['PAKET_GROUP', 'PAKET_STT_NM', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['PAKET_NM'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PAKET_ID' => 'Paket  ID',
            'PAKET_GROUP' => 'Paket  Group',
            'PAKET_NM' => 'Paket  Nm',
            'PAKET_DURATION' => 'Paket  Duration',
            'PAKET_DURATION_BONUS' => 'Paket  Duration  Bonus',
            'HARGA_BULAN' => 'Harga  Bulan',
            'HARGA_HARI' => 'Harga  Hari',
            'HARGA_PAKET' => 'Harga  Paket',
            'HARGA_PAKET_HARI' => 'Harga  Paket  Hari',
            'PAKET_STT' => 'Paket  Stt',
            'PAKET_STT_NM' => 'Paket  Stt  Nm',
            'CREATE_BY' => 'Create  By',
            'UPDATE_BY' => 'Update  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

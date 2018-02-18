<?php

namespace frontend\backend\payment\models;

use Yii;

/**
 * This is the model class for table "dompet_transaksi".
 *
 * @property string $TRANS_ID
 * @property string $STORE_ID
 * @property string $ACCESS_GROUP user ACCESS_LEVEL=OWNER (ACCESS_ID=ACCESS_GROUP)
 * @property string $VA_ID VIRTUAL ACCOUT ID
 * @property string $TRANSCODE
 * @property string $TRANSCODE_NM
 * @property int $TRANS_TYPE
 * @property string $TRANS_TYPE_NM
 * @property string $JUMLAH total semua saldo
 * @property string $CURRENT_TGL diambil dari Tbl ptr_ppob_lpts4->current_date
 * @property string $TGL
 * @property string $WAKTU diambil dari Tbl ptr_ppob_lpts4->current_date
 * @property string $REF_NUMBER FAKTURE_NO=>langanan TRANSA_ID=>ppob VIRTAL_ACCOUNT => REF_VA
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class DompetTransaksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dompet_transaksi';
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
            [['TRANS_ID', 'STORE_ID', 'ACCESS_GROUP', 'VA_ID', 'TRANSCODE', 'CURRENT_TGL'], 'required'],
            [['TRANS_TYPE'], 'integer'],
            [['JUMLAH'], 'number'],
            [['CURRENT_TGL', 'TGL', 'WAKTU', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TRANS_ID'], 'string', 'max' => 150],
            [['STORE_ID', 'VA_ID', 'TRANSCODE_NM', 'TRANS_TYPE_NM', 'REF_NUMBER'], 'string', 'max' => 100],
            [['ACCESS_GROUP', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['TRANSCODE'], 'string', 'max' => 10],
            [['TRANS_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANS_ID' => 'Trans  ID',
            'STORE_ID' => 'Store  ID',
            'ACCESS_GROUP' => 'Access  Group',
            'VA_ID' => 'Va  ID',
            'TRANSCODE' => 'Transcode',
            'TRANSCODE_NM' => 'Transcode  Nm',
            'TRANS_TYPE' => 'Trans  Type',
            'TRANS_TYPE_NM' => 'Trans  Type  Nm',
            'JUMLAH' => 'Jumlah',
            'CURRENT_TGL' => 'Current  Tgl',
            'TGL' => 'Tgl',
            'WAKTU' => 'Waktu',
            'REF_NUMBER' => 'Ref  Number',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

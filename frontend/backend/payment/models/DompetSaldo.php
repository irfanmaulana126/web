<?php

namespace frontend\backend\payment\models;

use Yii;

/**
 * This is the model class for table "dompet_saldo".
 *
 * @property string $ACCESS_GROUP user ACCESS_LEVEL=OWNER (ACCESS_ID=ACCESS_GROUP)
 * @property string $VA_ID VIRTUAL ACCOUT ID
 * @property string $SALDO_DOMPET total semua saldo
 * @property string $SALDO_MENEGNDAP saldo mengendap di tahan
 * @property string $SALDO_JUALAN
 * @property string $CURRENT_TGL diambil dari Tbl ptr_ppob_lpts4->current_date
 * @property string $TGL
 * @property string $WAKTU diambil dari Tbl ptr_ppob_lpts4->current_date
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class DompetSaldo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dompet_saldo';
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
            [['ACCESS_GROUP', 'VA_ID'], 'required'],
            [['SALDO_DOMPET', 'SALDO_MENEGNDAP', 'SALDO_JUALAN'], 'number'],
            [['CURRENT_TGL', 'TGL', 'WAKTU', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['VA_ID'], 'string', 'max' => 100],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['ACCESS_GROUP', 'VA_ID'], 'unique', 'targetAttribute' => ['ACCESS_GROUP', 'VA_ID']],
            [['ACCESS_GROUP'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACCESS_GROUP' => 'Access  Group',
            'VA_ID' => 'Va  ID',
            'SALDO_DOMPET' => 'Saldo  Dompet',
            'SALDO_MENEGNDAP' => 'Saldo  Menegndap',
            'SALDO_JUALAN' => 'Saldo  Jualan',
            'CURRENT_TGL' => 'Current  Tgl',
            'TGL' => 'Tgl',
            'WAKTU' => 'Waktu',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

<?php

namespace frontend\backend\payment\models;

use Yii;

/**
 * This is the model class for table "dompet_transcode".
 *
 * @property string $TRANSCODE Code Transaksi
 * @property string $TRANS_NM Nama Transaksi
 * @property string $TRANS_DCRP
 * @property int $TRANS_TYPE 0=masuk;1=keluar
 * @property string $TRANS_TYPE_NM
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class DompetTranscode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dompet_transcode';
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
            [['TRANSCODE', 'TRANS_NM'], 'required'],
            [['TRANS_DCRP'], 'string'],
            [['TRANS_TYPE'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TRANSCODE'], 'string', 'max' => 5],
            [['TRANS_NM', 'TRANS_TYPE_NM'], 'string', 'max' => 100],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['TRANSCODE', 'TRANS_NM'], 'unique', 'targetAttribute' => ['TRANSCODE', 'TRANS_NM']],
            [['TRANSCODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANSCODE' => 'Transcode',
            'TRANS_NM' => 'Trans  Nm',
            'TRANS_DCRP' => 'Trans  Dcrp',
            'TRANS_TYPE' => 'Trans  Type',
            'TRANS_TYPE_NM' => 'Trans  Type  Nm',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

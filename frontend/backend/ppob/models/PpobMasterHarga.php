<?php

namespace frontend\backend\ppob\models;

use Yii;

/**
 * This is the model class for table "ppob_master_harga".
 *
 * @property string $ID
 * @property string $DETAIL_ID
 * @property string $KODE
 * @property string $KETERANGAN
 * @property string $NOMINAL
 * @property string $HARGA1
 * @property string $HARGA2
 * @property string $HARGA3
 * @property integer $STATUS
 * @property string $DCRIP
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class PpobMasterHarga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ppob_master_harga';
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
            [['DETAIL_ID'], 'required'],
            [['HARGA1', 'HARGA2', 'HARGA3'], 'number'],
            [['STATUS'], 'integer'],
            [['DCRIP'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DETAIL_ID'], 'string', 'max' => 8],
            [['KODE', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['KETERANGAN', 'NOMINAL'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DETAIL_ID' => 'Detail  ID',
            'KODE' => 'Kode',
            'KETERANGAN' => 'Keterangan',
            'NOMINAL' => 'Nominal',
            'HARGA1' => 'Harga1',
            'HARGA2' => 'Harga2',
            'HARGA3' => 'Harga3',
            'STATUS' => 'Status',
            'DCRIP' => 'Dcrip',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

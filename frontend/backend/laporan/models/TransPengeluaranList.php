<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "trans_pengeluaran_list".
 *
 * @property integer $ACCOUNT_ID
 * @property string $ACCOUNT_NM
 * @property integer $STATUS
 * @property string $KETERANGAN
 */
class TransPengeluaranList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_pengeluaran_list';
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
            [['STATUS'], 'integer'],
            [['KETERANGAN'], 'string'],
            [['ACCOUNT_NM'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACCOUNT_ID' => 'Account  ID',
            'ACCOUNT_NM' => 'Account  Nm',
            'STATUS' => 'Status',
            'KETERANGAN' => 'Keterangan',
        ];
    }
}

<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "merchant_type".
 *
 * @property string $TYPE_PAY_ID
 * @property string $TYPE_PAY_NM
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class MerchantType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant_type';
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
            [['DCRP_DETIL'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['TYPE_PAY_NM'], 'string', 'max' => 150],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TYPE_PAY_ID' => 'Type  Pay  ID',
            'TYPE_PAY_NM' => 'Type  Pay  Nm',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

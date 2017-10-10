<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "store_merchant".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property integer $TYPE_PAY
 * @property string $BANK_NM
 * @property string $MERCHANT_NM
 * @property string $MERCHANT_NO
 * @property string $MERCHANT_TOKEN
 * @property string $MERCHANT_URL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class StoreMerchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_merchant';
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
            [['STORE_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['TYPE_PAY', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['MERCHANT_URL', 'DCRP_DETIL'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
            [['BANK_NM', 'MERCHANT_NM', 'MERCHANT_NO', 'MERCHANT_TOKEN'], 'string', 'max' => 255],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'TYPE_PAY' => 'Type  Pay',
            'BANK_NM' => 'Bank  Nm',
            'MERCHANT_NM' => 'Merchant  Nm',
            'MERCHANT_NO' => 'Merchant  No',
            'MERCHANT_TOKEN' => 'Merchant  Token',
            'MERCHANT_URL' => 'Merchant  Url',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
}

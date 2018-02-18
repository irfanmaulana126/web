<?php

namespace frontend\backend\payment\models;

use Yii;

/**
 * This is the model class for table "store_payment".
 *
 * @property string $ID
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $ACCESS_ID
 * @property string $STORE_ID
 * @property string $STORE_NM
 * @property string $STORE_STATUS
 * @property string $FAKTURE
 * @property string $FAKTURE_DATE
 * @property integer $FAKTURE_TEMPO
 * @property string $PAY_PAKAGE
 * @property string $PAY_DATE
 * @property integer $PAY_DURATION_ACTIVE
 * @property integer $PAY_DURATION_BONUS
 * @property string $PAY_TOTAL
 */
class StorePayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_payment';
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
            [['CREATE_AT', 'UPDATE_AT', 'FAKTURE_DATE', 'PAY_PAKAGE', 'PAY_DATE'], 'safe'],
            [['STATUS', 'STORE_STATUS', 'FAKTURE_TEMPO', 'PAY_DURATION_ACTIVE', 'PAY_DURATION_BONUS'], 'integer'],
            [['ACCESS_ID'], 'string'],
            [['PAY_TOTAL'], 'number'],
            [['CREATE_BY', 'UPDATE_BY', 'STORE_ID', 'FAKTURE'], 'string', 'max' => 50],
            [['STORE_NM'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
            'ACCESS_ID' => 'Access  ID',
            'STORE_ID' => 'Store  ID',
            'STORE_NM' => 'Store  Nm',
            'STORE_STATUS' => 'Store  Status',
            'FAKTURE' => 'Fakture',
            'FAKTURE_DATE' => 'Fakture  Date',
            'FAKTURE_TEMPO' => 'Fakture  Tempo',
            'PAY_PAKAGE' => 'Pay  Pakage',
            'PAY_DATE' => 'Pay  Date',
            'PAY_DURATION_ACTIVE' => 'Pay  Duration  Active',
            'PAY_DURATION_BONUS' => 'Pay  Duration  Bonus',
            'PAY_TOTAL' => 'Pay  Total',
        ];
    }
}

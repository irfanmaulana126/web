<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product_stock".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PRODUCT_ID
 * @property double $LAST_STOCK
 * @property string $INPUT_DATE
 * @property string $INPUT_TIME
 * @property double $INPUT_STOCK
 * @property string $CURRENT_DATE
 * @property string $CURRENT_TIME
 * @property double $CURRENT_STOCK
 * @property double $SISA_STOCK
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class ProductStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_stock';
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
            [['PRODUCT_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['LAST_STOCK', 'INPUT_STOCK', 'CURRENT_STOCK', 'SISA_STOCK'], 'number'],
            [['INPUT_DATE', 'INPUT_TIME', 'CURRENT_DATE', 'CURRENT_TIME', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['PRODUCT_ID'], 'string', 'max' => 35],
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
            'PRODUCT_ID' => 'Product  ID',
            'LAST_STOCK' => 'Last  Stock',
            'INPUT_DATE' => 'Input  Date',
            'INPUT_TIME' => 'Input  Time',
            'INPUT_STOCK' => 'Input  Stock',
            'CURRENT_DATE' => 'Current  Date',
            'CURRENT_TIME' => 'Current  Time',
            'CURRENT_STOCK' => 'Current  Stock',
            'SISA_STOCK' => 'Sisa  Stock',
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

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product_discount".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $PRODUCT_ID
 * @property string $PERIODE_TGL1
 * @property string $PERIODE_TGL2
 * @property string $START_TIME
 * @property string $DISCOUNT
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class ProductDiscount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_discount';
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
            [['PERIODE_TGL1', 'PERIODE_TGL2', 'START_TIME', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DISCOUNT'], 'number'],
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
            'PERIODE_TGL1' => 'Periode  Tgl1',
            'PERIODE_TGL2' => 'Periode  Tgl2',
            'START_TIME' => 'Start  Time',
            'DISCOUNT' => 'Discount',
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

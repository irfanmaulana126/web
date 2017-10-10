<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product_unit".
 *
 * @property string $UNIT_ID
 * @property string $UNIT_NM
 * @property integer $UNIT_ID_GRP
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class ProductUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_unit';
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
            [['UNIT_ID'], 'required'],
            [['UNIT_ID_GRP', 'STATUS'], 'integer'],
            [['DCRP_DETIL'], 'string'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['UNIT_ID'], 'string', 'max' => 6],
            [['UNIT_NM', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNIT_ID' => 'Unit  ID',
            'UNIT_NM' => 'Unit  Nm',
            'UNIT_ID_GRP' => 'Unit  Id  Grp',
            'STATUS' => 'Status',
            'DCRP_DETIL' => 'Dcrp  Detil',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

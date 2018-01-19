<?php

namespace frontend\backend\master\models;

use Yii;

class ProductUnitGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_unit_group';
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
            [['UNIT_ID_GRP', 'UNIT_NM_GRP','STATUS'], 'required'],
            [['UNIT_ID_GRP','STATUS'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNIT_ID_GRP' => 'ID',
            'UNIT_NM_GRP' => 'UNIT GROUP  Name',
            'STATUS'=>'Status',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  AT',
        ];
    }
	
	
}

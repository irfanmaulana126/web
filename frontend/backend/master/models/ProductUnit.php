<?php

namespace frontend\backend\master\models;

use Yii;

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
            [['UNIT_ID', 'UNIT_NM', 'UNIT_ID_GRP','STATUS'], 'required'],
            [['UNIT_ID', 'UNIT_ID_GRP'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UNIT_ID' => 'ID',
            'UNIT_ID_GRP' => 'UNIT  Group',
            'UNIT_NM' => 'UNIT  Name',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  AT',
        ];
    }
	
	
}

<?php

namespace frontend\backend\master\models;

use Yii;

class Industry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'industri';
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
            [['INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'INDUSTRY_NM'], 'required'],
            [['INDUSTRY_ID', 'INDUSTRY_GRP_ID'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INDUSTRY_ID' => 'ID',
            'INDUSTRY_GRP_ID' => 'INDUSTRI GROUP',
            'INDUSTRY_NM' => 'NAMA INDUSTRI',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  AT',
        ];
    }
	
	
}

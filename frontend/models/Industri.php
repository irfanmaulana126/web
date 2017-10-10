<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "industri".
 *
 * @property integer $INDUSTRY_ID
 * @property integer $INDUSTRY_GRP
 * @property string $INDUSTRY_NM
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 */
class Industri extends \yii\db\ActiveRecord
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
            [['INDUSTRY_GRP', 'STATUS'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['INDUSTRY_NM'], 'string', 'max' => 255],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INDUSTRY_ID' => 'Industry  ID',
            'INDUSTRY_GRP' => 'Industry  Grp',
            'INDUSTRY_NM' => 'Industry  Nm',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
        ];
    }
}

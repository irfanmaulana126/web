<?php

namespace frontend\backend\sistem\models;

use Yii;

/**
 * This is the model class for table "corp".
 *
 * @property string $ID
 * @property string $ACCESS_ID user.ACCESS_ID=many of group( corp.ACCESS_ID)
 * @property string $CORP_NM
 * @property string $ALAMAT
 * @property double $MAP_LAG
 * @property double $MAP_LAT
 * @property int $STATUS
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class Corp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'corp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_ID'], 'required'],
            [['ACCESS_ID', 'ALAMAT'], 'string'],
            [['MAP_LAG', 'MAP_LAT'], 'number'],
            [['STATUS'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['CORP_NM'], 'string', 'max' => 255],
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
            'ACCESS_ID' => 'Access  ID',
            'CORP_NM' => 'Corp  Nm',
            'ALAMAT' => 'Alamat',
            'MAP_LAG' => 'Map  Lag',
            'MAP_LAT' => 'Map  Lat',
            'STATUS' => 'Status',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

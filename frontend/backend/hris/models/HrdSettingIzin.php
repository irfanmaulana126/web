<?php

namespace frontend\backend\hris\models;

use Yii;
use common\models\Store;

/**
 * This is the model class for table "hrd_setting_izin".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property integer $IZIN_ID
 * @property string $IZIN_NM
 * @property integer $IZIN_STT
 * @property string $IZIN_STT_NM
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class HrdSettingIzin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hrd_setting_izin';
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
            [['IZIN_ID', 'IZIN_STT', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
            [['IZIN_NM', 'IZIN_STT_NM', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'IZIN_ID' => 'Izin  ID',
            'IZIN_NM' => 'Izin  Nm',
            'IZIN_STT' => 'Izin  Stt',
            'IZIN_STT_NM' => 'Izin  Stt  Nm',
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
    public function getStore()
    {
        if ($this->STORE_ID){
            return $this->hasOne(Store::className(),['STORE_ID'=>'STORE_ID']);
        }else{
            return '';
        }
    }
}

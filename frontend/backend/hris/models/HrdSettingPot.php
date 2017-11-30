<?php

namespace frontend\backend\hris\models;

use Yii;

/**
 * This is the model class for table "hrd_setting_pot".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property integer $SHIFT_ID
 * @property integer $STT_POTONGAN
 * @property string $POT_PERSEN
 * @property string $POT_RUPIAH
 * @property string $POT_JAM1
 * @property string $POT_JAM2
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 * @property string $DCRP_DETIL
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class HrdSettingPot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hrd_setting_pot';
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
            [['STORE_ID', 'STT_POTONGAN', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['SHIFT_ID', 'STT_POTONGAN', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['POT_PERSEN', 'POT_RUPIAH'], 'number'],
            [['POT_JAM1', 'POT_JAM2', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['DCRP_DETIL'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 25],
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
            'SHIFT_ID' => 'Shift  ID',
            'STT_POTONGAN' => 'Stt  Potongan',
            'POT_PERSEN' => 'Pot  Persen',
            'POT_RUPIAH' => 'Pot  Rupiah',
            'POT_JAM1' => 'Pot  Jam1',
            'POT_JAM2' => 'Pot  Jam2',
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

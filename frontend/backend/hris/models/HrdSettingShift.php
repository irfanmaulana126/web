<?php

namespace frontend\backend\hris\models;

use Yii;

/**
 * This is the model class for table "hrd_setting_shift".
 *
 * @property string $SHIFT_ID
 * @property string $SHIFT_NM
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property integer $STATUS
 */
class HrdSettingShift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hrd_setting_shift';
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
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STATUS'], 'integer'],
            [['SHIFT_NM'], 'string', 'max' => 255],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SHIFT_ID' => 'Shift  ID',
            'SHIFT_NM' => 'Shift  Nm',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
            'STATUS' => 'Status',
        ];
    }
}

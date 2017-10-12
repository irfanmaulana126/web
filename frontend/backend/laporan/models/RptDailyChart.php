<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "rpt_daily_chart".
 *
 * @property integer $Id
 * @property string $Val_Nm
 * @property integer $Val_Cnt
 * @property string $Val_Json
 * @property string $ACCESS_GROUP
 * @property string $UPDT
 */
class RptDailyChart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rpt_daily_chart';
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
            [['Val_Cnt'], 'safe'],
            [['Val_Json'], 'string'],
            [['UPDT'], 'safe'],
            [['Val_Nm'],'safe'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Val_Nm' => 'Val  Nm',
            'Val_Cnt' => 'Val  Cnt',
            'Val_Json' => 'Val  Json',
            'ACCESS_GROUP' => 'Access  Group',
            'UPDT' => 'Updt',
        ];
    }
}

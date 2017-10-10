<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "app_modul".
 *
 * @property integer $ID
 * @property string $MODUL_ID
 * @property string $MODUL_NM
 * @property string $MODUL_GRP
 * @property integer $SORT_PARENT
 * @property integer $SORT
 * @property integer $MODUL_STS
 * @property string $MODUL_DCRP
 */
class AppModul extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_modul';
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
            [['MODUL_ID'], 'required'],
            [['SORT_PARENT', 'SORT', 'MODUL_STS'], 'integer'],
            [['MODUL_DCRP'], 'string'],
            [['MODUL_ID', 'MODUL_GRP'], 'string', 'max' => 5],
            [['MODUL_NM'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MODUL_ID' => 'Modul  ID',
            'MODUL_NM' => 'Modul  Nm',
            'MODUL_GRP' => 'Modul  Grp',
            'SORT_PARENT' => 'Sort  Parent',
            'SORT' => 'Sort',
            'MODUL_STS' => 'Modul  Sts',
            'MODUL_DCRP' => 'Modul  Dcrp',
        ];
    }
}

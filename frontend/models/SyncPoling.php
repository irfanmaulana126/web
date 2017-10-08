<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sync_pooling".
 *
 * @property string $ID
 * @property string $NM_TABLE
 * @property string $PRIMARIKEY
 * @property integer $TYPE_ACTION
 * @property integer $STT_OPS
 * @property integer $STT_OWNER
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class SyncPoling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sync_pooling';
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
            [['ID', 'TYPE_ACTION', 'STT_OPS', 'STT_OWNER'], 'integer'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['NM_TABLE', 'PRIMARIKEY'], 'string', 'max' => 255],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
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
            'NM_TABLE' => 'Nm  Table',
            'PRIMARIKEY' => 'Primarikey',
            'TYPE_ACTION' => 'Type  Action',
            'STT_OPS' => 'Stt  Ops',
            'STT_OWNER' => 'Stt  Owner',
            'ACCESS_GROUP' => 'Access  Group',
            'STORE_ID' => 'Store  ID',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
}

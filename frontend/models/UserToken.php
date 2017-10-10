<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $create_at
 * @property string $updated_at
 * @property string $ACCESS_ID
 * @property string $ACCESS_GROUP
 * @property string $ACCESS_LEVEL
 * @property integer $ACCESS_SITE
 * @property integer $ONLINE
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $icon
 * @property integer $icon_type
 * @property integer $YEAR_AT
 * @property integer $MONTH_AT
 */
class UserToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
            [['username', 'ACCESS_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['auth_key'], 'string'],
            [['status', 'ACCESS_SITE', 'ONLINE', 'lft', 'rgt', 'lvl', 'icon_type', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['create_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'icon'], 'string', 'max' => 255],
            [['ACCESS_ID', 'ACCESS_GROUP'], 'string', 'max' => 15],
            [['ACCESS_LEVEL'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'ACCESS_ID' => 'Access  ID',
            'ACCESS_GROUP' => 'Access  Group',
            'ACCESS_LEVEL' => 'Access  Level',
            'ACCESS_SITE' => 'Access  Site',
            'ONLINE' => 'Online',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'icon' => 'Icon',
            'icon_type' => 'Icon Type',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
}

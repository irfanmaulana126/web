<?php

namespace frontend\backend\sistem\models;

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
 * @property int $status
 * @property string $create_at
 * @property string $updated_at
 * @property string $ACCESS_ID *Schema1
  username= piter
  ACCESS_ID= 123
  ACCESS_GROUP=OWNER
  ACCESS_SITE=" 2 "=website & mobile App
  status= 10
 *Schema2 
  username= syaka
  ACCESS_UNIX= 1234
  ACCESS_GROUP=123
  ACCESS_SITE=" 3"=Mobile App
  status= 0
 *Schema2 
  username= s
 * @property string $ACCESS_GROUP
 * @property string $ACCESS_LEVEL ACCESS_UNIX -> validate group.
 
 ADMIN = Administrasi registrasi/admin system
 OWNER = PEMILIK
 OTHER  = FOLLOWER [ACCESS_UNIX]
 1.KASIR
 2.INVENTORY
 3.ACCONTING
 
 * @property int $ACCESS_SITE POSITION_SITE (APP POSITION)
 1 = ADMIN   = Admin Control
 2 = BACKEND = User Backend (web/mobile).
 3 = MOBILE    = Mobile Control
 
 * @property string $UUID
 * @property int $ONLINE 0 = ofline and 1 = online 
 * @property string $ID_GOOGLE
 * @property string $ID_FB
 * @property string $ID_TWITTER
 * @property string $ID_LINKEDIN
 * @property string $ID_YAHOO
 * @property string $TEMPLATE
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 * @property string $icon
 * @property int $icon_type
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 */
class User extends \yii\db\ActiveRecord
{

    public $newPassword;
    public $newPasswordConfirm;
    public $currentPassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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

            [['newPassword','currentPassword','newPasswordConfirm'],'required'],
            // [['currentPassword'],'validateCurrentPassword'],

            [['newPassword','newPasswordConfirm'],'string','min'=>6],
            [['newPassword','newPasswordConfirm'],'filter','filter'=>'trim'],
            [['newPasswordConfirm'],'compare','compareAttribute'=>'newPassword','message'=>'Password do not match'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'ID_GOOGLE', 'ID_FB', 'ID_TWITTER', 'ID_LINKEDIN', 'ID_YAHOO', 'icon'], 'string', 'max' => 255],
            [['ACCESS_ID', 'ACCESS_GROUP'], 'string', 'max' => 15],
            [['ACCESS_LEVEL', 'UUID'], 'string', 'max' => 50],
            [['TEMPLATE'], 'string', 'max' => 100],
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
            'UUID' => 'Uuid',
            'ONLINE' => 'Online',
            'ID_GOOGLE' => 'Id  Google',
            'ID_FB' => 'Id  Fb',
            'ID_TWITTER' => 'Id  Twitter',
            'ID_LINKEDIN' => 'Id  Linkedin',
            'ID_YAHOO' => 'Id  Yahoo',
            'TEMPLATE' => 'Template',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'icon' => 'Icon',
            'icon_type' => 'Icon Type',
            'YEAR_AT' => 'Year  At',
            'MONTH_AT' => 'Month  At',
        ];
    }
    public function validateCurrentPassword()
    {
       if(!$this->verifyPassword($this->currentPassword)){
           $this->addError("currentPassword","current Password incorrect");
       }
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}

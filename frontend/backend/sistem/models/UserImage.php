<?php

namespace frontend\backend\sistem\models;

use Yii;

/**
 * This is the model class for table "user_image".
 *
 * @property string $ID
 * @property string $ACCESS_ID
 * @property string $ACCESS_IMAGE
 * @property string $CREATE_BY USER pembuat
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY user Ubah
 * @property string $UPDATE_AT Tanggal diubah
 * @property int $STATUS 0=disable; 1=enable
 * @property string $DCRP_DETIL
 * @property int $YEAR_AT partisi unix
 * @property int $MONTH_AT partisi unix
 */
 
use yii\web\UploadedFile;

class UserImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	public $upload_file;
	public $image;
    public static function tableName()
    {
        return 'user_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCESS_ID', 'YEAR_AT', 'MONTH_AT'], 'required'],
            [['ACCESS_IMAGE', 'DCRP_DETIL'], 'string'],
            [['upload_file'], 'file', 'skipOnEmpty' => true,'extensions'=>'jpg,png', 'mimeTypes'=>'image/jpeg, image/png','maxSize' => 512000, 'tooBig' => 'Limit is 500KB'],
			[['ACCESS_IMAGE'],'file','skipOnEmpty'=>TRUE,'extensions'=>'jpg, png', 'mimeTypes'=>'image/jpeg, image/png','maxSize' => 512000, 'tooBig' => 'Limit is 500KB'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_ID', 'CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
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
            'ACCESS_IMAGE' => 'Access  Image',
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
	public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'ACCESS_IMAGE');
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        // store the source file name
        //$this->filename = $image->name;
        $ext = end((explode(".", $image->name)));
        // generate a unique file name
        // $this->EMP_IMG = 'wan-'.date('ymdHis').".{$ext}"; //$image->name;//Yii::$app->security->generateRandomString().".{$ext}";
        // the uploaded image instance
        return $image;
    }
}

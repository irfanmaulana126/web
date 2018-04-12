<?php

namespace frontend\backend\sistem\models;

use Yii;

use yii\web\UploadedFile;
/**
 * This is the model class for table "corp_64".
 *
 * @property string $ID
 * @property string $CORP_NM
 * @property string $CORP_64
 * @property string $BERKAS_IMG
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 */
class CorpImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'corp_64';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CORP_64','BERKAS_IMG','ACCESS_ID'], 'string'],
            [['CORP_64'],'file','skipOnEmpty'=>TRUE,'extensions'=>'jpg, png'],
            [['BERKAS_IMG'], 'file','skipOnEmpty'=>TRUE,'maxFiles'=>6,'extensions'=>'jpg, png', 'mimeTypes'=>'image/jpeg, image/png'],
            [['CREATE_AT', 'UPDATE_AT','ACCESS_ID'], 'safe'],
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
            'CORP_NM' => 'Corp  Nm',
            'CORP_64' => 'Corp 64',
            'BERKAS_IMG' => 'BERKAS IMG',
            'CREATE_BY' => 'Create  By',
            'CREATE_AT' => 'Create  At',
            'UPDATE_BY' => 'Update  By',
            'UPDATE_AT' => 'Update  At',
        ];
    }
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'CORP_64');
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        // store the source file name
        //$this->filename = $image->name;
        $tmp = explode('.', $image->name);
        $ext = end($tmp);
        // generate a unique file name
        // $this->EMP_IMG = 'wan-'.date('ymdHis').".{$ext}"; //$image->name;//Yii::$app->security->generateRandomString().".{$ext}";
        // the uploaded image instance
        return $image;
    }
}

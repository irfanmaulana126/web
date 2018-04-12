<?php

namespace frontend\backend\sistem\models;

use Yii;

/**
 * This is the model class for table "dompet_rekening_image".
 *
 * @property string $ID
 * @property int $ACCESS_GROUP
 * @property resource $IMAGE
 * @property string $CREATE_BY
 * @property string $CREATE_AT
 * @property string $UPDATE_BY
 * @property string $UPDATE_AT
 * @property int $STATUS
 * @property string $DCRP_DETIL
 * @property int $YEAR_AT
 * @property int $MONTH_AT
 */

use yii\web\UploadedFile;
class DompetRekeningImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

	public $upload_file;
	public $image;
    public static function tableName()
    {
        return 'dompet_rekening_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'ACCESS_GROUP', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['IMAGE', 'DCRP_DETIL'], 'string'],
            [['upload_file'], 'file','skipOnEmpty'=>TRUE,'maxFiles'=>2,'extensions'=>'jpg, png', 'mimeTypes'=>'image/jpeg, image/png'],
            [['IMAGE'], 'file','skipOnEmpty'=>TRUE,'maxFiles'=>2,'extensions'=>'jpg, png', 'mimeTypes'=>'image/jpeg, image/png'],
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['CREATE_BY', 'UPDATE_BY'], 'string', 'max' => 50],
            [['ID'], 'unique'],
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
            'IMAGE' => 'Image',
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
        $image = UploadedFile::getInstance($this, 'IMAGE');
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        // store the source file name
        //$this->filename = $image->name;
        $tmp = explode('.', $image->name);
        $ext = end($tmp);
        print_r($image);die();
        // generate a unique file name
        // $this->EMP_IMG = 'wan-'.date('ymdHis').".{$ext}"; //$image->name;//Yii::$app->security->generateRandomString().".{$ext}";
        // the uploaded image instance
        return $image;
    }
}

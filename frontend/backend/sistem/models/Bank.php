<?php

namespace frontend\backend\sistem\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $ID
 * @property string $BANK_NM
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BANK_NM'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'BANK_NM' => 'Bank  Nm',
        ];
    }
}

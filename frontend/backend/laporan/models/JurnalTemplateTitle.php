<?php

namespace frontend\backend\laporan\models;

use Yii;

/**
 * This is the model class for table "jurnal_template_title".
 *
 * @property string $RPT_TITLE_ID
 * @property string $RPT_TITLE_NM
 * @property int $RPT_GROUP_ID
 * @property string $RPT_GROUP_NM
 * @property int $STATUS
 * @property string $KETERANGAN
 */
class JurnalTemplateTitle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurnal_template_title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RPT_GROUP_ID'], 'required'],
            [['RPT_GROUP_ID', 'STATUS'], 'integer'],
            [['KETERANGAN'], 'string'],
            [['RPT_TITLE_NM', 'RPT_GROUP_NM'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RPT_TITLE_ID' => 'Rpt  Title  ID',
            'RPT_TITLE_NM' => 'Rpt  Title  Nm',
            'RPT_GROUP_ID' => 'Rpt  Group  ID',
            'RPT_GROUP_NM' => 'Rpt  Group  Nm',
            'STATUS' => 'Status',
            'KETERANGAN' => 'Keterangan',
        ];
    }
}

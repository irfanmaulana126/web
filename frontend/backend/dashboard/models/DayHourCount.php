<?php

namespace frontend\backend\dashboard\models;

use Yii;

/**
 * This is the model class for table "ptr_kasir_th1_hour".
 *
 * @property string $ID
 * @property string $ACCESS_GROUP
 * @property string $STORE_ID
 * @property string $TAHUN
 * @property int $BULAN
 * @property string $TGL
 * @property int $VAL1
 * @property int $VAL2
 * @property int $VAL3
 * @property int $VAL4
 * @property int $VAL5
 * @property int $VAL6
 * @property int $VAL7
 * @property int $VAL8
 * @property int $VAL9
 * @property int $VAL10
 * @property int $VAL11
 * @property int $VAL12
 * @property int $VAL13
 * @property int $VAL14
 * @property int $VAL15
 * @property int $VAL16
 * @property int $VAL17
 * @property int $VAL18
 * @property int $VAL19
 * @property int $VAL20
 * @property int $VAL21
 * @property int $VAL22
 * @property int $VAL23
 * @property int $VAL24
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 * @property string $KETERANGAN
 */
class DayHourCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ptr_kasir_th1_hour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BULAN', 'VAL1', 'VAL2', 'VAL3', 'VAL4', 'VAL5', 'VAL6', 'VAL7', 'VAL8', 'VAL9', 'VAL10', 'VAL11', 'VAL12', 'VAL13', 'VAL14', 'VAL15', 'VAL16', 'VAL17', 'VAL18', 'VAL19', 'VAL20', 'VAL21', 'VAL22', 'VAL23', 'VAL24'], 'integer'],
            [['TGL', 'CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['KETERANGAN'], 'string'],
            [['ACCESS_GROUP'], 'string', 'max' => 15],
            [['STORE_ID'], 'string', 'max' => 20],
            [['TAHUN'], 'string', 'max' => 5],
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
            'STORE_ID' => 'Store  ID',
            'TAHUN' => 'Tahun',
            'BULAN' => 'Bulan',
            'TGL' => 'Tgl',
            'VAL1' => 'Val1',
            'VAL2' => 'Val2',
            'VAL3' => 'Val3',
            'VAL4' => 'Val4',
            'VAL5' => 'Val5',
            'VAL6' => 'Val6',
            'VAL7' => 'Val7',
            'VAL8' => 'Val8',
            'VAL9' => 'Val9',
            'VAL10' => 'Val10',
            'VAL11' => 'Val11',
            'VAL12' => 'Val12',
            'VAL13' => 'Val13',
            'VAL14' => 'Val14',
            'VAL15' => 'Val15',
            'VAL16' => 'Val16',
            'VAL17' => 'Val17',
            'VAL18' => 'Val18',
            'VAL19' => 'Val19',
            'VAL20' => 'Val20',
            'VAL21' => 'Val21',
            'VAL22' => 'Val22',
            'VAL23' => 'Val23',
            'VAL24' => 'Val24',
            'CREATE_AT' => 'Create  At',
            'UPDATE_AT' => 'Update  At',
            'KETERANGAN' => 'Keterangan',
        ];
    }
	
	public function fields()
	{
		return [			
			'ACCESS_GROUP'=>function($model){
				return $model->ACCESS_GROUP;
			},
			'STORE_ID'=>function($model){
				return $model->STORE_ID;
			},
			'TAHUN'=>function($model){
				return $model->TAHUN;
			},
			'BULAN'=>function($model){
				return $model->BULAN;
			},
			'TGL'=>function($model){
				return $model->TGL;
			},
			'VAL1'=>function($model){
				return $model->VAL1;
			},
			'VAL2'=>function($model){
				return $model->VAL2;
			},
			'VAL3'=>function($model){
				return $model->VAL3;
			},
			'VAL4'=>function($model){
				return $model->VAL4;
			},
			'VAL5'=>function($model){
				return $model->VAL5;
			},
			'VAL6'=>function($model){
				return $model->VAL6;
			},
			'VAL7'=>function($model){
				return $model->VAL7;
			},
			'VAL8'=>function($model){
				return $model->VAL8;
			},
			'VAL9'=>function($model){
				return $model->VAL9;
			},
			'VAL10'=>function($model){
				return $model->VAL10;
			},
			'VAL11'=>function($model){
				return $model->VAL11;
			},
			'VAL12'=>function($model){
				return $model->VAL12;
			},
			'VAL13'=>function($model){
				return $model->VAL13;
			},
			'VAL14'=>function($model){
				return $model->VAL14;
			},
			'VAL15'=>function($model){
				return $model->VAL15;
			},
			'VAL16'=>function($model){
				return $model->VAL16;
			},
			'VAL17'=>function($model){
				return $model->VAL17;
			},
			'VAL18'=>function($model){
				return $model->VAL18;
			},
			'VAL19'=>function($model){
				return $model->VAL19;
			},
			'VAL20'=>function($model){
				return $model->VAL20;
			},
			'VAL21'=>function($model){
				return $model->VAL21;
			},
			'VAL22'=>function($model){
				return $model->VAL22;
			},
			'VAL23'=>function($model){
				return $model->VAL23;
			},
			'VAL24'=>function($model){
				return $model->VAL24;
			}			
		];
	}
}

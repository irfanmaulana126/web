<?php

namespace frontend\backend\dashboard\models;

use Yii;
use yii\base\Model;
use frontend\backend\dashboard\models\WeeklySales;
use frontend\backend\dashboard\models\Store;

class ChartWeeklySales extends Model
{
	 public $ACCESS_GROUP;
	 public $BULAN;
	 public $MINGGU;
	 public $bULAN;
	 public $TAHUN;
	 public $TOTAL_JUAL;
	 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BULAN', 'MINGGU','ACCESS_GROUP'], 'integer'],
           [['TAHUN','TOTAL_JUAL'], 'string', 'max' => 5],
        ];
    }   
	
	public function fields()
	{
		return [			
			'chart'=>function($model){
				return self::chartlabel($model->TAHUN,$model->BULAN);
			},
			'categories'=>function(){
				return [
					self::categorieslabel()
				];
			},
			'dataset'=>function($model){
				return self::chartData($model->ACCESS_GROUP,$model->TAHUN,$model->BULAN);				
			}
		];
	}
	
	private function chartData($accessGroup,$tahun,$bulan){		
		//== PARAM TO CURRENT VARIABLE / DEFAULT VARIABLE
		// $accessGroup=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];
		$varAccessGroup = $accessGroup!=''?$accessGroup:Yii::$app->getUserOpt->user()['ACCESS_GROUP'];//'170726220936';
		$varTahun		= $tahun!=''?$tahun:date('Y');
		$varBulan		= $bulan!=''?$bulan:date('m');
		
		$datasetRslt=[];
		//=[0]== AMBIL STORE OF ACCESS_GROUP
		$modelStore=Store::find()->where(['ACCESS_GROUP'=>$varAccessGroup])->all();
	
		foreach($modelStore as $rowStore => $valStore){
			//=[1]== AMBIL DATA WEEKLY SALES
			$modelWeek=WeeklySales::find()->where([
				'STORE_ID'=>$valStore['STORE_ID'],//'170726220936.0001',
				'TAHUN'=>$varTahun,
				'BULAN'=>$varBulan
			])->all();
			
			//=[2]== AMBIL MINGGU AWAL BULAN
			$firstWeekOfMonth=self::weekOfMonthMysql(date('Y-m-d',strtotime($varTahun.'-'.$varBulan.'-01')));
			
			if ($modelWeek){	
					$rslt1['seriesname']=$valStore['STORE_NM'];//$modelWeek[0]['STORE_NM'];
					$dataval1=[];
					//=[3]==LOOPING 5 MINGGU
					for( $i= 1 ; $i <= 5 ; $i++ ) {
						$cariWeek=3 + $i;					
						$valData=Yii::$app->arrayBantuan->array_find($modelWeek,'MINGGU',$cariWeek);
						
						if($valData){
							$dataval1[]=['label'=>'w'.$valData[0]['MINGGU'],'value'=>$valData[0]['TOTAL_JUAL']];
						}else{
							$dataval1[]=['label'=>'w'.$i,'value'=>'0'];
						};						
					} 
					//=[4]==SETTING ARRAY
					$rslt1['data']=$dataval1;	
					//$rsltDataSet1[]=$rslt1;
		
				$dataset=$rslt1;//$rsltDataSet1;	
			}else{
				//=[6]== SCENARIO DATA KOSONG				
				$dataset=[
						"seriesname"=>$valStore['STORE_NM'],//"Tidak ditemukan data",
						"data"=>"null"					
				];
			}
			
			$datasetRslt[]=$dataset;
		}
		return $datasetRslt;		//jika data ada
	}
	
	private function chartlabel($tahun,$bulan){
		$varTahun		= $tahun!=''?$tahun:date('Y');
		$varBulan		= $bulan!=''?$bulan:date('m');
		$nmBulan=date('F', strtotime($varTahun.'-'.$varBulan.'-01')); // Nama Bulan
		$chart=[
			"caption"=>"RINGKASAN PENJUALAN MINGGUAN",
			"subCaption"=>"TAHUN ".$varTahun.', '.$nmBulan,
			"captionFontSize"=>"12",
			"subcaptionFontSize"=>"10",
			"subcaptionFontBold"=>"0",
			"paletteColors"=>Yii::$app->arrayBantuan->ArrayPaletteColors(),
			"bgcolor"=>"#ffffff",
			"showBorder"=>"0",
			"showShadow"=>"0",				
			"usePlotGradientColor"=>"0",
			"legendBorderAlpha"=>"0",
			"legendShadow"=>"0",
			"showAxisLines"=>"1",
			"showAlternateHGridColor"=>"0",
			"divlineThickness"=>"1",
			"divLineIsDashed"=>"0",				
			"divLineDashLen"=>"1",				
			"divLineGapLen"=>"1",
			"vDivLineDashed"=>"0",
			"numVDivLines"=>"11",
			"vDivLineThickness"=>"1",
			"xAxisName"=>"Toko",
			"yAxisName"=>"Rupiah",				
			"anchorradius"=>"6",
			"plotHighlightEffect"=>"fadeout|color=#f6f5fd, alpha=60",
			"showValues"=>"0",
			"rotateValues"=>"0",
			"placeValuesInside"=>"0",
			"formatNumberScale"=>"0",
			"decimalSeparator"=>",",
			"thousandSeparator"=>".",
			"numberPrefix"=>"",
			"ValuePadding"=>"0",
			"yAxisValuesStep"=>"1",
			"xAxisValuesStep"=>"0",
			"yAxisMinValue"=>"0",
			"numDivLines"=>"8",
			"xAxisNamePadding"=>"30",
			"showHoverEffect"=>"1",
			"animation"=>"1" ,
			"exportEnabled"=>"1",
			"exportFileName"=>"RINGKASAN-BULANAN",
			"exportAtClientSide"=>"1",
			"showValues"=>"1"				
		];
		return $chart;
	}
	
	private function categorieslabel(){
		$categories=[
			"category"=> [
				[
					"label"=>"Minggu-1"
				],
				[
					"label"=>"Minggu-2"
				],
				[
					"label"=>"Minggu-3"
				],
				[
					"label"=>"Minggu-4"
				],
				[
					"label"=>"Minggu-5"
				],
								
			],
		 ];
		 return $categories;
	}
	
	
	/*
	 * FUNCTION GET WEEK
	*/
	function weekOfMonthMysql($date) {
		$minggu= date('W', strtotime($date));
		if ($minggu<>0){
			//return ($minggu)-1;
			return ($minggu)-1;
		} else{
			return $minggu;
		}
	}
}

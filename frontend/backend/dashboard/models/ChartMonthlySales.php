<?php

namespace frontend\backend\dashboard\models;

use Yii;
use yii\base\Model;
use frontend\backend\dashboard\models\MonthlySales;
use frontend\backend\dashboard\models\Store;

class ChartMonthlySales extends Model
{
	 public $ACCESS_GROUP;
	 public $BULAN;
	 public $TAHUN;
	 public $TOTAL_JUAL;
	 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['BULAN','ACCESS_GROUP'], 'integer'],
           [['TAHUN'], 'string'],
           [['TOTAL_JUAL'], 'safe'],
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
			$modelMonth=MonthlySales::find()->where([
				'STORE_ID'=>$valStore['STORE_ID'],//'170726220936.0001',
				'TAHUN'=>$varTahun,
				//'BULAN'=>$varBulan
			])->all();
			
			//=[2]== AMBIL MINGGU AWAL BULAN
			//$firstWeekOfMonth=$model= self::weekOfMonthMysql($varTahun.'-'.$varBulan.'-01');
			
			if ($modelMonth){	
					$rslt1['seriesname']=$valStore['STORE_NM'];//$modelWeek[0]['STORE_NM'];
					$dataval1=[];
					//=[3]==LOOPING 5 MINGGU
					for( $i= 1 ; $i <= 12 ; $i++ ) {
						//$cariWeek=$firstWeekOfMonth + $i;					
						$valData=Yii::$app->arrayBantuan->array_find($modelMonth,'BULAN',$i);
						
						if($valData){
							$dataval1[]=['label'=>'bln'.$valData[0]['BULAN'],'value'=>$valData[0]['TOTAL_JUAL']];
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
			"caption"=>"RINGKASAN PENJUALAN BULANAN",
			"subCaption"=>"TAHUN ".$varTahun.', '.$nmBulan,
			"captionFontSize"=>"12",
			"subcaptionFontSize"=>"10",
			"subcaptionFontBold"=>"0",
			"paletteColors"=> Yii::$app->arrayBantuan->ArrayPaletteColors(),
			"bgcolor"=>"#ffffff",
			"showBorder"=>"1",
			"showShadow"=>"0",				
			"usePlotGradientColor"=>"0",
			"legendBorderAlpha"=>"0",
			"legendShadow"=>"1",
			"showAxisLines"=>"0",
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
					"label"=> "january"
				],
				[
					"label"=> "February"
				],
				[
					"label"=> "March"
				],
				[
					"label"=> "April"
				],
				[
					"label"=> "Mey"
				],
				[
					"label"=> "June"
				],
				[
					"label"=> "July"
				],
				[
					"label"=> "Agustus"
				],
				[
					"label"=> "September"
				],
				[
					"label"=> "Oktober"
				],
				[
					"label"=> "November"
				],
				[
					"label"=> "Desember"
				]									
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
			return ($minggu)-1;
		} else{
			return $minggu;
		}
	}
}

<?php
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Html;

/**
 * DESCRIPTION REFRENCE
 * FORMAT 		: 'raw' atau ['decimal', 2]
 * hAlign		: right,left,top,middle
 * vAlign		: right,left,top,middle
 * FILTER ON:
 *  - PLUGIN DATE 	:'FILTER_WIDGET_OPTION'=>['pluginOptions'=>['format' => 'yyyy-mm-dd','autoclose' => true,'todayHighlight' => true,'autoWidget' => false,'todayBtn' => true,]],
 *  - PLUGIN SELECT2:'FILTER_WIDGET_OPTION'=>['pluginOptions'=>['allowClear'=>true]]
 *  - INPUT SELECT2 :'FILTER_INPUT_OPTION'=>['placeholder'=>'-Pilih-'],
 *  'FILTER_OPTION'=>['style'=>'background-color:rgba(255, 255, 255, 1); align:center','colspan'=>'0',],
 * FILTER OFF:
 *  'FILTER'=>false,'FILTER_TYPE'=>false,
 *  'FILTER_WIDGET_OPTION'=>[],
 *  'FILTER_INPUT_OPTION'=>['class'=>'form-control'],
 *	'FILTER_OPTION'=>[],
 */
function tombolAryColumn(){
	$H_FONT_COLOR1='white';
	$H_BG_COLOR1='rgba(87,114,111, 1)';
	$C_FONT_COLOR1='black';
	$C_FONT_COLOR2='red';
	$C_BG_COLOR1=false;
	
	$aryFieldColomn[]=[
	'ID' =>0, 'ATTR' =>[
		'ATR_FIELD'=>'STORE_ID','ATR_LABEL'=>'NAMA TOKO','ATR_HEADER_MERGE'=>false,'ATR_GROUP'=>true,'ATR_GROUPROW'=>true,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'100px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'top','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'left','C_FONT_BOLD'=>'bold','C_FONT_COLOR' =>$C_FONT_COLOR2,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>[],
		// PENGUNAAN FILTER 
		// 'FILTER'=>true,'FILTER_TYPE'=>GridView::FILTER_SELECT2,
		// 'FILTER_WIDGET_OPTION'=>['pluginOptions'=>['allowClear'=>true]],
		// 'FILTER_INPUT_OPTION'=>['placeholder'=>'-Pilih-']	
		// 'FILTER_OPTION'=>[],
		]
	];	  
	//--KARYAWAN---
	$aryFieldColomn[]=[
	'ID' =>1, 'ATTR' =>[
		'ATR_FIELD'=>'KARYAWAN','ATR_LABEL'=>'KARYAWAN','ATR_HEADER_MERGE'=>false,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'80px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'top','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'left','C_FONT_BOLD'=>'bold','C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>true,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>['style'=>'background-color:rgba(255, 255, 255, 1); align:center','colspan'=>'0',],
		]
	];	
	//--TOTAL_JAM_TELAT---
	$aryFieldColomn[]=[
	'ID' =>2, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_JAM_TELAT','ATR_LABEL'=>'TELAT','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'center','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>['style'=>'background-color:rgba(255, 255, 255, 1); align:center','colspan'=>'0',],
		]
	];
	//--TOTAL_JAM_PULANGAWAL---	
	$aryFieldColomn[]=[
	'ID' =>3, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_JAM_PULANGAWAL','ATR_LABEL'=>'PULANG AWAL','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'center','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>[],
		]
	];
	//--TOTAL_PERSEN_TELAT---	
	$aryFieldColomn[]=[
	'ID' =>4, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_PERSEN_TELAT','ATR_LABEL'=>'TELAT','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		 'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>[],
		]
	];	
	//--TOTAL_PERSEN_PULANGAWAL---	
	$aryFieldColomn[]=[
	'ID' =>5, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_PERSEN_PULANGAWAL','ATR_LABEL'=>'PULANG AWAL','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>[],
		]
	];	
	//--TOTAL_RUPIAH_TELAT---		
	$aryFieldColomn[]=[
	'ID' =>6, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_RUPIAH_TELAT','ATR_LABEL'=>'TELAT','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>['decimal', 2],
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>true,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>[],	
		]
	];	
	//--TOTAL_RUPIAH_PULANGAWAL---	
	$aryFieldColomn[]=[
	'ID' =>7, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_RUPIAH_PULANGAWAL','ATR_LABEL'=>'PULANG AWAL','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>['decimal', 2],
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>true,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>[],
		]
	];		
	//--TOTAL_JAM_LEMBUR---	
	$aryFieldColomn[]=[
	'ID' =>8, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_JAM_LEMBUR','ATR_LABEL'=>'JAM','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'center','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>false,
		]
	];	
	//--TOTAL_PERSEN_LEMBUR---	
	$aryFieldColomn[]=[
	'ID' =>9, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_PERSEN_LEMBUR','ATR_LABEL'=>'PERSEN','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>'raw',
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>false,
		]
	];	
	//--TOTAL_RUPIAH_LEMBUR---		
	$aryFieldColomn[]=[
	'ID' =>10, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_RUPIAH_LEMBUR','ATR_LABEL'=>'RUPIAH','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>['decimal', 2],
		'H_WIDTH'=>'10px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>false,
		]
	];	
	//--UPAH_HARIAN---		
	$aryFieldColomn[]=[
	'ID' =>11, 'ATTR' =>[
		'ATR_FIELD'=>'UPAH_HARIAN','ATR_LABEL'=>'UPAH HARIAN','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>['decimal', 2],
		'H_WIDTH'=>'50px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>false,
		]
	];	
	//--TOTAL_POTONGAN---		
	$aryFieldColomn[]=[
	'ID' =>12, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_POTONGAN','ATR_LABEL'=>'TOTAL POTONGAN','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>['decimal', 2],
		'H_WIDTH'=>'100px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>false,
		]
	];	
	//--TOTAL_PEMASUKAN---		
	$aryFieldColomn[]=[
	'ID' =>13, 'ATTR' =>[
		'ATR_FIELD'=>'TOTAL_PEMASUKAN','ATR_LABEL'=>'TOTAL PEMASUKAN','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>['decimal', 2],
		'H_WIDTH'=>'100px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>false,
		]
	];
	//--GRAND_TOTAL---		
	$aryFieldColomn[]=[
	'ID' =>14, 'ATTR' =>[
		'ATR_FIELD'=>'GRAND_TOTAL','ATR_LABEL'=>'GAJI BERSIH','ATR_HEADER_MERGE'=>true,'ATR_GROUP'=>false,'ATR_GROUPROW'=>false,'ATR_PAGESUMMARY'=>false,'ATR_FORMAT'=>['decimal', 2],
		'H_WIDTH'=>'100px','H_ALIGN'=>'center','H_FONT_SIZE' =>'10px','H_FONT_COLOR'=>$H_FONT_COLOR1,'H_BG_COLOR' =>$H_BG_COLOR1,'H_VALIGN'=>'RIGHT','V_VALIGN'=>'middle','H_COLSPAN'=>'0',
		'C_FONT_SIZE' =>'10px','C_ALIGN'=>'right','C_FONT_BOLD'=>false,'C_FONT_COLOR' =>$C_FONT_COLOR1,'C_BG_COLOR' =>$C_BG_COLOR1,
		'FILTER'=>false,'FILTER_TYPE'=>false,'FILTER_WIDGET_OPTION'=>[],'FILTER_INPUT_OPTION'=>['class'=>'form-control'],'FILTER_OPTION'=>false,
		]
	];
	
	$valFields = ArrayHelper::map($aryFieldColomn, 'ID', 'ATTR');	
	return $valFields;
};

/**
* FILTER STATUS
*/
function filterStatus(){
	$aryStt= [
		  ['STATUS' => 0, 'STT_NM' => 'KELUAR'],		  
		  ['STATUS' => 1, 'STT_NM' => 'AKTIF']
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	return $valStt;
};

/**
* FILTER JENIS KELAMIN
*/
function filterShift(){
	$aryStt= [
		  ['SHIFT_ID' => 0, 'SHIFT_NM' => 'SHIFT 1'],		  
		  ['SHIFT_ID' => 1, 'SHIFT_NM' => 'SHIFT 2'],		  
		  ['SHIFT_ID' => 2, 'SHIFT_NM' => 'SHIFT 3'],
	];	
	$valStt = ArrayHelper::map($aryStt, 'SHIFT_NM', 'SHIFT_NM');
	return $valStt;
};

/* foreach($valFields as $key =>$value[]){			
		$attDinamikField[]=[
			'attribute'=>$value[$key]['ATR_FIELD'],
			'label'=>$value[$key]['ATR_LABEL'],
			'filter'=>$value[$key]['FILTER'],
			'filterType'=>$value[$key]['FILTER_TYPE'],
			'filterWidgetOptions'=>$value[$key]['FILTER_WIDGET_OPTION'],	
			'filterInputOptions'=>$value[$key]['FILTER_INPUT_OPTION'],			
			'hAlign'=>'right',
			'vAlign'=>'middle',
			//'hidden'=>false,
			'noWrap'=>true,	
			'value'=>function($data)use($value,$key){
				$val=$value[$key]['ATR_FIELD'];	
				$splt=explode('_',$val);
				if($splt[0]=='SISA'){					
					//return 'NAMA TOKO :  '.$data->$val;	 //USE ActiveData	
					// return 'NAMA TOKO';						 //KONSTANTA
					return 'NAMA TOKO :  '.$data[$val];		 //USE ArrayData
				}elseif($val=='SISA'){
					//return 'NAMA TOKO :  '.$data->$val;	 //USE ActiveData	
					// return 'NAMA TOKO';						 //KONSTANTA
					return 'NAMA TOKO :  '.$data[$val];		 //USE ArrayData
				}else{						
					if($data->{$val}){					
						//return $data->{$val};			//USE ActiveData					
						//return $data->NAMA_DPN;		//USE ActiveData					
						//return $data['NAMA_DPN'];		//USE ArrayData
						return  $data->{$val};			//USE ArrayData
					}else{
						return '';
					}						
				}		
			},					
			'headerOptions'=>[		
				'style'=>[		
					'width'=>$value[$key]['H_WIDTH'],
					'text-align'=>$value[$key]['H_ALIGN'],				
					'font-size'=>$value[$key]['H_FONT_SIZE'],				
					'color'=>$value[$key]['H_FONT_COLOR'],
					'background-color'=>$value[$key]['H_BG_COLOR'],
					'font-family'=>'tahoma, arial, sans-serif',	
					'font-weight'=>'bold',				
				]
			],
			'contentOptions'=>[
				'style'=>[
					'font-size'=>$value[$key]['C_FONT_SIZE'],
					'text-align'=>$value[$key]['C_ALIGN'],
					'color'=>$value[$key]['C_FONT_COLOR'],
					'background-color'=>$value[$key]['C_BG_COLOR'],
					'font-family'=>'tahoma, arial, sans-serif',						
					'font-weight'=>'bold',
				]
			],				
			'group'=>$value[$key]['ATR_GROUP'],
			'groupedRow'=>$value[$key]['ATR_GROUPROW'],	
		];
	}; */

?>
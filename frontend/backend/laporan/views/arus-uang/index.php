<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\backend\laporan\models\JurnalTemplateDetailSearch;
use kartik\date\DatePicker;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateTitleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
// $this->registerJs("
// // var x = document.getElementById('tahun').value;
// // console.log(x);
// document.getElementById('tahun').onchange = function() { 
//     var x = document.getElementById('tahun').value;
//     $.pjax.reload({
//         url:'/laporan/arus-uang/index?id='+x, 
//         container: '#arus-masuk-monthofyear',
//         timeout: 1000,
//     }).done(function () {
//         $.pjax.reload({container: '#arus-keluar-monthofyear'});
//     });
    
//     console.log('Changed!'+x); 
// }
// ",View::POS_READY);
$btn_srchChart1=DatePicker::widget([
    'name' => 'check_issue_date', 
    'options' => ['placeholder' => 'Pilih Tahun ...','id'=>'tahun'],
    'convertFormat' => true,
    'pluginOptions' => [
        'autoclose'=>true,
        'startView'=>'years',
        'minViewMode'=>'months',
        'format' => 'yyyy-n',
        // 'todayHighlight' => true,
         'todayHighlight' => true
    ]
]);
$btn_srchChart="<div style='padding-bottom:3px;float:right'> Periode Tahun".$btn_srchChart1."</div>";

?>
<div class="jurnal-template-title-index">
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">	
			<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;">	
                    <?php				
                    
                        $tanggal=explode('-',$cari);				
						echo '<b>RINGKASAN ARUS KEUANGAN <br>'.$tanggal[0].'</b>';				
					?>		
			</div>
			<div class="col-xs-4 col-sm-4 col-lg-4 pull-right">
				<?=$btn_srchChart?>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">	
        <?php 
        
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>false,
        'columns' => [
            ['class' => 'kartik\grid\ExpandRowColumn',
            'value'=>function($model,$key,$index,$column){
                return GridView::ROW_EXPANDED;
            },
            
            'detail'=> function($model,$key,$index,$column)use($tanggal)
            {     
               
                $searchModel =  new JurnalTemplateDetailSearch(['YEAR_AT'=>$tanggal[0],'MONTH_AT'=>$tanggal[1]]);
                $searchModel->RPT_TITLE_ID = $model->RPT_TITLE_ID;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return Yii::$app->controller->renderPartial('index_detail',[
                    'searchModel'=>$searchModel,
                    'dataProvider'=>$dataProvider
                ]);
            }
        ],
        
            [
                'attribute' => 'RPT_TITLE_NM',
                'label' => false,
            ],
        ],
    ]); ?>
		</div>
	</div>
</div>


<?php
use kartik\detail\DetailView;
if(!empty($modelRek->gambar)){
    $data=unserialize($modelRek->gambar);
    foreach ($data as $key) {
            $datas[]='<img src="'.$key.'" alt="Your Avatar" style="width:160px;align:center">';
        }
}else{
    $datas='';
}
?>
<div class="row">
    <div class="col-md-6 col-md-6">
    <?= 
    DetailView::widget([
        'model' => $modelcorp,
        'panel' => [
            'type' => DetailView::TYPE_INFO,
        ],            
        'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'',
		'buttons2'=>'{view}{save}',	
        'attributes' => [
            [
                'columns' => [
                    [
                        'attribute'=>'ACCESS_ID', 
                        'label'=>'ACCESS ID',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'CORP_NM', 
                        'label'=>'COMPANY',
                        'format'=>'raw', 
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'MAP_LAG', 
                        'label'=>'LONGITUDE',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'MAP_LAT', 
                        'label'=>'LATITUDE',
                        'format'=>'raw', 
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'ALAMAT', 
                        'label'=>'ALAMAT',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:90%']
                    ],
                ],
            ],
        ],
    ]);
    ?>
    </div>
    
    <div class="col-md-6 col-md-6">
    <div class="item-fdiscount-form">
    <?=
     DetailView::widget([
        'id'=>'dv-data-barang-view',
        'model' => $modelRek,
        'attributes' =>[
        [
            
            'columns' => [
            [
                'attribute'=>'NAMA_LENGKAP',
                'valueColOptions'=>['style'=>'width:40%'],
            ],
            [
                'attribute'=>'BANK',
                'valueColOptions'=>['style'=>'width:40%'],
                'value'=>$modelRek->BANK,
            ],
            ],
        ],
        [
            
            'columns' => [
            [
                'attribute'=>'NO_REK',
                'valueColOptions'=>['style'=>'width:40%'],
                'value'=>$modelRek->NO_REK,
            ],
            [
                'attribute'=>'TLP',
                'valueColOptions'=>['style'=>'width:40%'],
                'value'=>$modelRek->TLP,
            ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute'=>'ALAMAT', 
                    'label'=>'ALAMAT',
                    'displayOnly'=>true,
                    'valueColOptions'=>['style'=>'width:90%']
                ],
            ],
        ],
        ],
        'hover'=>true,
        'panel'=>[
			'type'=>DetailView::TYPE_INFO,
		],
        'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'',
		'buttons2'=>'{view}{save}',		
    ]) ;
    ?>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Dokumen</h3>
                </div>
                <div class="box-body">
                    <?php
                    foreach($datas as $data){
                        echo $data.'&nbsp&nbsp&nbsp';
                    }
                    ?>
                </div>
            </div>
    </div>
</div>

<?php
use kartik\detail\DetailView;
use kartik\editable\Editable;
if(!empty($modelRek->gambar)){
    $data=unserialize($modelRek->gambar);
    foreach ($data as $key) {
            $datas[]='<img src="'.$key.'" alt="Your Avatar" style="width:160px;align:center">';
        }
}else{
    $datas='';
}
if(!empty($modelcorpImg->BERKAS_IMG)){
    $corps=unserialize($modelcorpImg->BERKAS_IMG);
    foreach ($corps as $key) {
            $corpss[]='<img src="'.$key.'" alt="Your Avatar" style="width:160px;align:center">';
        }
}else{
    $corpss='';
}

switch ($modelRek->STATUS) {
    case '0':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa fa-refresh fa-spin fa-stack-1x" style="color:#ee0b0b"></i>
          </span> Proses';
        break;
    case '1':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa fa-check fa-stack-1x" style="color:#ffc107"></i>
          </span> Pendding';
        break;
    case '2':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa-check fa-stack-1x" style="color:#4caf50"></i>
          </span> Success';
        break;
    case '2':
            $stt ='<span class="fa-stack fa-xl">
            <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
            <i class="fa fa-close fa-stack-1x" style="color:#4caf50"></i>
          </span> Gagal';
        break;
    default:
            $stt ='-';
    break;
}
?>
<?php if($modelcorp['STATUS']!='2'){?>
        <div class="col-md-12">
        <?php if($modelcorp['STATUS']=='0'){?>
            <h3 class="text-center text-danger">MAAF ANDA PERUSAHAAN ANDA BELUM TERDAFTAR DIDATABASE KAMI</h3>
        <?php }elseif($modelcorp['STATUS']=='1') {?>
            <h3 class="text-center text-success">KAMI SEDANG VERIVIKASI</h3>
            <?php } ?>
            <?php if($modelcorp['STATUS']=='0'){?>
            <div class="text-right">
                <button type="button" data-toggle="tab" href="#menu1" class="btn btn-primary">Daftar</button>
            </div>
            <?php } ?>
        </div>
<?php }else{ ?>
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
        ],[
            'columns' => [
                [
                    'attribute'=>'STATUS',
                    'valueColOptions'=>['style'=>'width:90%'],
                    'value'=>$stt,
                    'format'=>'raw'
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
                    <h3 class="box-title">Dokumen Bank</h3>
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
    <div class="col-md-12">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Dokumen PERUSAHAAN</h3>
                </div>
                <div class="box-body">
                    <?php
                    foreach($corpss as $dok){
                        echo $dok.'&nbsp&nbsp&nbsp';
                    }
                    ?>
                </div>
            </div>
    </div>
</div>
                <?php } ?>
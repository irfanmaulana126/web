<?php
use kartik\helpers\Html;
use yii\helpers\Url;
?>
<!-- <div  id="dialog" class="alert alert-dismissible callout callout-warning">		  
    <h4><i class="icon fa fa-warning"></i> Alert!</h4>

    <p>Data yang diinputkan harus sesuai dengan pemilik perusahaan jika terdapat ketidak sesuaian pada data yang diinputkan kami tidak akan memverifikasi agar anda memiliki virtual akun anda.</p>
    <br>
    <p>apakah kamu suka pesan ini muncul kembali ?.</p>
        <div class="text-right">
        <button name="yes" class="yes btn btn-default">YA</button>
        <button name="no" class="no btn btn-default">TIDAK</button>
        </div>
</div> -->
<div class="container-fluid">
        <div class="col-md-6">
            <div class="col-md-12 w3-card-2 w3-round w3-white">
                <h3>Form Daftar Perusahaan</h3>
                <p>Form yang ditujukan untuk mendaftarkan nama perusahaan anda serta untuk data kami agar anda memiliki Virtual Account</p>
                <?=Html::button('Detail',['id'=>'edit','value'=>Url::toRoute(['/sistem/corp/update?id='.$modelcorp['ID'].'']),'data-pjax' => true,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
            </div>
        </div>      
        <div class="col-md-6">
            <div class="col-md-12 w3-card-2 w3-round w3-white">
                <h3>Form Daftar Bank</h3>
                <p>Form yang ditujukan untuk mengetahui bank apa yang digunakan untuk memlakukan transaksi.</p>
                <?=Html::button('Detail',['id'=>'userprofile-button-row-bank','value'=>url::to(['/sistem/user-profile/account-rek-update','ACCESS_GROUP'=>$modelRek['ACCESS_GROUP']]),'data-pjax' => true,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
            </div>
        </div>      
    </div>
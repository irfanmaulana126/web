
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use common\models\LocateProvince;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use frontend\backend\master\models\Industry;
use frontend\backend\master\models\IndustryGroup;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobHeader */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss("
#myMap {
    width:550px;
    height:300px;
    background:yellow
 }	
");

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyB_BOmcuyR1X9XuFy314bhI1KX9IKfoGQA&callback=initMap',
['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJS('
            var map;
            var marker;
            function initMap(){
                if('.$model['LATITUDE'].'==0 && '.$model['LONGITUDE'].'==0){
                    var myLatlng = new google.maps.LatLng(-6.22936,106.66);
                }else{
                    var myLatlng = new google.maps.LatLng('.$model['LATITUDE'].','.$model['LONGITUDE'].');
                }
                var geocoder = new google.maps.Geocoder();
                var infowindow = new google.maps.InfoWindow();
                var directionsService = new google.maps.DirectionsService();
                var directionsDisplay = new google.maps.DirectionsRenderer();
            var mapOptions = {
                zoom: 10,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true 
            }); 

            geocoder.geocode({"latLng": myLatlng }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                        $("#latitude,#longitude").show();
                        $("#address").val(results[0].formatted_address);
                        $("#latitude").val(marker.getPosition().lat());
                        $("#longitude").val(marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });

            google.maps.event.addListener(marker, "dragend", function() {

            geocoder.geocode({"latLng": marker.getPosition()}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $("#address").val(results[0].formatted_address);
                            $("#latitude").val(marker.getPosition().lat());
                            $("#longitude").val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });

            google.maps.event.addDomListener(window, "load", initMap);    
            }      
            
');
$this->registerJS('$("#store-button-restore-modal").on("shown", function () {
    google.maps.event.trigger(map, "resize");
});
');
?>
<div class="ppob-header-form">

<?php $form = ActiveForm::begin(); ?>
<div class="col-md-12">
        <?= $form->field($model, 'STORE_NM')->textInput() ?>
</div>

<div class="col-md-6">

<?= $form->field($model, 'INDUSTRY_GRP_ID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(IndustryGroup::find()->all(),'INDUSTRY_GRP_ID','INDUSTRY_GRP_NM'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...','id'=>'industri-grp-id'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('INDUSTRI GROUP'); ?>
            
</div>

<div class="col-md-6">

    <?= $form->field($model, 'INDUSTRY_ID')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'industri-id'],
        'pluginOptions'=>[
            'depends'=>['industri-grp-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/master/store/industry'])
        ],
    ])->label('INDUSTRI'); ?>
            
</div>
<div class="col-md-4">
    <?= $form->field($model, 'PIC')->textInput() ?>
</div>
<div class="col-md-4">
    <?= $form->field($model, 'TLP')->widget(MaskedInput::classname(),
    ['mask' => '(999) 9999999'])->label('Phone') ?>
</div>
<div class="col-md-4">
    <?= $form->field($model, 'FAX')->widget(MaskedInput::classname(),
    ['mask' => '(999) 9999999']) ?>    
</div>

<div class="col-md-12">
    <div id="myMap"></div>
</div>
<div class="col-md-6">

<?= $form->field($model, 'LATITUDE')->textInput(['id'=>'latitude']) ?>
            
</div>
<div class="col-md-6">

<?= $form->field($model, 'LONGITUDE')->textInput(['id'=>'longitude']) ?>
            
</div>
<div class="col-md-6">

<?= $form->field($model, 'PROVINCE_ID')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(LocateProvince::find()->all(),'PROVINCE_ID','PROVINCE'),
        'language' => 'de',
        'options' => ['placeholder' => 'Select a state ...','id'=>'province-id'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
            
</div>
<div class="col-md-6">

<?= $form->field($model, 'CITY_ID')->widget(DepDrop::classname(), [
    'type'=>DepDrop::TYPE_SELECT2,
        'options'=>['id'=>'subkota-id'],
        'pluginOptions'=>[
            'depends'=>['province-id'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['/master/store/kota'])
        ]
    ]); ?>
            
</div>
<div class="col-md-12">
    <?= $form->field($model, 'ALAMAT')->textInput(['id'=>'address']) ?>
</div>
<div class="col-md-12">
    <?= $form->field($model, 'DCRP_DETIL')->textInput() ?>
</div>



<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>

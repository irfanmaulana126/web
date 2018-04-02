
<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use common\models\LocateProvince;
use yii\helpers\ArrayHelper;
use frontend\backend\master\models\Industry;
use frontend\backend\master\models\IndustryGroup;
use yii\widgets\MaskedInput;

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
 html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  .controls {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 300px;
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  .pac-container {
    font-family: Roboto;
    z-index: 100000 !important;
  }

  #type-selector {
    color: #fff;
    background-color: #4d90fe;
    padding: 5px 11px 0px 11px;
  }

  #type-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }		
");

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyB_BOmcuyR1X9XuFy314bhI1KX9IKfoGQA&callback=initAutocomplete&libraries=places',
['depends' => [\yii\web\JqueryAsset::className()]]);
if(!empty($model['LATITUDE'])&&!empty($model['LONGITUDE'])){
    $data='new google.maps.LatLng('.$model['LATITUDE'].','.$model['LONGITUDE'].')';
}else{
    $data='new google.maps.LatLng(-6.22936,106.66)';
}
$this->registerJS('
            var map;
            var marker;
            function initAutocomplete(){
                
                var myLatlng = '.$data.'; 
                var geocoder = new google.maps.Geocoder();
                var infowindow = new google.maps.InfoWindow();
                var input = document.getElementById("pac-input");
                var searchBox = new google.maps.places.SearchBox(input);
                var directionsService = new google.maps.DirectionsService();
                var directionsDisplay = new google.maps.DirectionsRenderer();
            var mapOptions = {
                zoom: 10,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            map.addListener("bounds_changed", function() {
                      searchBox.setBounds(map.getBounds());
                    });
                
                    var markers = [];
                    // Listen for the event fired when the user selects a prediction and retrieve
                    // more details for that place.
                    searchBox.addListener("places_changed", function() {
                      var places = searchBox.getPlaces();
                
                      if (places.length == 0) {
                        return;
                      }
                
                      // Clear out the old markers.
                      markers.forEach(function(marker) {
                        marker.setMap(null);
                      });
                      markers = [];
                
                      // For each place, get the icon, name and location.
                      var bounds = new google.maps.LatLngBounds();
                      places.forEach(function(place) {
                        if (!place.geometry) {
                          console.log("Returned place contains no geometry");
                          return;
                        }
                               
                        if (place.geometry.viewport) {
                          // Only geocodes have viewport.
                          bounds.union(place.geometry.viewport);
                        } else {
                          bounds.extend(place.geometry.location);
                        }
                      });
                      map.fitBounds(bounds);
                    });

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
                            $("#latitude,#longitude").show();
                            $("#address").val(results[0].formatted_address);
                            $("#latitude").val(marker.getPosition().lat());
                            $("#longitude").val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });
            map.addListener("click", function(e) {
                setTimeout(function() { marker.setPosition(e.latLng); }, 10);

                    geocoder.geocode({"latLng": marker.getPosition()}, function(results, status) {
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
            });
            google.maps.event.addDomListener(window, "load", initAutocomplete);    
            }      
            $("#databarang-button-row-edit-modal").on("shown.bs.modal", function(){
                initializeMap();
                });     
');
?>
<div class="ppob-header-form">
   
   <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-md-12">
            <?= $form->field($model, 'STORE_NM',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>STORE</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 117px;']
                            ]
                            ]
                            ])->textInput(['style'=>'width: 452px;text-transform:uppercase'])->label(false) ?>
    </div>
    </div>

    <div class="row">
    <div class="col-md-6">
    
    <?= $form->field($model, 'INDUSTRY_GRP_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>INDUSTRI GRP</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(IndustryGroup::find()->all(),'INDUSTRY_GRP_ID','INDUSTRY_GRP_NM'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select a state ...','id'=>'industri-grp-id','style'=>'width: 172px;'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); ?>
                
    </div>
    
    <div class="col-md-6">
    
        <?= $form->field($model, 'INDUSTRY_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>INDUSTRI</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
            'options'=>['id'=>'industri-id'],
            'pluginOptions'=>[
                'depends'=>['industri-grp-id'],
                'placeholder'=>'Select...',
                'url'=>Url::to(['/master/store/industry'])
            ],
        ])->label(false); ?>
                
    </div>
    </div>
    <div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'PIC',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>PIC</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 20px;']
						]
					]
				])->textInput()->label(false) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'TLP',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span class="fa fa-phone"><b></b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 20px;']
						]
					]
				])->widget(MaskedInput::classname(),
        ['mask' => '(999) 9999999'])->label(false) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'FAX',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span class="fa fa-fax"><b></b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 20px;']
						]
					]
				])->widget(MaskedInput::classname(),
        ['mask' => '(999) 9999999'])->label(false) ?>    
    </div>
    </div>
    
    <div class="row">
    <div class="col-md-12">
    <input id="pac-input" class="controls" type="text" placeholder="Enter a location">
        <div id="myMap"></div>
    </div>
    </div>
    
    <div class="row">
    <div class="col-md-6" style="margin-top: 10px;">
    
    <?= $form->field($model, 'LATITUDE',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>LATITUDE</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 117px;']
						]
					]
				])->textInput(['readOnly'=>true,'id'=>'latitude'])->label(false) ?>
                
    </div>
    <div class="col-md-6" style="margin-top: 10px;">

    <?= $form->field($model, 'LONGITUDE',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>LONGITUDE</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->textInput(['readOnly'=>true,'id'=>'longitude'])->label(false) ?>
                
    </div>
    <div class="col-md-6">
    
    <?= $form->field($model, 'PROVINCE_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>PROVINSI</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 117px;']
						]
					]
				])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(LocateProvince::find()->all(),'PROVINCE_ID','PROVINCE'),
            'language' => 'de',
            'options' => ['placeholder' => 'Select a state ...','id'=>'province-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false); ?>
                
    </div>
    <div class="col-md-6">

    <?= $form->field($model, 'CITY_ID',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>KOTA</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 99px;']
						]
					]
				])->widget(DepDrop::classname(), [
        'type'=>DepDrop::TYPE_SELECT2,
            'options'=>['id'=>'subkota-id'],
            'pluginOptions'=>[
                'depends'=>['province-id'],
                'placeholder'=>'Select...',
                'url'=>Url::to(['/master/store/kota'])
            ]
        ])->label(false); ?>
                
    </div>
    </div>
    
    <div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'ALAMAT',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>ALAMAT</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 117px;']
						]
					]
				])->textInput(['id'=>'address','style'=>'width: 455px;'])->label(false) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'DCRP_DETIL',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>DESKRIPSI</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 117px;']
						]
					]
				])->textInput(['style'=>'width: 455px;'])->label(false) ?>
    </div>
    </div>



    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

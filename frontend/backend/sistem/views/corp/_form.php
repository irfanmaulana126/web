<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
$data=$image->CORP_64;
	if (!empty($data)) {
		$datas='<img src="'.$image->CORP_64.'" alt="Your Avatar" style="width:160px;align:center">';
	} else {
		$datas='<img src="https://www.mautic.org/media/images/default_avatar.png" alt="Your Avatar" style="width:160px;align:center">';
    }
    if(!empty($image->BERKAS_IMG)){
        $data=unserialize($image->BERKAS_IMG);
        foreach ($data as $key) {
                $berkas[]='<img src="'.$key.'" alt="Your Avatar" style="width:160px;align:center">';
            }
    }else{
        $berkas='';
    }
    $retVal = ($model['STATUS']!=0) ? 'false' : 'true' ;
/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobHeader */
/* @var $form yii\widgets\ActiveForm */
$warnaLabel='rgba(21, 175, 213, 0.14)';
$widthLabel='125px';

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
if(!empty($model['MAP_LAT'])&&!empty($model['MAP_LAG'])){
    $data='new google.maps.LatLng('.$model['MAP_LAT'].','.$model['MAP_LAG'].')';
}else{
    $data='new google.maps.LatLng(-6.22936,106.66)';
}
// print_r($data);die();
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
                draggable: '.$retVal.',
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
            if('.$retVal.'==true){
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
        }
            google.maps.event.addDomListener(window, "load", initAutocomplete);    
            }      
            $("#edit-modal").on("shown.bs.modal", function(){
                initializeMap();
                });     
            
');
?>

<div class="corp-form">

            <div class="callout callout-danger">
       <h4>PENTING BERKAS YANG HARUS DISIAPKAN!</h4>
       <div class="row">
       <div class="col-md-6">
                <ul>
                    <li>SIUP</li>
                    <li>KTP</li>
                    <li>NPWP</li>
                </ul> 
       </div>
       <div class="col-md-6">
            <ul>
                <li>AKTE NOTARIS</li>
                <li>SPT PAJAK</li>
                <li>TDP</li>
            </ul> 
       </div>
       </div>
        </div>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    
    <?php if ($model['STATUS']==2){ echo $form->field($model, 'CORP_NM',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>PERUSAHAAN</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
				])->textInput(['readOnly'=>true,'style'=>'width: 422px;'])->label(false);}else{
                    echo $form->field($model, 'CORP_NM',[					
                        'addon' => [
                            'prepend' => [
                                'content'=>'<span ><b>PERUSAHAAN</b></span>',
                                'options'=>['style' =>'
                                                background-color:'.$warnaLabel.';
                                                width:'.$widthLabel.';
                                                text-align:right;
                                                border-top-left-radius:5px;
                                                border-bottom-left-radius:5px;
                                            ']
                            ]
                        ]
                    ])->textInput(['style'=>'width: 422px;'])->label(false); 
                } ?>
<div class="row">
<div class="col-md-12">
    <input id="pac-input" class="controls" type="text" placeholder="Enter a location">
        <div id="myMap"></div>
    </div>
    <div class="col-md-6" style="margin-top: 10px;">
    
    <?= $form->field($model, 'MAP_LAT',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>LATITUDE</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 117px;']
						]
					]
				])->textInput(['readOnly'=>true,'id'=>'latitude'])->label(false) ?>
                
    </div>
    <div class="col-md-6" style="margin-top: 10px;">

    <?= $form->field($model, 'MAP_LAG',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>LONGITUDE</b></span>',
							'options'=>['style' =>' border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 80px;']
						]
					]
				])->textInput(['readOnly'=>true,'id'=>'longitude'])->label(false) ?>
                
    </div>
    </div>
    <?php if($model['STATUS']==2){ echo $form->field($model, 'ALAMAT',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span ><b>ALAMAT</b></span>',
							'options'=>['style' =>'
											background-color:'.$warnaLabel.';
											width:'.$widthLabel.';
											text-align:right;
											border-top-left-radius:5px;
											border-bottom-left-radius:5px;
										']
						]
					]
                ])->textInput(['readOnly'=>true,'id'=>'address','style'=>'width: 425px;'])->label(false);
                        }else{
                    echo $form->field($model, 'ALAMAT',[					
                        'addon' => [
                            'prepend' => [
                                'content'=>'<span ><b>ALAMAT</b></span>',
                                'options'=>['style' =>'
                                                background-color:'.$warnaLabel.';
                                                width:'.$widthLabel.';
                                                text-align:right;
                                                border-top-left-radius:5px;
                                                border-bottom-left-radius:5px;
                                            ']
                            ]
                        ]
                    ])->textInput(['id'=>'address','style'=>'width: 425px;'])->label(false); 
                } ?>
    
    <?=  $form->field($image, 'CORP_64')->widget(FileInput::classname(), [
				'name'=>'item-input-file',
				'options'=>[
					'width'=>'100px',
					'accept'=>'image/*',
					'multiple'=>false
				],				
				'pluginOptions'=>[
					'allowedFileExtensions'=>['jpg','gif','png'],					
					'showCaption' => false,
					'showRemove' => true,
					'showUpload' => false,
					'showClose' =>false,
					'showDrag' =>false,
					'browseLabel' => 'Select Photo',
					'removeLabel' => '',
					'removeIcon'=> '<i class="glyphicon glyphicon-remove"></i>',
					'removeTitle'=> 'Clear Selected File',
					'defaultPreviewContent' => $datas,
					'maxFileSize'=>30 //10KB
					
				],
				'pluginEvents' => [
					'fileclear' => 'function() { log("fileclear"); }',
					'filereset' => 'function() { log("filereset"); }',
				]
			])->label('LOGO') ; 
			?>
        <?= $form->field($image, 'BERKAS_IMG[]')->widget(FileInput::classname(), [
        'options'=>[
                'width'=>'100px',
                'accept'=>'image/*',
                'multiple'=>true
            ],				
        'pluginOptions'=>[
            'allowedFileExtensions'=>['jpg','gif','png'],					
            'showCaption' => false,
            'showRemove' => true,
            'showUpload' => false,
            'showClose' =>false,
            'showDrag' =>false,
            'browseLabel' => 'Select Photo',
            'removeLabel' => '',
            'removeIcon'=> '<i class="glyphicon glyphicon-remove"></i>',
            'removeTitle'=> 'Clear Selected File',
            'defaultPreviewContent' => $berkas,
            'maxFileSize'=>500, //10KB
            'maxFile'=>6 //10KB
            
        ],
        'pluginEvents' => [
            'fileclear' => 'function() { log("fileclear"); }',
            'filereset' => 'function() { log("filereset"); }',
        ]        
    ]); ?>
    <?php if($model['STATUS']=='0'){ ?>
    <div class="form-group text-right">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>

</div>

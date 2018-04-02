
<?php
use yii\helpers\Url;
use kartik\helpers\Html;
use yii\bootstrap\Modal;       

use frontend\assets\MapAsset;
MapAsset::register($this);
// $this->registerJsFile(
	// 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB_BOmcuyR1X9XuFy314bhI1KX9IKfoGQA&callback=initAutocomplete&libraries=places',
	// ['depends' => [\yii\web\JqueryAsset::className()]]
// );

 /*js mapping */
$this->registerJs("
    var map = new google.maps.Map(document.getElementById('map'),{
		zoom: 9,
		center: new google.maps.LatLng(-6.229191531958687,106.65994325550469),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var public_markers = [];
	var infowindow = new google.maps.InfoWindow();

	$.getJSON('https://production.kontrolgampang.com/laporan/store-maps/posisi-koordinat', function(json) {
		//public_markers =  JSON.parse(json);
		// for (var i in public_markers.)
		// {
		// public_markers[i].setMap(null);
		// }
		var dataImgDefault=json.icon[0]['MAP_ICON'];
		var dataImgActive=json.icon[1]['MAP_ICON'];

		$.each(json.CustMap, function (i, point) {
			//alert(point.MAP_LAT);
			//point1=JSON.parse(point);
			//console.log(json.icon);
			//dataImgjson.icon	   
			//set the icon
			//if(point.CUST_NM == 'asep')
			//{
			//	icon = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
			//}

			var marker = new google.maps.Marker({
				// icon: icon,
				position: new google.maps.LatLng(point.MAP_LAT, point.MAP_LNG),
				animation:google.maps.Animation.BOUNCE,
				map: map,
				icon : {
					url:point.STT_ONLINE==0?dataImgDefault:dataImgActive
				}
			});

			public_markers[i] = marker;

			google.maps.event.addListener(public_markers[i], 'click', function () {
			  //infowindow.setContent('<h1>' + point.CUST_NM + '</h1>' + '<p>' + point.ALAMAT + '</p>');
			  infowindow.setContent('<h1>' + point.STORE_ID + '</h1>' + '<p>' + point.STORE_ID + '</p>');
			  infowindow.open(map, public_markers[i]);
			});
		});
    });
");

    ?>

<div class="content">
  <div  class="row" style="padding-left:3px">
		<div class="col-sm-12">
			<?php
				 echo $map = '<div id ="map" style="width:100%;height:500px; padding-bottom:50px"></div>';
			?>
		</div>
	</div>
</div>


<?php
/* 
Modal::begin([
  'headerOptions'=>[
        'style'=> 'border-radius:5px; background-color: rgba(74, 206, 231, 1)',
    ],
    'header' => '<div style="float:left;margin-right:10px" class="fa fa-user fa-2x"></div><div><h5 class="modal-title"><b>Update GPS CUSTOMERS</b></h5></div>',
    'size' => Modal::SIZE_LARGE,
  'id' => 'modal',
  //keeps from closing modal with esc key or by clicking out of the modal.
  // user must click cancel or X to close
  // 'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'></div>";
Modal::end();
 */ 
	
	
	
	
	
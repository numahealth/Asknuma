@extends('admin.layouts.front')

@section('content')


<style>
 .leaflet-control-zoom.leaflet-bar{  display:none;  }
  .mapbox-icon.mapbox-icon-geocoder, .mapbox-icon.mapbox-icon-geocoder:before{  display:none;  }
  .leaflet-control-mapbox-geocoder .leaflet-control-mapbox-geocoder-wrap, .leaflet-control-mapbox-geocoder .leaflet-control-mapbox-geocoder-form input{width:300px !important; left:0;}
  .leaflet-control-mapbox-geocoder-results{width:300px !important;}
  .leaflet-control-mapbox-geocoder-results{ left:0;}
</style>
<div class="container">
Search below for heathcare facilities around you. We are constantly brining on new partners & facilities. Verified facilities are checked by our team, & we have established authenticity & user-friendliness of the facilities in question.

</div>

<div class="container-fluid map_element" style="margin-top:25px;">

	<div class="col-md-3 col-sm-9 col-xs-11"> 
	<?php $location = DB::table('facility')
					->where('status', '=','Active')
					->get();
		if(!empty($location))
		{ $repeat=1;
			$timestamp = time();
			foreach($location as $keys=>$database_record)
			{
				$storeSchedule=json_decode($database_record->timing);
				$storeSchedule=(array)$storeSchedule;
				$v='';
				if($database_record->verified=='1')
				{
					$v='<span class="pull-left" style="margin-top: 3px;"><img style="width: 25px;display:inline" src="'.URL::asset('public/front').'/img/shield-3.png" ></span>';	
				}
				?>
				<div class="database_record" id="database_record_<?php echo $database_record->id;  ?>" <?php if($repeat!=1) { ?>style="display:none" <?php } ?>>
				
				<h4 class="map_title"><span class="pull-left" style="padding-right: 5px;"><?php echo $database_record->name ?></span> <?php echo $v; ?> </h4>
				<div class="clearfix"></div>
				<div class="map_contact">  <i class="fa fa-mobile"> </i><span> Contact :</span><div class="clearfix"></div> <?php echo $database_record->contact ?></div>
				<div class="map_address map_contact"><i class="fa  fa-home"> </i><span> Address :</span> <div class="clearfix"></div><?php echo $database_record->address ?></div>
				<div class="map_alltime map_contact"><i class="fa  fa-calendar">  </i><span> All Time Service :</span> <div class="clearfix"></div> <?php echo $database_record->all_time_service ?> </div>
				<?php if($database_record->all_time_service=='No') { ?><div class="map_open"> <i class="fa  fa-clock-o"> Open & Close Time: </i>
				<?php
				
				if(!empty($storeSchedule[date('D', $timestamp)])) {
				foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

					// create time objects from start/end times
					echo 'Open :';
					echo $sunrise = date('h:i a', strtotime($startTime)).'-';
					echo $sunset = date('h:i a', strtotime($endTime));

					// check if current time is within a range
					
				} }else { echo "Today Closed" ;}?>
				</div> <?php } ?>
				
				</div>
			<?php $repeat++;}
		}
	?>
	</div>
	<?php 	                                                        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    										$ip = $_SERVER['HTTP_CLIENT_IP'];
										} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    										$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
										} else {
  											$ip = $_SERVER['REMOTE_ADDR'];
                                                                            }
									$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
									 $location_lat_lon=  $details->loc; 
									// $location_lat_lon= '6.5244, 3.3792';
									//die;
									?>
		<div class="col-md-9 col-sm-12 col-xs-12 map_m"> 
		
			<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
			<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
			<script src='https://code.jquery.com/jquery-1.11.0.min.js'></script>
			 <nav class='menu-ui'>
			 <a href='#' class='active' data-filter='all'>Show all</a>
			 <a href='#'  data-filter='all_Yes'>24-hours service</a>
			 <a href='#'  data-filter='open_Yes'>Open Now</a>
			 <a href='#'  data-filter='varified'>Verified</a>
			 <?php 
			 $category = DB::table('category')
					->where('status', '=','Active')
					->get();
					$timestamp = time();
					if(!empty($category))
					{
						foreach($category as $keysa=>$cats)
						{
							$subcatetory = DB::table('subcatetory')
							->where('status', '=','Active')
							->where('category_id', '=',$cats->id)
							->get();
							if(!empty($subcatetory))
							{
								foreach($subcatetory as $subcats)
								{
									echo '<a href="#" data-filter="sub_'.$subcats->id.'">'.$subcats->sub_category_name.'</a>';
								} 
							}
							else
							{
								echo '<a href="#" data-filter="cat_'.$cats->id.'">'.$cats->category_name.'</a>';
							}
								
						
			
						} 
					}
						?>
			
			</nav>
			<div id='map'></div>
			<?php $location = DB::table('facility')
					->where('status', '=','Active')
					->get();
				
				
			$json_array=array();
			$level1=array();
			foreach($location as $keys=>$loc)
			{
				$storeSchedule=json_decode($loc->timing);
				$timestamp = time();
				$status = 'closed';
				$storeSchedule=(array)$storeSchedule;
				
				$currentTime = (new DateTime())->setTimestamp($timestamp);
				//echo date('D', $timestamp); die;
				foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

					// create time objects from start/end times
					$sunrise = date('h:i a', strtotime($startTime));
					$sunset = date('h:i a', strtotime($endTime));
					$startTime = DateTime::createFromFormat('h:i A', $sunrise);
					$endTime   = DateTime::createFromFormat('h:i A', $sunset);

					// check if current time is within a range
					if (($startTime < $currentTime) && ($currentTime < $endTime)) {
						$status = 'open';
						break;
					}
				}

				 "We are currently: $status";
				/* $current_time = date('h:i a');
				$sunrise = date('h:i a', strtotime($loc->open));
				$sunset = date('h:i a', strtotime($loc->close));
				$date1 = DateTime::createFromFormat('H:i a', $current_time);
				
				$date2 = DateTime::createFromFormat('H:i a', $sunrise);
				$date3 = DateTime::createFromFormat('H:i a', $sunset);*/
				if ($status == 'open')
				{
				   $oy='open_Yes';
				   
				}
				else{
					$oy='open_no';
				}
				if($loc->all_time_service=='Yes')
				{
					$oy='open_Yes';	
				}
				if($loc->verified=='1')
				{
					$v='varified';	
				}else
				{
				$v='noyvarified';		
				}
				$level1['type']='Feature';
				$level1['geometry']=array('coordinates'=>array($loc->longitude,$loc->latitude),'type'=>'Point');
				$level1['properties']=array('id'=>$loc->id,$oy=>true,$v=>true,'all_'.$loc->all_time_service=>true,'cat_'.$loc->category_id=>true,'sub_'.$loc->subcatetory_id=>true,'title'=>$loc->name,'description'=>$loc->address,'marker-color'=>'#75d575','marker-size'=>'medium');
				$json_array[]=$level1;
			}
			//print_r($location);die;
			 /*$json_array=array(array('type'=>'Feature','geometry'=>array('coordinates'=>array('77.3856','28.6121'),'type'=>'Point'),
			'properties'=>array("rentals"=> true,"tackleshop"=> false,"fuel"=> false,'title'=>'Marina #1','marker-color'=>'#1087bf','marker-size'=>'large','marker-symbol'=>'harbor')),
			array('type'=>'Feature','geometry'=>array('coordinates'=>array('77.1025','28.7041'),'type'=>'Point'),
			'properties'=>array('title'=>'php',"rentals"=> false,"tackleshop"=> true,"fuel"=> false,
			'marker-color'=>'#1087bf',	'marker-size'=>'large','marker-symbol'=>'harbor')),
			array('type'=>'Feature','geometry'=>array('coordinates'=>array('77.2606','29.0999'),
			'type'=>'Point'),'properties'=>array('title'=>'php',"rentals"=> false,"tackleshop"=> false,"fuel"=> true,
			'marker-color'=>'#1087bf',	'marker-size'=>'large','marker-symbol'=>'harbor')));*/?>
			<script>
			L.mapbox.accessToken = 'pk.eyJ1IjoiYW5zaHVsdW55c2NhcGUiLCJhIjoiY2lzaWV3aDNuMDAzcTJvb2N2OXcxOTk0YyJ9.oR8QRY4w6VcRwNHyLXFnsA';
			geojson = <?php echo  json_encode($json_array); ?>;
			var map = L.mapbox.map('map', 'mapbox.streets')
				.setView([<?php echo $location_lat_lon; ?>], 11).addControl(L.mapbox.geocoderControl('mapbox.places', {
        autocomplete: true,
        keepOpen:true,
    }));

			var markers = L.mapbox.featureLayer()
				.setGeoJSON(geojson)
				.addTo(map).on('click', onClick);;

			$('.menu-ui a').on('click', function() {
				// For each filter link, get the 'data-filter' attribute value.
				var filter = $(this).data('filter');
				$(this).addClass('active').siblings().removeClass('active');
				markers.setFilter(function(f) {
					// If the data-filter attribute is set to "all", return
					// all (true). Otherwise, filter on markers that have
					// a value set to true based on the filter name.
					return (filter === 'all') ? true : f.properties[filter] === true;
				});
				return false;
			});
			function onClick(e) {
				$('.database_record').hide();
				$('#database_record_'+e.layer.feature.properties.id).show();
			}
			</script>

			</div>
			
	
</div>	

@endsection

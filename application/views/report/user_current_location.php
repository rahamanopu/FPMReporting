<style>
    ::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
</style>
<script defer
  src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google_paid_app_key');?>">
</script>
<script defer
  src="http://maps.mis.digital/leaflet/leaflet-routing-machine.js">
</script>

      

<?php
$segment3 = $this->uri->segment(2);
?>

<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title"><?php echo $pageTitel; ?></h3>                
    </div> 


    <div id="content" class="dashboard padding-20">
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">
                    <p><span>Within 10 Min</span> <span class="fa fa-square"  style="color: yellow !important;"></span> || <span>Greater than 10 Min</span> <span class="fa fa-square" style="color: red !important;"></span></p>                             
                    <p id="mapLoadingText"></p>
                    <div class="col-md-2">
                    <p id="within_10_min" style="max-height:300px; overflow:scroll"></p>
                        <p id="greater_than_10_min"  style="max-height:300px; overflow:scroll"></p>
                    </div>
                    <div class="col-md-10"><div id="map" style="width: 100%; height: 1000px;"></div></div>
                    
                </div>
            </div>
        </div>
    </div>

</section>

<script type="text/javascript">
	var polyLines = [];
    var map;   
    $(document).ready(function() {
        var markersOnMap = '';
        var centerCords = '';		
          
        $("#map").html("");
        $.ajax({
            url: base_url + "report/getuserCurrentLocation",
            type: "get",
            data: {                    
            },
            beforeSend: function(){
                $("#mapLoadingText").text('Loading Map ...');                    
            },               
            success: function (response) {
                markersOnMap = JSON.parse(response);    
                console.log(markersOnMap);           
                if(markersOnMap.length != 0){
                    var centerPoint = parseInt(markersOnMap.length/2);
                    centerCords = markersOnMap[centerPoint].LatLng[0];                
                    initMap();
                    $("#mapLoadingText").hide();
                } else {
                    $("#mapLoadingText").text('No Location Found to show in Map').addClass('text-danger');
                }
                
            },            
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            } 
        });
        
        
    

         
        var InforObj = [];    

        function addMarkerInfo() {  
            var currentD = new Date();
            let image= '';             
            for (var i = 0; i < markersOnMap.length; i++) {
                if(markersOnMap[i].type == 'distributor') {
                    var contentString = '<div id="content">Name: <span style="font-weight:700">' + markersOnMap[i].name +'</span><br> Code: <span style="font-weight:700">'+markersOnMap[i].code+'</span><br> Location: <span style="font-weight:700">'+markersOnMap[i].location+'</span> </div>';
                    image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/library_maps.png';
                } else if(markersOnMap[i].type == 'retailer') {
                    var contentString = '<div id="content">Name: <span style="font-weight:700">' + markersOnMap[i].name +'</span><br> Code: <span style="font-weight:700">'+markersOnMap[i].code+'</span><br> Contact: <span style="font-weight:700">'+markersOnMap[i].retailerContactNumber+'</span> </div>';                    
                    image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                }else {
                    var contentString = '<div id="content"><span> Name: ' + markersOnMap[i].name +'</span><br><span>Time: '+ markersOnMap[i].time +'</span></div>';
                    if(markersOnMap[i].greaterthanTenMin=='yes') {
                        image = pinSymbol('red');
                        $("#greater_than_10_min").append('<span class="small" onclick="zoomToMarker('+markersOnMap[i].LatLng[0].lat+','+markersOnMap[i].LatLng[0].lng+')">'+markersOnMap[i].name+'</span> <span class="fa fa-square"  style="color: red !important;"></span><br>');
                    } else {
                        image = pinSymbol('yellow');
                        $("#within_10_min").append('<span class="small" onclick="zoomToMarker('+markersOnMap[i].LatLng[0].lat+','+markersOnMap[i].LatLng[0].lng+')">'+markersOnMap[i].name+'</span> <span class="fa fa-square"  style="color: yellow !important;"></span><br>');
                    }
                }
                

                const marker = new google.maps.Marker({
                    position: markersOnMap[i].LatLng[0],
                    map: map,
                    icon: image
                });

                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 200
                });

                marker.addListener('click', function () {
                    closeOtherInfo();
                    infowindow.open(marker.get('map'), marker);
                    InforObj[0] = infowindow;
                });
            }
        }

        function closeOtherInfo() {
            if (InforObj.length > 0) {
                /* detach the info-window from the marker ... undocumented in the API docs */
                InforObj[0].set("marker", null);
                /* and close it */
                InforObj[0].close();
                /* blank the array */
                InforObj.length = 0;
            }
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: centerCords
            });
            addMarkerInfo();
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
        setMapOnAll(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
        setMapOnAll(map);
        } 

        function pinSymbol(color) {
            return {
                path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
                fillColor: color,
                fillOpacity: 1,
                strokeColor: '#000',
                strokeWeight: 2,
                scale: 1
            };
        }  
			
			
    });
	
	// function zoomTomarker(Latitude,Longitude,Level1){
	// 	currentUser = Level1;
	// 	//map.setView([Latitude,Longitude], 17);
	// 	map.fitBounds(polyLines[Level1].getBounds());  
	// }

    function zoomToMarker(lat,lng) {
        var position = new google.maps.LatLng(lat, lng);
        map.setCenter(position);
        map.setZoom(15);
    }
	
    // refresh the page every 5 min
    setTimeout("location.reload(true);",(2*60*5000));
            
</script>

<script defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA314FGZVFCCGwhCRx90rlB0WZHsH-kJDY">
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
                    <p id="mapLoadingText"></p>
                    <div id="map" style="width: 100%; height: 1000px;"></div>
                </div>
            </div>
        </div>
    </div>

</section>

<script type="text/javascript">
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
        
        
    

        var map;    
        var InforObj = [];        

        function addMarkerInfo() {  
            let image= '';             
            for (var i = 0; i < markersOnMap.length; i++) {
                if(markersOnMap[i].type == 'distributor') {
                    var contentString = '<div id="content">Name: <span style="font-weight:700">' + markersOnMap[i].name +'</span><br> Code: <span style="font-weight:700">'+markersOnMap[i].code+'</span><br> Location: <span style="font-weight:700">'+markersOnMap[i].location+'</span> </div>';
                    image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/library_maps.png';
                } else if(markersOnMap[i].type == 'retailer') {
                    var contentString = '<div id="content">Name: <span style="font-weight:700">' + markersOnMap[i].name +'</span><br> Code: <span style="font-weight:700">'+markersOnMap[i].code+'</span><br> Contact: <span style="font-weight:700">'+markersOnMap[i].RetailerContactNumber+'</span> </div>';                    
                    image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                }else {
                    var contentString = '<div id="content"><span> Name: ' + markersOnMap[i].name +'</span><br><span>Time: '+ markersOnMap[i].time +'</span></div>';
                    image = '';
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
    });
            
</script>

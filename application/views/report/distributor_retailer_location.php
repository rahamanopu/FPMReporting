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
        <!-- BOXES -->
        
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                 	
                <div class="panel-body">
                    <fieldset>                
                        <div class="col-md-12">                       

                            <div class="col-md-1">
                                Region
                            </div>
                            <div class="col-md-2">
                                <select name="regioncode" id="regioncode" class="form-control" onchange="doChangeArea(this.value)">
                                    <option></option>
                                    <?php 
                                    if(!empty($regions)){ 
                                        foreach ($regions AS $row){
                                    ?>
                                        <option 
                                            <?php if(!empty($_POST['regioncode']) AND $row['Level3'] == $_POST['regioncode']){ ?> selected="selected" <?php } ?>
                                            value="<?php echo $row['Level3']; ?>"><?php echo $row['Level3'].' - '.$row['Level3Name']; ?></option>
                                    <?php 
                                        }
                                    } 
                                    ?>                                    
                                </select> 
                            </div>

                            <div class="col-md-1">
                                Area
                            </div>
                            <div class="col-md-2">
                                <select name="areacode" id="areacode" class="form-control" onchange="doChangeTerritory(this.value)">
                                    <?php if(!empty($areainfo) && COUNT($areainfo) > 1){ ?> <option></option> <?php } ?>
                                    <?php                                      
                                    if(!empty($areainfo)){ 
                                        foreach ($areainfo AS $row){
                                    ?>
                                        <option 
                                            <?php if(!empty($_POST['areacode']) AND $row['Level2'] == $_POST['areacode']){ ?> selected="selected" <?php } ?>
                                            value="<?php echo $row['Level2']; ?>"><?php echo $row['Level2'].' - '.$row['Level2Name']; ?></option>
                                    <?php 
                                        }
                                    }  
                                    ?>                                    
                                </select> 
                            </div>
                        
                            <div class="col-md-1">
                                TSI
                            </div>
                            <div class="col-md-2">
                                <select name="fmecode" id="fmecode" class="form-control" required="required">
                                    <?php if(!empty($fmelist) && COUNT($fmelist) > 1){ ?> <option></option> <?php } ?>
                                    <?php                                      
                                    if(!empty($fmelist)){ 
                                        foreach ($fmelist AS $row){
                                    ?>
                                        <option 
                                            <?php if(!empty($_POST['fmecode']) AND $row['Level1'] == $_POST['fmecode']){ ?> selected="selected" <?php } ?>
                                            value="<?php echo $row['Level1']; ?>"><?php echo $row['Level1'].' - '.$row['Level1Name']; ?></option>
                                    <?php 
                                        }
                                    }  
                                    ?>                                    
                                </select> 
                            </div>
                            
                            <div class="col-md-1">
                                Category
                            </div>
                            <div class="col-md-2">
                                <select id="category" name="category">
                                    <option value="all">All</option>
                                    <option value="distributor">Distributor</option>
                                    <option value="retailer">Retailer</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <input type="submit" value="Submit"
                                        name="showGoogleMapLocation" id="showGoogleMapLocation" class="btn btn-primary">
                            </div> 
                        </div>
                       
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- /BOXES --> 
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">               
                    <p id="mapLoadingText"></p>
                    <div id="map" style="width: 100%; height: 800px;"></div>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var markersOnMap = '';
        var centerCords = '';
        $("#showGoogleMapLocation").on('click',function() {
            var category = $("#category").val();       
            var level3= $("#regioncode").val();
            var level2= $("#areacode").val();
            var level1= $("#fmecode").val();
            // var level= 'D1';
            $("#map").html("");
            $.ajax({
                url: base_url + "report/getDistributorAndRetailerLocation",
                type: "post",
                data: {
                    'level3': level3,
                    'level2': level2,
                    'level1': level1,
                    'category': category
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
                for (var i = 0; i < markersOnMap.length; i++) {
                    var contentString = '<div id="content"><p>' + markersOnMap[i].name +'</p></div>';
                    let image= '';
                    if(markersOnMap[i].type == 'distributor') {
                        image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'; 
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
                    zoom: 30,
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
    });
            
</script>

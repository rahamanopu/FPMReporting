<script type="text/javascript">

    var period = '<?php if(!empty($periodformat)){ echo $periodformat; } ?>';
    var levelcode = '<?php if(!empty($fmecode)){ echo $fmecode; } ?>';
    var totalday = '<?php if(!empty($periodformat) && $periodformat == date('Ym')){ echo date('d'); }else{ echo '31'; } ?>';

    function showhidediva(divid,idimage){
        var x = document.getElementById(divid);
        if (x.style.display === 'none') {
            console.log(x.style.display);
            x.style.display = "";
            console.log(x.style.display);
            document.getElementById(idimage).src = '<?php echo base_url(); ?>assets/icon/details_close.png';
        } else {
            x.style.display = 'none';
            document.getElementById(idimage).src = '<?php echo base_url(); ?>assets/icon/details_open.png';    
        }
    }
</script>

<script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script>
<script defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google_paid_app_key');?>">
</script>


<?php
$segment3 = $this->uri->segment(2);
if (!empty($periodformat)) {
    $year = substr($periodformat, 0, 4);
    $month = substr($periodformat, 4, 2);
    $number = cal_days_in_month(CAL_GREGORIAN, substr($periodformat, 4, 2), substr($periodformat, 0, 4));
}
?>

<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title"><?php echo $pageTitel; ?></h3>                
    </div> 


    <div id="content" class="dashboard">
        <!-- BOXES -->

        <div class="row">
            <div id="" class="panel panel-default padding-20">

                <div class="panel-body">
                    <fieldset>
                    <form action="<?php echo base_url().$action; ?>" method="post" >
                        <div class="col-md-3 mt-4">
                            <label for="business">Business:</label>
                            <select name="business" id="business" class="form-control select2">
                                <option value="">-- Select --</option>
                                <?php foreach($userBusinesses as $userBusiness) {
                                    ?>
                                    <option value="<?php echo $userBusiness['Business']?>" 
                                    <?php echo (isset($business) && $business==$userBusiness['Business']) ? 'selected':''  ?>><?php echo $userBusiness['BusinessName']?></option>
                                    <?php
                                }?>
                                
                            </select>
                        </div>
                
                        <?php if(isset($showDateFromField)){?>
                            <div class="col-md-3 mt-4">
                                <label for="startDate">Date From:</label>
                                <input type="text" name="startDate" autocomplete="off"
                                    id="" class="form-control datePicker" 
                                    required="required"
                                    value="<?php if (!empty($startDate)) {
                                        echo $startDate;
                                    } ?>">
                            </div>
                        <?php }?>

                        <?php if(isset($showDateToField)){?>
                            <div class="col-md-3 mt-4">
                                <label for="endDate">Date To:</label>
                                <input type="text" name="endDate" autocomplete="off"
                                    id="" class="form-control datePicker" 
                                    required="required"
                                    value="<?php if (!empty($endDate)) {
                                        echo $endDate;
                                    } ?>">
                            </div>
                        <?php }?>

                        <div class="col-md-3 mt-4">
                            <label for="userLevel">Level:</label>
                            <select name="userLevel" id="userLevel" class="form-control select2">
                                <option value="">-- Select --</option>
                                <?php foreach($userLevels as $userLevel) {
                                    ?>
                                    <option value="<?php echo $userLevel?>" 
                                    <?php echo (isset($selectedUserLevel) && $selectedUserLevel==$userLevel) ? 'selected':''  ?>><?php echo $userLevel?></option>
                                    <?php
                                }?>
                            </select>
                        </div>
                    <div class="col-md-2 mt-4">
                        <input type="submit" value="Submit"
                            name="submit" class="btn btn-primary">
                    </div> 
                </div>
                </form>
                </fieldset>
            </div>
        </div>
    </div>
    <!-- /BOXES --> 
    <div class="row">
        <div id="panel-1" class="panel panel-default padding-20">
            <div class="panel-body">

                <?php if(!empty($priorityData)){ ?>
                    <a style="margin-bottom:5px;" class="btn btn-default btn-sm" href="<?php echo base_url().$action.'?business='.$business.'&startDate='.$startDate.'&endDate='.$endDate.'&excel=yes'; ?>">
                        Export To Excel
                    </a>
                    <div class="exportallplantable">    
                        <table class="table table-bordered table-hover  table-striped" id="commontable">
                            <thead>                            
                                <tr>         
                                    <?php
                                    $index = array_keys($priorityData[0]);
                                    $count = 0;
                                    for($i = 0; $i < count($index); $i++){
                                        ?><th <?php if($i < 12){ ?> class="brackgroundwhtie" <?php } ?>><?php echo str_replace(array('_','Per','Prac'), array(' ',' / ','Prac.'), $index[$i]); ?></th><?php
                                    }
                                    ?>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            function filterattendancearray($val){
                                Global $attendancedate;  
                                if($val['AttendanceDate'] == $attendancedate){
                                    return true;
                                }else{
                                    return false;
                                }  
                            }

                            $count = 0;
                            for ($i = 0; $i < count($priorityData); $i++) { $count++;
                                $arrayvalue = array_values($priorityData[$i]);
                                ?>
                                <tr>
                                    <?php
                                    $date = '';
                                    $level = '';
                                    // echo '<pre>',print_r($index);die();
                                    for ($j = 0; $j < count($index); $j++) {
                                        $value = $arrayvalue[$j];   
                                        if($date=='' && $index[$j] == 'WorkingDate') {
                                            $date =$arrayvalue[$j];                                   
                                        }
                                        if($level=='' && $index[$j] == 'UserId') {
                                            $level =$arrayvalue[$j];                                   
                                        }
                                        if (is_numeric($value)) { 
                                            if($j > 11){
                                                echo "<td style='text-align: right;'>" . number_format($value,1)."</td>"; 
                                            }else{
                                                echo "<td style='text-align: right;'>" . $value."</td>"; 
                                            }

                                        }else{ 
                                            if(strpos($value,'.jpg') || strpos($value,'.jpeg') || strpos($value,'.png')) {
                                                ?>
                                                <td>
                                                    <img class="imageUrlPopupButton" data-imageName="<?php echo $this->config->item('acifpm_attendance_image_url').$value;?>"
                                                            src="<?php echo $this->config->item('acifpm_attendance_image_url').$value; ?>" alt="" style="height:200px;height:100px;cursor: zoom-in;">
                                                    
                                                </td>
                                                <?php
                                            } else {
                                                echo "<td>" . $value."</td>"; 
                                            }

                                        }
                                    } 
                                    ?>
                                    <td><button type="button" data-level="<?php echo $level; ?>" data-date="<?php echo date('Y-m-d',strtotime($date));?>" class="btn btn-info btn-sm googleMapLocation" data-toggle="modal" data-target="#myModal">View Location</button></td>
                                </tr>

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>

            </div>
        </div>
    </div>
    </div>

</section>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Attendance Location</h4>
            </div>
            <div class="modal-body">
                <p id="mapLoadingText">Loading Map ...</p>
                <div id="map" style="width: 100%; height: 500px;"></div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var markersOnMap = '';
        var centerCords = '';
        var map;    
        var InforObj = [];
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService(); 

        $(".googleMapLocation").on('click',function() {
            var date = $(this).attr('data-date');
            // var date = '2020-10-15';
            var level = $(this).attr('data-level');
            // var level= $("#fmecode").val();
            // var level= 'D1';
            $("#map").html("");
            $.ajax({
                url: base_url + "report/userLocation/",
                type: "get",
                data: {
                    'level': level,
                    'date' : date
                },
                beforeSend: function(){
                },               
                success: function (response) {
                    markersOnMap = JSON.parse(response);               
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

            function addMarkerInfo() {  
                var waypts = [];   
                var start ='';
                var end = ''; 

                for (var i = 0; i < markersOnMap.length; i++) {
                    var contentString = '<div id="content"> Time: <span style="font-weight:700">' + markersOnMap[i].content +'</span></div>';

                    if(waypts.length < 25 && start!='') {
                        startInitiated = true;
                        waypts.push({
                            location: markersOnMap[i].LatLng[0],
                            stopover: true,
                        });                
                    }
                    if(start == '') {     
                        start = ''+markersOnMap[i].LatLng[0].lat +', '+ markersOnMap[i].LatLng[0].lng+'';                   
                    }
                    end = markersOnMap[i].LatLng[0].lat +', '+ markersOnMap[i].LatLng[0].lng;

                }
                drawRoute(start,end,waypts);
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
                directionsDisplay = new google.maps.DirectionsRenderer();
                var myOptions = {
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    zoom: 7,
                    center: centerCords,
                    //     waypoints: waypts,
                    optimizeWaypoints: false,

                }
                map = new google.maps.Map(document.getElementById("map"), myOptions);
                directionsDisplay.setMap(map);
                addMarkerInfo();
            }

            // Sets the map on all markers in the array.
            function setMapOnAll(map) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }



            // Shows any markers currently in the array.
            function showMarkers() {
                setMapOnAll(map);
            }        

        });
        function drawRoute(start,end,waypts) {     
            console.log(start,end,waypts);       
            var request = {
                origin:start, 
                destination:end,
                waypoints: waypts, 
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);

                }
            }); 
        }
    });

</script>


<style>
    .selected {
        background-color: #CCC;
        color: #FFF;
    }
    table tr td{
        vertical-align: middle !important;
    }

    .panel>.table-bordered, .panel>.table-responsive>.table-bordered{
        border: 1px solid #CCC;
    }
</style>

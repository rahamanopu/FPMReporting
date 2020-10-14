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

<script src="<?php echo base_url(); ?>assets/js/callbusiness.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/myplan.js"></script> -->

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
        <h3 class="main-title"><?php echo $pagetitel; ?></h3>                
    </div> 


    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                 	
                <div class="panel-body">
                    <fieldset>
                        <form action="<?php echo base_url(); ?>attendance/attendancereport" method="post" >
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
                                                value="<?php echo $row['Level3']; ?>"><?php echo $row['Level3Name']; ?></option>
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
                                                value="<?php echo $row['Level2']; ?>"><?php echo $row['Level2'].' '.$row['Level2Name']; ?></option>
                                        <?php 
                                            }
                                        }  
                                        ?>                                    
                                    </select> 
                                </div>
                            
                                <div class="col-md-1">
                                    FME
                                </div>
                                <div class="col-md-2">
                                    <select name="fmecode" id="fmecode" class="form-control" required="required">
                                        <?php if(!empty($fmelist) && COUNT($fmelist) > 1){ ?> <option></option> <?php } ?>
                                        <?php                                      
                                        if(!empty($fmelist)){ 
                                            foreach ($fmelist AS $row){
                                        ?>
                                            <option 
                                                <?php if(!empty($_POST['fmecode']) AND $row['Level1StaffID'] == $_POST['fmecode']){ ?> selected="selected" <?php } ?>
                                                value="<?php echo $row['Level1StaffID']; ?>"><?php echo $row['Level1Name']; ?></option>
                                        <?php 
                                            }
                                        }  
                                        ?>                                    
                                    </select> 
                                </div>
                                
                                <div class="col-md-1">
                                    Date From
                                </div>
                                <div class="col-md-2">
                                    <input type="month" name="period" 
                                           id="" class="form-control" 
                                           required="required"
                                           value="<?php if(!empty($period)){echo $period;} ?>"
                                           >
                                </div>

                                <div class="col-md-2">
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
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">
                    
                    <?php if(!empty($summary)){ ?>
                    <div class="exportallplantable table-responsive">    
                    <table class="table table-bordered table-hover  table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th></th>
                                <th colspan="2">Time</th>
                                <th colspan="2">Location</th>
                                <th colspan="2">Image</th>
                                <th colspan="2">Tour plan</th>
                            </tr>
                            <tr>         
                                <?php
                                $index = array_keys($summary[0]);
                                $count = 0;
                                for($i = 0; $i < count($index); $i++){
                                    ?><th <?php if($i < 12){ ?> class="brackgroundwhtie" <?php } ?>><?php echo str_replace(array('_','Per','Prac'), array(' ',' / ','Prac.'), $index[$i]); ?></th><?php
                                }
                                ?>
                            </tr>
                        </thead>
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
                        for ($i = 0; $i < count($summary); $i++) { $count++;
                            $arrayvalue = array_values($summary[$i]);
                            ?>
                            <tr>     
                                <td><img onclick="showhidediva('divhide<?php echo $count; ?>','idimage<?php echo $count; ?>')"
                                        id="idimage<?php echo $count; ?>"
                                        style="cursor: pointer;"
                                        src="<?php echo base_url(); ?>assets/icon/details_open.png"></td>
                                <?php
                                for ($j = 0; $j < count($index); $j++) {
                                    $value = $arrayvalue[$j];                                        
                                        if (is_numeric($value)) { 
                                            if($j > 11){
                                                echo "<td style='text-align: right;'>" . number_format($value,1)."</td>"; 
                                            }else{
                                                echo "<td style='text-align: right;'>" . $value."</td>"; 
                                            }

                                        }else{ 
                                            echo "<td>" . $value."</td>"; 
                                        }
                                    } 
                                ?>
                            </tr>
                            <tr>
                                <td colspan="10" style="display: none;" id="divhide<?php echo $count; ?>">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Time</th>
                                                <th>Attendance Type</th>
                                                <th>Location</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            Global $attendancedate;  
                                            $attendancedate = $summary[$i]['Attendance_date'];
                                            $filterdata = array_filter($detailsdata, "filterattendancearray");
                                            //echo "<pre />"; print_r($filterdata);
                                            $countin = 0;
                                            if(!empty($filterdata)){
                                                foreach($filterdata as $row){ $countin++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $countin; ?></td>
                                                    <td><?php echo $row['AttendanceTime']; ?></td>
                                                    <td><?php echo $row['AttendanceType']; ?></td>
                                                    <td><?php echo $row['Location']; ?></td>
                                                    <td><?php echo $row['ImageFile']; ?></td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        </table>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

</section>



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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>

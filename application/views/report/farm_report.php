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


    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->

        <div class="row">
            <div id="panel-1" class="panel panel-default">

                <div class="panel-body">
                    <fieldset>
                    <form action="<?php echo base_url().$action; ?>" method="post" >
                    <div class="col-md-12">                       

                        <!-- <div class="col-md-1">
                            Business
                        </div>
                        <div class="col-md-3">
                            <select name="business" id="business" class="form-control">
                                <option value="">-- Select --</option>
                                <?php foreach($userBusinesses as $userBusiness) {
                                    ?>
                                    <option value="<?php echo $userBusiness['Business']?>" 
                                    <?php echo (isset($business) && $business==$userBusiness['Business']) ? 'selected':''  ?>><?php echo $userBusiness['BusinessName']?></option>
                                    <?php
                                }?>
                                
                            </select>
                            
                        </div> -->
                
                        <?php if(isset($showDateFromField)){?>
                            <div class="col-md-1"  style="margin-top:5px;">
                                Date From
                            </div>
                            <div class="col-md-3"  style="margin-top:5px;">
                                <input type="text" name="startDate" autocomplete="off"
                                    id="" class="form-control datePicker" 
                                    required="required"
                                    value="<?php if (!empty($startDate)) {
                                        echo $startDate;
                                    } ?>">
                            </div>
                        <?php }?>

                        <?php if(isset($showDateToField)){?>
                            <div class="col-md-1"  style="margin-top:5px;">
                                Date TO
                            </div>
                            <div class="col-md-3"  style="margin-top:5px;">
                                <input type="text" name="endDate" autocomplete="off"
                                    id="" class="form-control datePicker" 
                                    required="required"
                                    value="<?php if (!empty($endDate)) {
                                        echo $endDate;
                                    } ?>">
                            </div>
                        <?php }?>
                        <div class="col-md-2">
                            <input type="submit" value="Submit"
                                name="submit" class="btn btn-primary">
                        </div> 
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

                <?php if(!empty($priorityData)){ ?>
                    <a style="margin-bottom:5px;" class="btn btn-default" href="<?php echo base_url().$action.'?fmecode='.$fmecode.'&period='.$period.'&excel=yes'; ?>">
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
                                </tr>
                            </thead>
                            <tbody>
                            <?php

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

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <?php } ?>
                    <p class="pull-right" style="font-size: 20px;"><?php echo $links; ?></p>
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

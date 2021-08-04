<script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script>


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
                                          

                        <div class="col-md-1 margin-top-5">
                            Business
                        </div>
                        <div class="col-md-2 margin-top-5">
                            <select name="business" id="business" class="form-control">
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
                            <div class="col-md-1 margin-top-5">
                                Date From
                            </div>
                            <div class="col-md-2 margin-top-5">
                                <input type="text" name="startDate" autocomplete="off"
                                    id="" class="form-control datePicker" 
                                    required="required"
                                    value="<?php if (!empty($startDate)) {
                                        echo $startDate;
                                    } ?>">
                            </div>
                        <?php }?>

                        <?php if(isset($showDateToField)){?>
                            <div class="col-md-1 margin-top-5">
                                Date To
                            </div>
                            <div class="col-md-2 margin-top-5">
                                <input type="text" name="endDate" autocomplete="off"
                                    id="" class="form-control datePicker" 
                                    required="required"
                                    value="<?php if (!empty($endDate)) {
                                        echo $endDate;
                                    } ?>">
                            </div>
                        <?php }?>

                        <div class="col-md-1 margin-top-5">
                                Report Status
                        </div>
                        <div class="col-md-2">
                        <select name="report_status" class="form-control">
                            <option value="">--Select--</option>
                            <?php foreach($reportStauses as $key=>$reportStaus) {
                                ?>
                                <option value="<?php echo $key;?>"><?php echo $reportStaus;?></option>
                                <?php

                            }?>
                            
                        </select>                      
                                
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
        <div id="panel-1" class="panel panel-default padding-20">
            <div class="panel-body">

                <?php if(!empty($priorityData)){ ?>
                    <a style="margin-bottom:5px;" class="btn btn-default" href="<?php echo base_url().$action.'?startDate='.$startDate.'&endDate='.$endDate.'&business='.$business.'&report_status='.$report_status.'&excel=yes'; ?>">
                        Export To Excel
                    </a>
                    <div class="exportallplantable">    
                        <table class="table table-bordered table-hover  table-striped dataTable">
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
                                    
                                    // echo '<pre>',print_r($index);die();
                                    for ($j = 0; $j < count($index); $j++) {
                                        $value = $arrayvalue[$j];   
                                        
                                        if (is_numeric($value)) { 
                                            echo "<td style='text-align: right;'>" . $value."</td>";

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

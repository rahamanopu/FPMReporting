<script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script>


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
            <div id="panel-1" class="panel panel-default padding-20">

                <div class="panel-body">
                    <fieldset>
                    <form action="<?php echo base_url().$action; ?>" method="post" >
                    <div class="col-md-12">                       

                        <div class="col-md-1">
                            ASM
                        </div>
                        <div class="col-md-2">
                            <select name="level2" id="level2" class="form-control select2">
                                <option value="">-- Select --</option>
                                <?php foreach($level2s as $item) {
                                    ?>
                                    <option value="<?php echo $item['Level2']?>" 
                                    <?php echo (isset($level2) && $level2==$item['Level2']) ? 'selected':''  ?>><?php echo $item['Level2'].' -- '.$item['Level2Name']?></option>
                                    <?php
                                }?>
                                
                            </select>
                            
                        </div>
                
                        <?php if(isset($showDateFromField)){?>
                            <div class="col-md-1"  style="margin-top:5px;">
                                Date From
                            </div>
                            <div class="col-md-2"  style="margin-top:5px;">
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
                                Date To
                            </div>
                            <div class="col-md-2"  style="margin-top:5px;">
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
                        name="submit" class="btn btn-primary margin-top-3">
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
        <div id="panel-1" class="panel panel-default padding-20">
            <div class="panel-body">

                <?php if(!empty($priorityData)){ ?>
                    <a style="margin-bottom:5px;" class="btn btn-default btn-sm" href="<?php echo base_url().$action.'?business='.$business.'&level2='.$level2.'&startDate='.$startDate.'&endDate='.$endDate.'&excel=yes'; ?>">
                        Export To Excel
                    </a>
                    <div class="exportallplantable">    
                        <table class="table table-bordered table-hover  table-striped" id="commontable">
                            <thead>                            
                                <tr>
                                    <td>User Name</td>
                                    <td>Visit Purpose</td>
                                    <td>Customer Code</td>
                                    <td>Customer Name</td>
                                    <td>Image</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            

                            $count = 0;
                            foreach ($priorityData as $key=> $item) {
                                 
                                ?>
                                <tr>
                                    <td><?php echo $item['UserName'];?></td>
                                    <td><?php echo $item['VisitPurpose'];?></td>
                                    <td><?php echo $item['CustomerCode'];?></td>
                                    <td><?php echo $item['Customer_Address'];?></td>
                                    <td>
                                        <img class="imageUrlPopupButton" data-imageName="<?php echo $this->config->item('app_image_base_url').'uploads/daily_activity/'.$item['Image'];?>" 
                                             src="<?php echo $this->config->item('app_image_base_url').'uploads/daily_activity/'. $item['Image'];?>"
                                             width="50" height="auto"></td>                                    
                                    
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


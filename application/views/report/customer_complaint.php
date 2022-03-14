<script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script>


<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title"><?php echo $pageTitel; ?></h3>  
        <?php echo getFlashMsg();?>              
    </div> 


    <div id="content" class="dashboard padding-left-20">
        <!-- BOXES -->

        <div class="row">
            <div id="panel-1" class="panel panel-default">

                <div class="panel-body">
                    <fieldset>
                    <form action="<?php echo base_url().$action; ?>" method="post" >
                                          

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
                            <?php foreach($reportStauses as $key=>$reportStaus) {
                                ?>
                                <option value="<?php echo $key;?>"
                                <?php echo (isset($report_status) && $report_status==$key ) ? 'selected': '' ?> ><?php echo $reportStaus;?></option>
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
        <div id="panel-1" class="panel panel-default padding-left-20">
            <div class="panel-body">

                <?php if(!empty($priorityData)){ ?>
                    <a style="margin-bottom:5px;" class="btn btn-default" href="<?php echo base_url().$action.'?startDate='.$startDate.'&endDate='.$endDate.'&report_status='.$report_status.'&excel=yes'; ?>">
                        Export To Excel
                    </a>
                    <form class="form-horizontal" method="POST" action="<?php echo base_url().'report/updateCustomerComplaintCategory'?>" accept="">
                        <div class="table-responsive">    
                            <table class="table table-bordered table-hover  table-striped dataTable">
                                <thead>                            
                                    <tr>
                                        <?php if(isset($report_status) && $report_status=='1') {
                                            ?>
                                            <th class="text-info">Complaint Categorige</th>         
                                            <?php
                                        }?>
                                        <th>Product Code</th>
                                        <th>Batch No</th>
                                        <th>Solved Status</th>
                                        <th>Solved Comments</th>
                                        <th>Customer Name</th>
                                        <th>Customer Mobile</th>
                                        <th>Customer Type</th>
                                        <th>Date</th>
                                        <th>Complaint Details</th>
                                        <th>Image</th>
                                        <th>Business</th>                                   
                                        <th>Entry By</th>                                   
                                        <th>Designation</th>                                   
                                
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php                            
                                foreach($priorityData as $item){ 
                                    $selectBoxStyle = 'none';
                                    if($item['ComplaintCategory'] == 'green') {
                                        $selectBoxStyle = "background-color:#008000;color:#fff";
                                    }
                                    else if($item['ComplaintCategory'] == 'yellow') {
                                        $selectBoxStyle = "background-color:#FFFF00;color:#fff";
                                    }
                                    else if($item['ComplaintCategory'] == 'red') {
                                        $selectBoxStyle = "background-color:#FF0000;color:#fff";
                                    }
                                    
                                    ?>
                                    <tr>
                                        <?php if(isset($report_status) && $report_status=='1') {
                                            ?>
                                            <td>
                                                <select class="categorySelectBox form-control" name="complaintCategory[]" style="<?php echo $selectBoxStyle?>;">
                                                    <option value="">--Select--</option>
                                                    <option value="green" <?php echo (isset($item['ComplaintCategory']) && $item['ComplaintCategory'] == 'green') ? 'selected' : ''?>>Green</option>
                                                    <option value="yellow" <?php echo (isset($item['ComplaintCategory']) && $item['ComplaintCategory'] == 'yellow') ? 'selected' : ''?>>Yellow</option>
                                                    <option value="red" <?php echo (isset($item['ComplaintCategory']) && $item['ComplaintCategory'] == 'red') ? 'selected' : ''?>>Red</option>
                                                </select>
                                                <input type="hidden" name="complaintID[]" value="<?php echo $item['ComplaintID']?>">
                                            </td>         
                                            <?php
                                        }?>
                                        
                                        <td><?php echo $item['ProductCode']?></td>
                                        <td><?php echo $item['BatchNo']?></td>
                                        <td><?php echo $item['Solved_Status']?></td>
                                        <td><?php echo $item['SolvedComments']?></td>
                                        <td><?php echo $item['CustomerName']?></td>
                                        <td><?php echo $item['CustomerMobile']?></td>
                                        <td><?php echo $item['CustomerType']?></td>
                                        <td><?php echo $item['Date']?></td>
                                        <td><?php echo $item['ComplaintDetails']?></td>
                                        <td><img src="<?php echo $this->config->item('app_image_base_url').'uploads/PaintComplaint/'.$item['Image']; ?>" alt="" style="height:200px;height:100px"></td>
                                        <td><?php echo $item['Business']?></td>
                                        <td><?php echo $item['UserName']?></td>
                                        <td><?php echo $item['Designation']?></td>

                                        
                                    </tr>

                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 margin-top-20">
                            <div class="form-group">
                                <input type="submit" value="Update Complaint Category" class="btn btn-success btn-block">
                            </div>
                        </div>
                    </form>
                    <?php } ?>

            </form>
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

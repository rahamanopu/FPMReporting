<script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script>


<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title"><?php echo $pageTitel; ?></h3>                
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
                    <a style="margin-bottom:5px;" class="btn btn-default" href="<?php echo base_url().$action.'?startDate='.$startDate.'&endDate='.$endDate.'&excel=yes'; ?>">
                        Export To Excel
                    </a>
                    <div class="table-responsive">    
                        <table class="table table-bordered table-hover  table-striped dataTable">
                            <thead>                            
                                <tr>         
                                    <?php
                                    $index = array_keys($priorityData[0]);
                                    $count = 0;
                                    echo "<th>Resolve</th>";
                                    for($i = 0; $i < count($index); $i++){
                                        ?><th><?php echo str_replace(array('_','Per','Prac'), array(' ',' / ','Prac.'), $index[$i]); ?></th><?php
                                    }
                                    ?>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            for ($i = 0; $i < count($priorityData); $i++) { $count++;
                                $arrayvalue = array_values($priorityData[$i]);
                                $btnClass = ($priorityData[$i]['Solved_Status']=='Resolved') ? 'btn-success' : 'btn-warning';
                                ?>
                                <tr>
                                    <td><button class="resolveCustomerComplaintModalBtn btn btn-sm <?php echo $btnClass;?>" data-complaint-id='<?php echo $arrayvalue[0];?>'>Resolve Complaint</button></td>
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

<div class="modal fade" id="resolveCustomerComplaintModal" tabindex="-1" role="dialog" aria-labelledby="resolveCustomerComplaintModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Resolve Customer Complaint</h4>
      </div>
      <div class="modal-body">
          <div class="">
              <input type="hidden" name="complaintId" id="complaintId">
              <textarea class="form-control" name="complaintText" id="complaintText" placeholder="Write Resolve Comments"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="resolveCustomerComplaintModalSaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $(".resolveCustomerComplaintModalBtn").on('click',function() {
            let complaintId = $(this).attr('data-complaint-id');
            $("#complaintId").val(complaintId);
            console.log(complaintId);
            $("#resolveCustomerComplaintModal").modal('toggle');
        });
        $("#resolveCustomerComplaintModalSaveBtn").on('click',function() {
            let complaintId = $("#complaintId").val();
            let complaintText = $("#complaintText").val();

            $.ajax({
                url: base_url+'report/resolveCustomerComplaint',
                method:'post',
                data: {
                    'complaintId': complaintId,
                    'complaintText': complaintText,
                },
                dataType: 'json',
                success:function(response) {
                    console.log(response);
                    $("#resolveCustomerComplaintModal").modal('toggle');
                    $("#complaintText").val('');
                    $("#complaintId").val('');

                }
            
            });

        });
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

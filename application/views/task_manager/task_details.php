<!-- Section  -->
<section id="main-content">
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title">Task Details Management</h3>
    </div>
    <?php echo getFlashMsg(); ?>

    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">
                    <fieldset>
                        <form action="<?php echo base_url() . $action; ?>" method="post">
                            <?php if(!empty($task_details)) {
                                ?>
                                <input type="hidden" name="TaskId" value="<?php echo $task_details['TaskId']?>">
                            <?php
                            }?>
                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="TaskTypeId">Task Type</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="TaskTypeId" id="TaskTypeId">
                                        <?php
                                        if (isset($task_types) && !empty($task_types)) {
                                            foreach ($task_types as $task_type) {
                                                ?>
                                                <option value="<?php echo $task_type['TaskTypeId'] ?>"
                                                    <?php echo (!empty($task_details) && $task_details['TaskTypeId'] == $task_type['TaskTypeId']) ? 'selected' : ''  ?>
                                                ><?php echo $task_type['TaskType'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="TaskDetails">Task Details</label>
                                <div class="col-sm-8">
                                    <textarea name="TaskDetails" id="TaskDetails" class="form-control"><?php echo (isset($task_details) && !empty($task_details)) ? $task_details['TaskDetails']: ''; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="MeasuredType">Measured Type</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="MeasuredType" id="MeasuredType">
                                        <?php
                                        if (isset($measured_types) && !empty($measured_types)) {
                                            foreach ($measured_types as $measured_type) {
                                                ?>
                                                <option value="<?php echo $measured_type['MeasuredType'] ?>"
                                                    <?php echo (!empty($task_details) && $task_details['MeasuredType'] == $measured_type['MeasuredType']) ? 'selected' : ''?>
                                                ><?php echo $measured_type['MeasuredDetails'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="Consideration">Consideration</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="Consideration" id="Consideration">
                                        <?php
                                        if (isset($considerations) && !empty($considerations)) {
                                            foreach ($considerations as $consideration) {
                                                ?>
                                                <option value="<?php echo $consideration['key'] ?>"
                                                    <?php echo (!empty($task_details) && $task_details['Consideration'] == $consideration['key']) ? 'selected' : ''?>
                                                ><?php echo $consideration['value'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="OperationType">Operation Type</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="OperationType" id="OperationType">
                                        <?php
                                        if (isset($operation_types) && !empty($operation_types)) {
                                            foreach ($operation_types as $operation_type) {
                                                ?>
                                                <option value="<?php echo $operation_type['OperationType'] ?>"
                                                    <?php echo (!empty($task_details) && $task_details['OperationType'] == $operation_type['OperationType']) ? 'selected' : ''?>
                                                ><?php echo $operation_type['OperationDesc'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="OperationDeadLine">Operation Deadline</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="OperationDeadLine" id="OperationDeadLine">
                                        <?php
                                        if (isset($days) && !empty($days)) {
                                            foreach ($days as $key => $day) {
                                                ?>
                                                <option value="<?php echo $key ?>"
                                                    <?php echo (!empty($task_details) && $task_details['OperationDeadLine'] == $key) ? 'selected' : ''?>
                                                        class="<?php
                                                        echo 'Monthly ';
                                                        if ($key == '1') echo 'Daily WhenRequired ';
                                                        if ($key >= 1 && $key <= 2) echo 'TwoDays ';
                                                        if ($key >= 1 && $key <= 7) echo 'Weekly ';
                                                        if ($key >= 1 && $key <= 14) echo 'BiWeekly ';
                                                        ?>"
                                                ><?php echo $day ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="StandardNo">Standard Value for Measurement</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="StandardNo" name="StandardNo" value="<?php echo (!empty($task_details)) ? $task_details['StandardNo'] : ''; ?>">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="DeadLineASperReq">Deadline As per
                                    Request</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="DeadLineASperReq"
                                           name="DeadLineASperReq" value="<?php echo (!empty($task_details)) ? $task_details['DeadLineASperReq'] : '';?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="TaskWeight">Task Weight</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="TaskWeight" name="TaskWeight" value="<?php echo (!empty($task_details)) ? $task_details['TaskWeight'] : '';?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label col-sm-4" for="TaskWeight">Active Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="Active" id="Active">
                                        <option
                                            <?php if (!empty($task_details) && $task_details['Active'] == 'Y') { ?> selected="selected" <?php } ?>
                                            value="Y">Active
                                        </option>
                                        <option
                                            <?php if (!empty($task_details) && $task_details['Active'] == 'N') { ?> selected="selected" <?php } ?>
                                            value="N">Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <button type="submit" class="btn btn-primary"><?php echo (isset($task_details) && !empty($task_details)) ? 'Update': 'Submit'  ?> </button>
                                </div>
                            </div>

                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body" style="max-height: 600px;overflow: auto;">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Task Type Id</th>
                                <th>Task Details</th>
                                <th>Measured Type</th>
                                <th>Operation Type</th>
                                <th>Consideration</th>
                                <th>Operation DeadLine</th>
                                <th>Standard No</th>
                                <th>DeadLine AS per Request</th>
                                <th>Task Weight</th>
                                <th>Active</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($task_details_list) && !empty($task_details_list)) {
                                foreach ($task_details_list as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['TaskTypeId'];?></td>
                                        <td><?php echo $row['TaskDetails'];?></td>
                                        <td><?php echo $row['MeasuredType'];?></td>
                                        <td><?php echo $row['OperationType'];?></td>
                                        <td><?php echo $row['Consideration'];?></td>
                                        <td><?php echo $row['OperationDeadLine'];?></td>
                                        <td><?php echo $row['StandardNo'];?></td>
                                        <td><?php echo $row['DeadLineASperReq'];?></td>
                                        <td><?php echo $row['TaskWeight'];?></td>
                                        <td><?php echo $row['Active'];?></td>
                                        <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'TaskManagement/taskDetailsManager?taskId='.$row['TaskId']?>">Edit</a></td>
                                    </tr>
                                    <?php
                                }
                            }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/js/jquery.chained-1.0.1.js"></script>
<script>
    $(document).ready(function () {
        $('#OperationDeadLine').chained('#OperationType');
    });
</script>
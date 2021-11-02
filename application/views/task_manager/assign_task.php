<!-- Section  -->
<section id="main-content">
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title">Task Management</h3>
    </div>
    <?php echo getFlashMsg(); ?>

    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>Assign Task</strong>
                </div>

                <div class="panel-body">
                    <fieldset>
                            <form action="<?php echo base_url() . $action; ?>" method="post">
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        Assign Date
                                    </div>
                                    <div class="col-md-8">
                                        <input class="datePicker form-control" type="text" name="AssignedDateFrom" value="<?php echo date('Y-m-d');?>">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        User List
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control" name="user_list" id="user_list">
                                            <?php if(isset($user_list) && !empty($user_list)) {
                                                ?>
                                                <option value="">Select</option>
                                            <?php
                                                foreach ($user_list as $user) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $user['UserId']; ?>"><?php echo $user['UserName']; ?></option>
                                                    <?php
                                                }
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="col-md-12">
                                        Task List
                                    </div>
                                    <div class="col-md-12">
                                        <div class="padding-3" style="max-height: 600px; border: 1px solid #337ab7;overflow: auto;">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                    <thead>
                                                    <tr>
                                                        <th>Task Type</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="task_list_container">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="already_assigned_task_list" id="already_assigned_task_list" value="">

                                <div class="col-md-12 form-group">
                                    <div class="col-md-8">
                                        <input type="submit" value="<?php echo !empty($task_type) ? 'Update' : 'Submit' ?>"
                                               id="submit"
                                               name="submit" class="btn btn-primary">
                                    </div>
                                </div>

                                <div class="col-md-12 form-group" style="margin-bottom: 100px">
                                    <font color="red">*</font> All Are Mandatory Mandatory information
                                </div>

                            </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/view/task_manager/assign_task.js"></script>
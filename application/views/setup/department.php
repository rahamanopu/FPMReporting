<!-- Section  -->
<section id="main-content">
    <div class="content-title">
        <h3 class="main-title">Tree Management</h3>
    </div>
    <div>
        <!-- BOXES -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong><?php echo isset($pageTitle) ? $pageTitle : ''?></strong>
                    </div>
                    <?php echo getFlashMsg(); ?>
                    <div class="panel-body">
                        <form class="form-horizontal" action="<?php echo base_url() ?>setup/department-add" method="post">
                            <input type="hidden" name="departmentId"
                                   value="<?php echo isset($department['DepartmentID']) ? $department['DepartmentID'] : '' ?>">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="departmentName" class="control-label col-sm-4">Department Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="departmentName" id="departmentName"
                                               class="form-control"
                                               value="<?php echo (isset($department['DepartmentName'])) ? $department['DepartmentName'] : '' ?>"
                                               required placeholder="Department Name" maxlength="255">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($department) && !empty($department)) ? 'Update' : 'Add' ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>Department List</strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        // Form validation
        $("form").validate({
            // Specify validation rules
            rules: {},
            // Specify validation error messages
            messages: {},
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
<script type="text/javascript">
    //var base_url = '<?php //echo base_url(); ?>//';
</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>

<!-- Section  -->
<section id="main-content">
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title">Update Device ID</h3>
    </div>
    <?php
    echo getFlashMsg();
    ?>
    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>User List</strong>
                </div>

                <div class="panel-body table-responsive">
                    <fieldset>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>User Id</th>
                                <th>Staff Id</th>
                                <th>User Name</th>
                                <th>Designation</th>
                                <th>Active Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($userlist)) {
                                $count = 0;
                                foreach ($userlist AS $row) {
                                    $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['UserId']; ?></td>
                                        <td><?php echo $row['StaffId']; ?></td>
                                        <td><?php echo $row['UserName']; ?></td>
                                        <td><?php echo $row['Designation']; ?></td>
                                        <td><?php echo $row['ActiveStatus']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>usermanager/index/<?php echo $row['UserId']; ?>"
                                               title="Edit" data-toggle="tooltip">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>

                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>assets/js/usermanager.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Form validation
        $("form").validate({
            // Specify validation rules
            rules: {
            },
            // Specify validation error messages
            messages: {
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

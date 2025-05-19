<script type="text/javascript">
    //var base_url = '<?php //echo base_url(); ?>//';
</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

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
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4 col-md-offset-8 text-right">
                                <input type="text" id="userSearchInput" class="form-control" placeholder="Search by User ID, Name, or Designation">
                            </div>
                        </div>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Designation</th>
                                <th>UUID</th>
                                <th>Update</th>
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
                                        <td><?php echo $row['UserName']; ?></td>
                                        <td><?php echo $row['Designation']; ?></td>
                                        <td>
                                            <input type="text" class="form-control uuid-input" id="uuid_<?php echo $row['UserId']; ?>" value="<?php echo $row['uuID']; ?>" />
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success update-uuid-btn" 
                                                    data-userid="<?php echo $row['UserId']; ?>">Update</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.update-uuid-btn').click(function () {
            var userId = $(this).data('userid');
            var uuid = $('#uuid_' + userId).val();

            $.ajax({
                url: '<?php echo base_url("usermanager/update_uuid"); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    user_id: userId,
                    uuid: uuid
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message || "UUID updated successfully!");
                    } else {
                        toastr.error(response.message || "Failed to update UUID.");
                    }
                },
                error: function () {
                    toastr.error("An error occurred while updating the UUID.");
                }
            });
        });

        $('#userSearchInput').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function () {
                $(this).toggle(
                    $(this).find('td:eq(1)').text().toLowerCase().indexOf(value) > -1 || // UserId
                    $(this).find('td:eq(2)').text().toLowerCase().indexOf(value) > -1 || // UserName
                    $(this).find('td:eq(3)').text().toLowerCase().indexOf(value) > -1    // Designation
                );
            });
        });
    });
</script>

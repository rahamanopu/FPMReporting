<!-- Section  -->
<section id="main-content">    
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
                        <form class="form-horizontal" action="<?php echo base_url() ?>setup/thana-add" method="post">
                            <input type="hidden" name="UpazilaCode"
                                   value="<?php echo (isset($thana) && !empty($thana)) ? $thana['UpazilaCode'] : '' ?>">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistrictCode" class="control-label col-sm-4">District </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="DistrictCode" id="DistrictCode"
                                                required>
                                            <option value="">--Select--</option>
                                            <?php if (isset($districts) && !empty($districts)) {
                                                foreach ($districts as $district) {
                                                    ?>
                                                    <option value="<?php echo $district['DistrictCode']; ?>"
                                                        <?php echo (isset($thana['DistrictCode']) && ($thana['DistrictCode'] == $district['DistrictCode'])) ? 'selected' : '' ?>
                                                    ><?php echo $district['DistrictCode'] . ' - ' . $district['DistrictName']; ?></option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UpazilaName" class="control-label col-sm-4">Thana Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="UpazilaName" id="UpazilaName"
                                               class="form-control"
                                               value="<?php echo (isset($thana['UpazilaName'])) ? $thana['UpazilaName'] : '' ?>"
                                               required placeholder="Thana Name">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($thana) && !empty($thana)) ? 'Update' : 'Add' ?>
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
                        <strong>Plant List</strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Thana Name</th>                                    
                                    <th>District Name</th>                                    
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
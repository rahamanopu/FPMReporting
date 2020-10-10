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
                        <form class="form-horizontal" action="<?php echo base_url() ?>setup/plant-add" method="post">
                            <input type="hidden" name="plantId"
                                   value="<?php echo (isset($plant) && !empty($plant)) ? $plant['PlantID'] : '' ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plantShortName" class="control-label col-sm-4">Plant Short Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="plantShortName" id="plantShortName"
                                               class="form-control"
                                               value="<?php echo (isset($plant['PlantShortName'])) ? $plant['PlantShortName'] : '' ?>"
                                               required placeholder="Plant Short Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plantName" class="control-label col-sm-4">Plant Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="plantName" id="plantName" class="form-control"
                                               value="<?php echo (isset($plant['PlantName'])) ? $plant['PlantName'] : '' ?>"
                                               required placeholder="Plant Short Name">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plantAdmin" class="control-label col-sm-4">Plant Admin</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="plantAdmin" id="plantAdmin" class="form-control"
                                               value="<?php echo (isset($plant['PlantAdmin'])) ? $plant['PlantAdmin'] : '' ?>"
                                               required placeholder="plant Admin">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distributorCode" class="control-label col-sm-4">Distributor Code</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="distributorCode" id="distributorCode"
                                                required>
                                            <option value="">--Select--</option>
                                            <?php if (isset($distributors) && !empty($distributors['rows'])) {
                                                foreach ($distributors['rows'] as $distributor) {
                                                    ?>
                                                    <option value="<?php echo $distributor['DistributorCode']; ?>"
                                                        <?php echo (isset($plant['DistributorCode']) && ($plant['DistributorCode'] == $distributor['DistributorCode'])) ? 'selected' : '' ?>
                                                    ><?php echo $distributor['DistributorCode'] . ' - ' . $distributor['DistributorPoint']; ?></option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plantType" class="control-label col-sm-4">Plant Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="plantType" id="plantType">
                                            <option value="">--Select--</option>
                                            <option value="RTD" <?php echo (isset($plant['PlantType']) && ($plant['PlantType'] == 'RTD')) ? 'selected' : '' ?>>
                                                RTD
                                            </option>
                                            <option value="TDC" <?php echo (isset($plant['PlantType']) && ($plant['PlantType'] == 'TDC')) ? 'selected' : '' ?>>
                                                TDC
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plantCodeSAP" class="control-label col-sm-4">Plant Code SAP</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="plantCodeSAP" id="plantCodeSAP" class="form-control"
                                               value="<?php echo (isset($plant['PlantCodeSAP'])) ? $plant['PlantCodeSAP'] : '' ?>"
                                               placeholder="plant Code SAP">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="active" class="control-label col-sm-4">Active Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="active" id="active" required>
                                            <option value="Y" <?php echo (isset($plant['Active']) && ($plant['Active'] == 'Y')) ? 'selected' : '' ?>>
                                                Active
                                            </option>
                                            <option value="N" <?php echo (isset($plant['Active']) && ($plant['Active'] == 'N')) ? 'selected' : '' ?> >
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="plantAddress" class="control-label col-sm-2">Plant Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="plantAddress" id="plantAddress" class="form-control"
                                                  placeholder="Plant Address"
                                                  maxlength="800"> <?php echo (isset($plant['PlantAddress'])) ? $plant['PlantAddress'] : '' ?> </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($plant) && !empty($plant)) ? 'Update' : 'Add' ?>
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
                                    <th>Plant Short Name</th>
                                    <th>Plant Name</th>
                                    <th>Plant Address</th>
                                    <th>Plant Admin</th>
                                    <th>Distributor Code</th>
                                    <th>Plant Type</th>
                                    <th>Plant Code SAP</th>
                                    <th>Distributor Point</th>
                                    <th>Distributor Name</th>
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
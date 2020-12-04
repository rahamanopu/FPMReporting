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
                        <form class="form-horizontal" action="<?php echo base_url() ?>setup/distributor-add" method="post">
                            <input type="hidden" name="ExistingDistributorCode"
                                   value="<?php echo (isset($distributor) && !empty($distributor)) ? $distributor['DistributorCode'] : '' ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Zone" class="control-label col-sm-4">Zone</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="Zone" id="Zone"
                                               class="form-control"
                                               value="<?php echo (isset($distributor['Zone'])) ? $distributor['Zone'] : '' ?>"
                                               required placeholder="Zone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Territory" class="control-label col-sm-4">Territory</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="Territory" id="Territory"
                                               class="form-control"
                                               value="<?php echo (isset($distributor['Territory'])) ? $distributor['Territory'] : '' ?>"
                                               required placeholder="Territory">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistrictCode" class="control-label col-sm-4">District </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="District" id="District"
                                                required>
                                            <option value="">--Select--</option>
                                            <?php if (isset($districts) && !empty($districts)) {
                                                foreach ($districts as $district) {
                                                    ?>
                                                    <option value="<?php echo strtoupper($district['DistrictName']); ?>"
                                                        <?php echo (isset($distributor['District']) && ($distributor['District'] == strtoupper($district['DistrictName']))) ? 'selected' : '' ?>
                                                    ><?php echo $district['DistrictName']; ?></option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistributorPoint" class="control-label col-sm-4">Distributor Point</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="DistributorPoint" id="DistributorPoint"
                                               class="form-control"
                                               value="<?php echo (isset($distributor['DistributorPoint'])) ? $distributor['DistributorPoint'] : '' ?>"
                                               required placeholder="Distributor Point">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistributorCode" class="control-label col-sm-4">Distributor Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="DistributorCode" id="DistributorCode"
                                               class="form-control"
                                               value="<?php echo (isset($distributor['DistributorCode'])) ? $distributor['DistributorCode'] : '' ?>"
                                               required placeholder="Distributor Code">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistributorName" class="control-label col-sm-4">Distributor Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="DistributorName" id="DistributorName" class="form-control"
                                               value="<?php echo (isset($distributor['DistributorName'])) ? $distributor['DistributorName'] : '' ?>"
                                               required placeholder="Distributor Name">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistributorType" class="control-label col-sm-4">Distributor Type</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="DistributorType" id="DistributorType" class="form-control"
                                               value="<?php echo (isset($distributor['DistributorType'])) ? $distributor['DistributorType'] : '' ?>"
                                               required placeholder="Distributor Type">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ProprietorName" class="control-label col-sm-4">Proprietor Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="ProprietorName" id="ProprietorName" class="form-control"
                                               value="<?php echo (isset($distributor['ProprietorName'])) ? $distributor['ProprietorName'] : '' ?>"
                                               required placeholder="Proprietor Name">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Address" class="control-label col-sm-4">Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="Address" id="Address" class="form-control"
                                               value="<?php echo (isset($distributor['Address'])) ? $distributor['Address'] : '' ?>"
                                               required placeholder="Address">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ContactNO" class="control-label col-sm-4">Contact NO</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="ContactNO" id="ContactNO" class="form-control"
                                               value="<?php echo (isset($distributor['ContactNO'])) ? $distributor['ContactNO'] : '' ?>"
                                               required placeholder="Contact NO">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TSIID" class="control-label col-sm-4">TSI ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="TSIID" id="TSIID" class="form-control"
                                               value="<?php echo (isset($distributor['TSIID'])) ? $distributor['TSIID'] : '' ?>"
                                               required placeholder="TSI ID">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TSIName" class="control-label col-sm-4">TSI Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="TSIName" id="TSIName" class="form-control"
                                               value="<?php echo (isset($distributor['TSIName'])) ? $distributor['TSIName'] : '' ?>"
                                               required placeholder="TSIName">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ICID" class="control-label col-sm-4">IC ID</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="ICID" id="ICID" class="form-control"
                                               value="<?php echo (isset($distributor['ICID'])) ? $distributor['ICID'] : '' ?>"
                                               required placeholder="IC ID">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ICName" class="control-label col-sm-4">IC Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="ICName" id="ICName" class="form-control"
                                               value="<?php echo (isset($distributor['ICName'])) ? $distributor['ICName'] : '' ?>"
                                               required placeholder="IC Name">
                                    </div>
                                </div>
                            </div>
                            

                            
                        
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($distributor) && !empty($distributor)) ? 'Update' : 'Add' ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

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
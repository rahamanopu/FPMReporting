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
                                    <label for="Business" class="control-label col-sm-4">Business</label>
                                    <div class="col-sm-8">
                                        <select name="Business" id="Business" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($userBusinesses as $business) {
                                                ?>
                                                <option value="<?php echo $business['Business']?>" <?php echo (isset($territory['Business']) && $territory['Business'] == $business['Business']) ? 'selected' : ''?> ><?php echo $business['BusinessName']?></option>
                                                <?php
                                            }?>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="TTYCode" class="control-label col-sm-4">Territory</label>
                                    <div class="col-sm-8">
                                        <select name="TTYCode" id="TTYCode" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($territories as $territory) {
                                                ?>
                                                <option value="<?php echo $territory['TTYCode']?>" <?php echo (isset($territory['TTYCode']) && $territory['TTYCode'] == $territory['TTYCode']) ? 'selected' : ''?> ><?php echo $territory['TTYName']?></option>
                                                <?php
                                            }?>
                                        </select>
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
                            <div class="text-center" style="border-bottom: 1px solid #ddd; margin-bottom:10px">Distributor SDMS</div>
                            <?php for($i=0;$i<4;$i++) {
                                ?>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DistributorSDMSBusiness" class="control-label col-sm-4">Distributor SDMS Business</label>
                                        <div class="col-sm-8">
                                            <select name="DistributorSDMSBusiness[]"  class="form-control" required>
                                                <option value="">Select</option>
                                                <?php foreach($businesses as $business) {
                                                    ?>
                                                    <option value="<?php echo $business['Business']?>" <?php echo (isset($distributorSDMS['DistributorSDMSBusiness']) && $distributorSDMS['DistributorSDMSBusiness'] == $business['Business']) ? 'selected' : ''?> ><?php echo $business['BusinessName']?></option>
                                                    <?php
                                                }?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DistributorSDMSCode" class="control-label col-sm-4">Distributor SDMS Code</label>
                                        <div class="col-sm-8">
                                        <input type="text" name="DistributorSDMSCode[]" class="form-control"
                                                value="<?php echo (isset($distributorSDMS['DistributorSDMSCode'])) ? $distributorSDMS['DistributorSDMSCode'] : '' ?>"
                                                required placeholder="Distributor SDMS Code">
                                            
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }?>
                            
                            
                            


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
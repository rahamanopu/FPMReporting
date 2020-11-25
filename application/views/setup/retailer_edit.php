<!-- Section  -->
<section id="main-content">    
    <div>
        <!-- BOXES -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong><?php echo isset($pageTitel) ? $pageTitel : ''?></strong>
                    </div>
                    <?php echo getFlashMsg(); ?>
                    <div class="panel-body">
                        <form class="form-horizontal" action="<?php echo base_url().$action ?>" method="post">
                            <input type="hidden" name="RetailerID"
                                   value="<?php echo (isset($retailer) && !empty($retailer)) ? $retailer['RetailerID'] : '' ?>">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RetailerName" class="control-label col-sm-4">Retailer Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="RetailerName" id="RetailerName"
                                               class="form-control"
                                               value="<?php echo (isset($retailer['RetailerName'])) ? $retailer['RetailerName'] : '' ?>"
                                               required placeholder="Retailer Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RetailerContactNumber" class="control-label col-sm-4">Retailer Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="RetailerContactNumber" id="RetailerContactNumber"
                                               class="form-control"
                                               value="<?php echo (isset($retailer['RetailerContactNumber'])) ? $retailer['RetailerContactNumber'] : '' ?>"
                                               required placeholder="Retailer Contact Number">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistributorCode" class="control-label col-sm-4">Distributor</label>
                                    <div class="col-sm-8">
                                        <select name="DistributorCode" class="form-control" require>
                                            <?php foreach($distributors as $distributor) {
                                                ?>
                                                <option value="<?php echo $distributor['DistributorCode']?>" <?php echo ($retailer['DistributorCode']==$distributor['DistributorCode']) ? 'selected' : '' ?>><?php echo $distributor['DistributorName']?></option>
                                                <?php
                                            }?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="HotelPlace" class="control-label col-sm-4">Remarks</label>
                                    <div class="col-sm-8">
                                        <textarea  name="Remarks" id="Remarks" class="form-control" cols="10" placeholder="Enter Remarks Here"><?php echo (isset($retailer['Remarks'])) ? $retailer['Remarks'] : '' ?></textarea>

                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($retailer) && !empty($retailer)) ? 'Update' : 'Add' ?>
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
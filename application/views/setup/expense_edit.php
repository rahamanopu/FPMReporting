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
                            <input type="hidden" name="ExpenseId"
                                   value="<?php echo (isset($expense) && !empty($expense)) ? $expense['ExpenseId'] : '' ?>">
                                   <input type="hidden" name="ExpenseDetailsID"
                                   value="<?php echo (isset($expense) && !empty($expense)) ? $expense['ExpenseDetailsID'] : '' ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmpName" class="control-label col-sm-4">Employee Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="EmpName" id="EmpName"
                                               class="form-control"
                                               value="<?php echo (isset($expense['EmpName'])) ? $expense['EmpName'] : '' ?>"
                                               required placeholder="Employee Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UserLevel" class="control-label col-sm-4">User Level</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="UserLevel" id="UserLevel" class="form-control"
                                               value="<?php echo (isset($expense['UserLevel'])) ? $expense['UserLevel'] : '' ?>"
                                               required placeholder="UserLevel">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="LevelCode" class="control-label col-sm-4">Level Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="LevelCode" id="LevelCode" class="form-control"
                                               value="<?php echo (isset($expense['LevelCode'])) ? $expense['LevelCode'] : '' ?>"
                                               required placeholder="LevelCode">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ProductName" class="control-label col-sm-4">Product Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="ProductName" id="ProductName" class="form-control"
                                               value="<?php echo (isset($expense['ProductName'])) ? $expense['ProductName'] : '' ?>"
                                               required placeholder="Product Name">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Capacity" class="control-label col-sm-4">Capacity</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="Capacity" id="Capacity" class="form-control"
                                               value="<?php echo (isset($expense['Capacity'])) ? $expense['Capacity'] : '' ?>"
                                               required placeholder="Capacity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="BrandCode" class="control-label col-sm-4">Brand</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="BrandCode" id="BrandCode"
                                                required>
                                            <option value="">--Select--</option>
                                            <?php if (isset($brands) && !empty($brands)) {
                                                foreach ($brands as $brand) {
                                                    ?>
                                                    <option value="<?php echo $brand['BrandCode']; ?>"
                                                        <?php echo (isset($expense['BrandCode']) && ($expense['BrandCode'] == $brand['BrandCode'])) ? 'selected' : '' ?>
                                                    ><?php echo $brand['BrandCode']; ?></option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmptyDealerUnitPrice" class="control-label col-sm-4">Empty Dealer Unit Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="EmptyDealerUnitPrice" id="EmptyDealerUnitPrice" class="form-control"
                                               value="<?php echo (isset($expense['EmptyDealerUnitPrice'])) ? $expense['EmptyDealerUnitPrice'] : '' ?>"
                                               required placeholder="Empty Dealer Unit Price">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmptyDealerVAT" class="control-label col-sm-4">Empty Dealer VAT</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="EmptyDealerVAT" id="EmptyDealerVAT" class="form-control"
                                               value="<?php echo (isset($expense['EmptyDealerVAT'])) ? $expense['EmptyDealerVAT'] : '' ?>"
                                               required placeholder="Empty Dealer VAT">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmptyRetailerUnitPrice" class="control-label col-sm-4">Empty Retailer Unit Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="EmptyRetailerUnitPrice" id="EmptyRetailerUnitPrice" class="form-control"
                                               value="<?php echo (isset($expense['EmptyRetailerUnitPrice'])) ? $expense['EmptyRetailerUnitPrice'] : '' ?>"
                                               required placeholder="Empty Retailer Unit Price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmptyRetailerVAT" class="control-label col-sm-4">Empty Retailer VAT</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="EmptyRetailerVAT" id="EmptyRetailerVAT" class="form-control"
                                               value="<?php echo (isset($expense['EmptyRetailerVAT'])) ? $expense['EmptyRetailerVAT'] : '' ?>"
                                               required placeholder="Empty Retailer VAT">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmptyMRP" class="control-label col-sm-4">Empty MRP</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="EmptyMRP" id="EmptyMRP" class="form-control"
                                               value="<?php echo (isset($expense['EmptyMRP'])) ? $expense['EmptyMRP'] : '' ?>"
                                               required placeholder="Empty MRP">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PakageDealerUnitPrice" class="control-label col-sm-4">Pakage Dealer Unit Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="PakageDealerUnitPrice" id="PakageDealerUnitPrice" class="form-control"
                                               value="<?php echo (isset($expense['PakageDealerUnitPrice'])) ? $expense['PakageDealerUnitPrice'] : '' ?>"
                                               required placeholder="Pakage Dealer Unit Price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PakageDealerVAT" class="control-label col-sm-4">Pakage Dealer VAT</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="PakageDealerVAT" id="PakageDealerVAT" class="form-control"
                                               value="<?php echo (isset($expense['PakageDealerVAT'])) ? $expense['PakageDealerVAT'] : '' ?>"
                                               required placeholder="Pakage Dealer VAT">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PakageRetailerUnitPrice" class="control-label col-sm-4">Pakage Retailer Unit Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="PakageRetailerUnitPrice" id="PakageRetailerUnitPrice" class="form-control"
                                               value="<?php echo (isset($expense['PakageRetailerUnitPrice'])) ? $expense['PakageRetailerUnitPrice'] : '' ?>"
                                               required placeholder="Pakage Retailer Unit Price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PakageRetailerVAT" class="control-label col-sm-4">Pakage Retailer VAT</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="PakageRetailerVAT" id="PakageRetailerVAT" class="form-control"
                                               value="<?php echo (isset($expense['PakageRetailerVAT'])) ? $expense['PakageRetailerVAT'] : '' ?>"
                                               required placeholder="Pakage Retailer VAT">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="PakageMRP" class="control-label col-sm-4">Pakage MRP</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="PakageMRP" id="PakageMRP" class="form-control"
                                               value="<?php echo (isset($expense['PakageMRP'])) ? $expense['PakageMRP'] : '' ?>"
                                               required placeholder="Pakage MRP">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RefillDealerUnitPrice" class="control-label col-sm-4">Refill Dealer Unit Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="RefillDealerUnitPrice" id="RefillDealerUnitPrice" class="form-control"
                                               value="<?php echo (isset($expense['RefillDealerUnitPrice'])) ? $expense['RefillDealerUnitPrice'] : '' ?>"
                                               required placeholder="Refill Dealer Unit Price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RefillDealerVAT" class="control-label col-sm-4">Refill Dealer VAT</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="RefillDealerVAT" id="RefillDealerVAT" class="form-control"
                                               value="<?php echo (isset($expense['RefillDealerVAT'])) ? $expense['RefillDealerVAT'] : '' ?>"
                                               required placeholder="Refill Dealer VAT">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RefillRetailerUnitPrice" class="control-label col-sm-4">Refill Retailer Unit Price</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="RefillRetailerUnitPrice" id="RefillRetailerUnitPrice" class="form-control"
                                               value="<?php echo (isset($expense['RefillRetailerUnitPrice'])) ? $expense['RefillRetailerUnitPrice'] : '' ?>"
                                               required placeholder="Refill Retailer Unit Price">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RefillRetailerVAT" class="control-label col-sm-4">Refill Retailer VAT</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="RefillRetailerVAT" id="RefillRetailerVAT" class="form-control"
                                               value="<?php echo (isset($expense['RefillRetailerVAT'])) ? $expense['RefillRetailerVAT'] : '' ?>"
                                               required placeholder="Refill Retailer VAT">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="RefillMRP" class="control-label col-sm-4">Refill MRP</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="RefillMRP" id="RefillMRP" class="form-control"
                                               value="<?php echo (isset($expense['RefillMRP'])) ? $expense['RefillMRP'] : '' ?>"
                                               required placeholder="Refill MRP">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Business" class="control-label col-sm-4">Business</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="Business" id="Business"
                                                required>
                                            <option value="">--Select--</option>
                                            <?php if (isset($businesses) && !empty($businesses)) {
                                                foreach ($businesses as $business) {
                                                    ?>
                                                    <option value="<?php echo $business['Business']; ?>"
                                                        <?php echo (isset($expense['Business']) && ($expense['Business'] == $business['Business'])) ? 'selected' : '' ?>
                                                    ><?php echo $business['BusinessName'].' - '.$business['CompanyName']; ?></option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Active" class="control-label col-sm-4">Active Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="Active" id="Active" required>
                                            <option value="Y" <?php echo (isset($expense['Active']) && ($expense['Active'] == 'Y')) ? 'selected' : '' ?>>
                                                Active
                                            </option>
                                            <option value="N" <?php echo (isset($expense['Active']) && ($expense['Active'] == 'N')) ? 'selected' : '' ?> >
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($expense) && !empty($expense)) ? 'Update' : 'Add' ?>
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
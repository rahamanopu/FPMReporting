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
                        <form class="form-horizontal" action="<?php echo base_url() ?>setup/sr-add" method="post">
                            <input type="hidden" name="ExistingSRCode"
                                   value="<?php echo (isset($sr) && !empty($sr)) ? $sr['SRCode'] : '' ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Business" class="control-label col-sm-4">Business</label>
                                    <div class="col-sm-8">
                                        <select name="Business" id="Business" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($businesses as $business) {
                                                ?>
                                                <option value="<?php echo $business['Business']?>" <?php echo (isset($sr['Business']) && $sr['Business'] == $business['Business']) ? 'selected' : ''?> ><?php echo $business['BusinessName']?></option>
                                                <?php
                                            }?>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="DistributorCode" class="control-label col-sm-4">Distributor</label>
                                    <div class="col-sm-8">
                                        <select name="DistributorCode" id="DistributorCode" class="form-control" required>
                                            <!-- <option value="">Select</option> -->
                                            <?php foreach($distributors as $distributor) {
                                                ?>
                                                <option value="<?php echo $distributor['DistributorCode']?>"
                                                data-chained="<?php echo $distributor['Business']?>"                                               
                                                <?php echo (isset($sr['DistributorCode']) && $sr['DistributorCode'] == $distributor['DistributorCode']) ? 'selected' : ''?> ><?php echo $distributor['DistributorName']?></option>
                                                <?php
                                            }?>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SRCode" class="control-label col-sm-4">SR Code</label>
                              
                                    <div class="col-sm-8">
                                        <input type="text" name="SRCode" id="SRCode" class="form-control"
                                               value="<?php echo (isset($sr['SRCode'])) ? $sr['SRCode'] : '' ?>"
                                               required placeholder="SR Code">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="StaffID" class="control-label col-sm-4">StaffID</label>
                              
                                    <div class="col-sm-8">
                                        <input type="text" name="StaffID" id="StaffID" class="form-control"
                                               value="<?php echo (isset($sr['StaffID'])) ? $sr['StaffID'] : '' ?>"
                                               required placeholder="StaffID">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SRName" class="control-label col-sm-4">SR Name</label>
                              
                                    <div class="col-sm-8">
                                        <input type="text" name="SRName" id="SRName" class="form-control"
                                               value="<?php echo (isset($sr['SRName'])) ? $sr['SRName'] : '' ?>"
                                               required placeholder="SR Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SRTypeID" class="control-label col-sm-4">SR TypeID</label>
                              
                                    <div class="col-sm-8">
                                        <select name="Business" id="Business" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($srTypes as $srType) {
                                                ?>
                                                <option value="<?php echo $srType['SRTypeID']?>" <?php echo (isset($sr['SRTypeID']) && $sr['SRTypeID'] == $srType['SRTypeID']) ? 'selected' : ''?> ><?php echo $srType['SRType']?></option>
                                                <?php
                                            }?>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SRLocation" class="control-label col-sm-4">SR Location</label>                              
                                    <div class="col-sm-8">
                                        <input type="text" name="SRLocation" id="SRLocation" class="form-control"
                                               value="<?php echo (isset($sr['SRLocation'])) ? $sr['SRLocation'] : '' ?>"
                                               required placeholder="SR Location">
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($sr) && !empty($sr)) ? 'Update' : 'Add' ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>Territory List</strong>
                        
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>                                 
                                    <th>Business Name</th>
                                    <th>SR Code</th>                            
                                    <th>SR Name</th>                            
                                    <th>Distributor Name</th>                                    
                                    <th>SR Location</th>                                    
                                    <th>SR Type</th>                                    
                                    <th>Edit</th>                              
                                    
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
        // alert("OLLL");
        $("#DistributorCode").chainedTo("#Business");
    });
</script>

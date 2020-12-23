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
                        <form class="form-horizontal" action="<?php echo base_url() ?>setup/territory-add" method="post">
                            <input type="hidden" name="ExistingTTYCode"
                                   value="<?php echo (isset($territory) && !empty($territory)) ? $territory['TTYCode'] : '' ?>">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Business" class="control-label col-sm-4">Business</label>
                                    <div class="col-sm-8">
                                        <select name="Business" id="Business" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php foreach($businesses as $business) {
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
                                    <label for="TTYName" class="control-label col-sm-4">Territory Name</label>
                              
                                    <div class="col-sm-8">
                                        <input type="text" name="TTYName" id="TTYName" class="form-control"
                                               value="<?php echo (isset($territory['TTYName'])) ? $territory['TTYName'] : '' ?>"
                                               required placeholder="Territory Name">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($territory) && !empty($territory)) ? 'Update' : 'Add' ?>
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
                                    <th>Business</th>
                                    <th>TTY Code</th>                            
                                    <th>Territory Name</th>                                    
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

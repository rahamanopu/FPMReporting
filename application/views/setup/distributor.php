<!-- Section  -->
<section id="main-content">
    
    <div>
        <!-- BOXES -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>Distributor List</strong>
                        <a href="<?php echo base_url().'setup/distributor-add'?>" class="btn btn-danger btn-sm" style="float: right;">Add Distributor</a>
                    </div>
                    <?php echo getFlashMsg(); ?>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Edit</th>                                    
                                    <th>Business Name</th>
                                    <th>TTY Name</th>                            
                                    <th>Distributor Code</th>
                                    <th>Distributor Name</th>                                   
                                    
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

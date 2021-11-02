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
                        <strong>Product List</strong>
                        <a href="<?php echo base_url().'setup/product-add'?>" class="btn btn-danger btn-sm" style="float: right;">Add Product</a>
                    </div>
                    <?php echo getFlashMsg(); ?>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Product Code</th>
                                    <th>SMS CODE</th>
                                    <th>Product Name</th>
                                    <th>Capacity</th>
                                    <th>Brand Code</th>
                                    <th>Unit Price</th>
                                    <th>VAT</th>
                                    <th>MRP</th>
                                    <th>Brand Name</th>
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
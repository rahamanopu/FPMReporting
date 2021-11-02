<link href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>

<!-- Section  -->
<section id="main-content">
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title"><?php echo $pagetitel; ?></h3>
    </div>

    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading panel-heading-transparent" style="text-align: right">
                    <a href="<?php echo base_url(); ?>learning/document-category" class="btn btn-primary" style="font-size: 11px"><i class="fa fa-arrow-left"></i>Back</a>
                </div>

                <div class="panel-body">
                    <form action="<?php echo base_url(); ?>learning/document-category-store" method="post" enctype="multipart/form-data">
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Business</lable>
                                <select name="Business" id="Business" class="form-control" required>
                                    <option value="">Select Business</option>
                                    <?php
                                        foreach ($Business as $row){
                                    ?>
                                    <option value="<?php echo $row['Business'];?>"><?php echo $row['BusinessName'];?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Category Name</lable>
                                <input type="text" class="form-control" name="CategoryName" id="CategoryName" value="" autocomplete="off" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Category Icon</lable>
                                <input type="file" class="form-control" name="file" id="file" value="" autocomplete="off" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Active Status</lable>
                                <select name="ActiveStatus" id="ActiveStatus" class="form-control" required>
                                    <option value="Y">Active</option>
                                    <option value="N">InActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <br>
                                <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block"><i class="fa fa-send-o"></i>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>assets/js/usermanager.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

</script>

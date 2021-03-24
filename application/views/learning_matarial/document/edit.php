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
                    <a href="<?php echo base_url(); ?>learning/document" class="btn btn-primary" style="font-size: 11px"><i class="fa fa-arrow-left"></i>Back</a>
                </div>

                <div class="panel-body">
                    <form action="<?php echo base_url(); ?>learning/document-update/<?php echo $document[0]['DocumentID']; ?>" method="post" enctype="multipart/form-data">
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Business</lable>
                                <select name="Business" id="Business" class="form-control" required>
                                    <option value="">Select Business</option>
                                    <?php
                                        foreach ($Business as $row){
                                    ?>

                                    <option <?php if ($document[0]['Business'] == $row['Business']) {
                                        echo "selected";
                                    } ?> value="<?php echo $row['Business'];?>"><?php echo $row['BusinessName'];?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Category</lable>
                                <select name="DocumentCategoryID" id="DocumentCategoryID" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($document_category as $row){
                                        ?>
                                        <option <?php if ($document[0]['DocumentCategoryID'] == $row['DocumentCategoryID']) {
                                            echo "selected";
                                        } ?> value="<?php echo $row['DocumentCategoryID'];?>"><?php echo $row['CategoryName'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Document Title</lable>
                                <input type="text" class="form-control" name="DocumentTitle" id="DocumentTitle" value="<?php echo $document[0]['DocumentTitle']; ?>" autocomplete="off" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Document File</lable>
                                <input type="file" class="form-control" name="file" id="file" value="" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Document Description</lable>
                                <textarea name="DocumentDescription" class="form-control" id="" required><?php echo $document[0]['DocumentDescription']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <lable>Active Status</lable>
                                <select name="ActiveStatus" id="ActiveStatus" class="form-control" required>
                                    <?php
                                        if ($document[0]['ActiveStatus'] == "Y") {
                                    ?>
                                            <option value="Y" selected>Active</option>
                                            <option value="N">InActive</option>
                                    <?php
                                        }else{
                                    ?>
                                            <option value="Y">Active</option>
                                            <option value="N" selected>InActive</option>
                                    <?php
                                        }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <br>
                                <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block"><i class="fa fa-send-o"></i> Submit</button>
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

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
                    <a href="<?php echo base_url(); ?>learning/document-create" class="btn btn-primary" style="font-size: 11px"><i class="fa fa-plus"></i>Add Document</a>
                </div>

                <div class="panel-body table-responsive">
                    <fieldset>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Business</th>
                                <th>Category Name</th>
                                <th>Document Title</th>
                                <th>Document File Name</th>
                                <th>Total User</th>
                                <th>Total View</th>
                                <th>Active Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($document)) {
                                $count = 0;
                                foreach ($document AS $row) {
                                    $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['Business']; ?></td>
                                        <td><?php echo $row['CategoryName']; ?></td>
                                        <td><?php echo $row['DocumentTitle']; ?></td>
                                        <td><?php echo $row['DocumentFileName']; ?> <span class="badge badge-success"><a href="<?php echo base_url(); ?>uploads/images/<?php echo $row['DocumentFileName']; ?>" target="_blank">Show</a></span></td>
                                        <td><?php echo $row['TotalUser']; ?></td>
                                        <td><?php echo $row['TotalView']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['ActiveStatus'] == 'Y') {
                                            ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php
                                            }else{
                                            ?>
                                                <span class="badge badge-danger">Active</span>
                                                    <?php
                                            }
                                                ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>learning/document-edit/<?php echo $row['DocumentID']; ?>"
                                               title="Edit" data-toggle="tooltip">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>assets/js/usermanager.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

</script>

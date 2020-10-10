<!-- Section  -->
<section id="main-content">
    <div class="content-title">
        <h3 class="main-title">Tree Management</h3>
    </div>
    <?php
    echo getFlashMsg();
    ?>
    <div>
        <!-- BOXES -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong><?php echo ucfirst($level)?></strong>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary" href="<?php echo base_url().'setup/add-level/'.$level?>">Add <?php echo ucfirst($level);?></a>
                            </div>
                            <div class="btn-group" role="group">
                                <a class="btn <?php echo ($level=='level4') ? 'btn-success' : 'btn-default';?>" href="<?php echo base_url().'setup/view-level/level4'?>">Level4</a>
                                <a class="btn <?php echo ($level=='level3') ? 'btn-success' : 'btn-default';?>" href="<?php echo base_url().'setup/view-level/level3'?>">Level3</a>
                                <a class="btn <?php echo ($level=='level2') ? 'btn-success' : 'btn-default';?>" href="<?php echo base_url().'setup/view-level/level2'?>">Level2</a>
                                <a class="btn <?php echo ($level=='level1') ? 'btn-success' : 'btn-default';?>" href="<?php echo base_url().'setup/view-level/level1'?>">Level1</a>
                            </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Name</th>
                                    <th>Base</th>
                                    <th>Designation</th>
                                    <th>Staff Id</th>
                                    <th>Mobile</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($level_info_list)) {
                                    $count = 0;
                                    foreach ($level_info_list AS $level_info) {
                                        $count++;
                                        ?>
                                        <tr>
                                            <td><?php echo $level_info[ucfirst($level)]; ?></td>
                                            <td><?php echo $level_info[ucfirst($level).'Name']; ?></td>
                                            <td><?php echo $level_info['Base']; ?></td>
                                            <td><?php echo $level_info['Designation']; ?></td>
                                            <td><?php echo $level_info['StaffId']; ?></td>
                                            <td><?php echo $level_info['MobileNo']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url().'setup/add-level/'.$level.'/'.$level_info[ucfirst($level)] ?>"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<link href="--><?php //echo base_url(); ?><!--assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>-->

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
                        <strong><?php echo $pageTitle; ?></strong>
                    </div>

                    <div class="panel-body">
                        <div class="col-md-10">
                            <form class="form-horizontal" action="<?php echo base_url() ?>setup/store-level"
                                  method="post">
                                <input type="hidden" name="level" value="<?php echo $level; ?>">
                                <input type="hidden" name="supervisorLevel" value="<?php echo $supervisorLevel; ?>">
                                <input type="hidden" name="isEdit" value="<?php echo $isEdit; ?>">
                                <input type="hidden" name="levelId" value="<?php echo !empty($levelInfo) ? $levelInfo[ucfirst($level)] : ''; ?>">
                                <div class="form-group">
                                    <label for="staffId" class="col-sm-4 control-label">Staff Id</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="staffId" class="form-control" id="staffId" value="<?php echo !empty($levelInfo) ? $levelInfo['StaffId'] : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fullName" class="col-sm-4 control-label">Full Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="fullName" class="form-control" id="fullName" value="<?php echo !empty($levelInfo) ? $levelInfo[ucfirst($level).'Name'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="base" class="col-sm-4 control-label">Base</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="base" class="form-control" id="base" value="<?php echo !empty($levelInfo) ? $levelInfo['Base'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Designation</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="designation" class="form-control" id="designation" value="<?php echo !empty($levelInfo) ? $levelInfo['Designation'] : ''; ?>">
<!--                                        <select class="form-control" name="designation">-->
<!--                                            --><?php //if (isset($designations) && !empty($designations)) {
//                                                foreach ($designations as $designation) {
//                                                    ?>
<!--                                                    <option value="--><?php //echo $designation['DesignationId']; ?><!--">--><?php //echo $designation['DesignationName']; ?><!--</option>-->
<!--                                                    --><?php
//                                                }
//                                            } ?>
<!--                                        </select>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="business" class="col-sm-4 control-label">Business</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="business" required>
                                            <option value="">-- Select--</option>
                                            <?php if (isset($businesses) && !empty($businesses)) {
                                                foreach ($businesses as $business) {
                                                    ?>
                                                    <option value="<?php echo $business['Business']; ?>"
                                                        <?php echo !empty($levelInfo && $levelInfo['Business'] == $business['Business']) ? 'selected' : ''; ?>
                                                    ><?php echo $business['BusinessName']; ?></option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="business" class="col-sm-4 control-label">Department</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="department" required>
                                            <option value="">-- Select--</option>
                                            <?php if (isset($departments) && !empty($departments)) {
                                                foreach ($departments as $department) {
                                                    ?>
                                                    <option value="<?php echo $department['DepartmentID']; ?>"
                                                        <?php echo !empty($levelInfo && $levelInfo['DepartmentID'] == $department['DepartmentID']) ? 'selected' : ''; ?>
                                                    ><?php echo $department['DepartmentName']; ?></option>
                                                    <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if($level !='level4') {
                                    ?>
                                    <div class="form-group">
                                        <label for="supervisor" class="col-sm-4 control-label">Supervisor</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="supervisor" required>
                                                <option value="">-- Select--</option>
                                                <?php if (isset($supervisors) && !empty($supervisors)) {
                                                    foreach ($supervisors as $supervisor) {
                                                        ?>
                                                        <option value="<?php echo $supervisor[$supervisorLevel]; ?>"
                                                            <?php echo !empty($levelInfo && $levelInfo[$supervisorLevel] == $supervisor[$supervisorLevel]) ? 'selected' : ''; ?>
                                                        ><?php echo $supervisor[$supervisorLevel.'Name']; ?></option>
                                                        <?php
                                                    }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php
                                }?>
                                <div class="form-group">
                                    <label for="mobileNo" class="col-sm-4 control-label">Mobile</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="mobileNo" class="form-control" id="mobileNo"
                                               value="<?php echo !empty($levelInfo) ? $levelInfo['MobileNo'] : ''; ?>"
                                               minlength="11" maxlength="11" required
                                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="emailAddress" class="col-sm-4 control-label">Email Address</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="emailAddress" class="form-control" id="emailAddress"
                                               value="<?php echo !empty($levelInfo) ? $levelInfo['EmailAddress'] : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="active" class="col-sm-4 control-label">Active Status</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="active" required>
                                            <option value="Y" <?php echo (!empty($levelInfo) && $levelInfo['Active'] =='Y')? 'selected' : ''; ?>>Yes</option>
                                            <option value="N" <?php echo (!empty($levelInfo) && $levelInfo['Active'] =='N')? 'selected' : ''; ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div  class="clearfix"></div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block"><i class="fa fa-send-o"></i> <?php echo $isEdit ? 'Update' : 'Submit'; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/bootstrap-multiselect.js"></script>-->

<script type="text/javascript">
    $(document).ready(function () {
        // Form validation
        $("form").validate({
            // Specify validation rules
            rules: {
            },
            // Specify validation error messages
            messages: {
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

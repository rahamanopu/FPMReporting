<script type="text/javascript">
    //var base_url = '<?php //echo base_url(); ?>//';
</script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css"/>

<!-- Section  -->
<section id="main-content">
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title">User entry</h3>
    </div>
    <?php
    echo getFlashMsg();
    ?>
    <div id="content" class="dashboard">
        <!-- BOXES -->
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">
                    <fieldset>
                        <form action="<?php echo base_url(); ?>usermanager/docreate"
                              method="post">

                            <div class="col-md-12 form-group" style="text-align: center; font-size: 16px; color: black;
                            text-decoration: underline; font-weight: bold;">
                                User Details
                                <hr/>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    User Id
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control"
                                           name="userid"
                                           id="userid"
                                           value="<?php if (!empty($userdata)) {
                                               echo $userdata[0]['UserId'];
                                           } ?>"
                                           autocomplete="off" maxlength="10" required=""
                                        <?php if (!empty($userdata)) { ?> readonly="" <?php } ?>
                                    >
                                    <span id="errormsg" class="text-danger margin-bottom-0"></span>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    Staff Id
                                </div>
                                <div class="col-md-8">
                                    <input type="text"
                                           name="staffid"
                                           id="staffid"
                                           value="<?php if (!empty($userdata)) {
                                               echo $userdata[0]['StaffID'];
                                           } ?>"
                                           autocomplete="off"
                                           maxlength="10"
                                           class="form-control" required="">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    Password
                                </div>
                                <div class="col-md-8">
                                    <input type="text"
                                           name="password"
                                           id="password"
                                           value="<?php if (!empty($userdata)) {
                                               echo decrypt_password($userdata[0]['Password']);
                                           } ?>"
                                           autocomplete="off"
                                           maxlength="30" minlength="3"
                                           class="form-control" required="">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    Confirm Password
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="confirmpassword"
                                           id="confirmpassword"
                                           value="<?php if (!empty($userdata)) {
                                               echo decrypt_password($userdata[0]['Password']);
                                           } ?>"
                                           autocomplete="off" maxlength="30" minlength="3"
                                           class="form-control" required="" data-rule-equalTo="#password">
                                </div>
                            </div>


                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    User Name
                                </div>
                                <div class="col-md-8">
                                    <input type="text"
                                           name="username"
                                           id="username"
                                           value="<?php if (!empty($userdata)) {
                                               echo $userdata[0]['UserName'];
                                           } ?>"
                                           autocomplete="off"
                                           maxlength="150"
                                           class="form-control" required="">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    Designation
                                </div>
                                <div class="col-md-8">
                                    <input type="text"
                                           name="designation" id="designation" value="<?php if (!empty($userdata)) {
                                        echo $userdata[0]['Designation'];
                                    } ?>"
                                           autocomplete="off"
                                           maxlength="250"
                                           class="form-control" required="">
                                </div>
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    User Level
                                </div>
                                <div class="col-md-8">
                                    <input type="text"
                                           name="userLevel"
                                           id="userLevel"
                                           value="<?php if (!empty($userdata)) {
                                               echo $userdata[0]['UserLevel'];
                                           } ?>"
                                           autocomplete="off"
                                           maxlength="250"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    Level Code
                                </div>
                                <div class="col-md-8">
                                    <input type="text"
                                           name="levelCode"
                                           id="levelCode"
                                           value="<?php if (!empty($userdata)) {
                                               echo $userdata[0]['LevelCode'];
                                           } ?>"
                                           autocomplete="off"
                                           maxlength="250"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    User Type
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="userType" id="userType" required>
                                        <?php if (isset($userTypeList) && !empty($userTypeList)) {
                                            foreach ($userTypeList as $userType) {
                                                ?>
                                                <option value="<?php echo $userType['UserTypeID']; ?>"
                                                    <?php echo (!empty($userdata) && ($userdata[0]['UserType'] == $userType['UserTypeID'])) ? 'selected' : '' ?>
                                                ><?php echo $userType['UserTypeName']; ?></option>
                                                <?php
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- UserBusiness -->
                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    User Business
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control bs-multiselect" name="userBusines[]" id="userBusines" multiple>
                                        <?php if (isset($businessList) && !empty($businessList)) {
                                            foreach ($businessList as $business) {
                                                ?>
                                                <option value="<?php echo $business['Business']; ?>"
                                                    <?php echo (!empty($userBusinessCodes) && in_array($business['Business'],$userBusinessCodes)) ? "selected" : "";?>
                                                ><?php echo $business['BusinessName']; ?></option>
                                                <?php
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <div class="col-md-4">
                                    Active Status
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="active" id="active" required>
                                        <option
                                            <?php if (!empty($userdata) && $userdata[0]['Active'] == 'Y') { ?> selected="selected" <?php } ?>
                                                value="Y">Active
                                        </option>
                                        <option
                                            <?php if (!empty($userdata) && $userdata[0]['Active'] == 'N') { ?> selected="selected" <?php } ?>
                                                value="N">Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 form-group" style="text-align: center; font-size: 16px; color: black;
                            text-decoration: underline; font-weight: bold; margin-top: 35px;">
                                Access Details
                                <hr/>
                            </div>


                            <?php
                            $result = array();
                            foreach ($menulist as $element) {
                                $result[$element['ParentMenuName']][] = $element;
                            }
                            ?>
                            <?php
                            $count = 0;
                            foreach ($result as $menudata) {
                                $count++;# code...

                                ?>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <?php echo $menudata[0]['ParentMenuName']; ?>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="bs-multiselect form-control" name="usermenu[]"
                                                id="usermenu<?php echo $count; ?>" multiple="multiple">
                                            <?php if (!empty($menudata)) { ?>
                                                <?php foreach ($menudata as $row) { ?>
                                                    <option
                                                        <?php if ($row['Selected'] != '') { ?> selected="selected" <?php } ?>
                                                            value="<?php echo $row['MenuId']; ?>"><?php echo $row['ParentMenuName']; ?>
                                                        - <?php echo $row['MenuName']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>


                            <div  class="clearfix"></div>
                            <div class="col-md-6 form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block"><i class="fa fa-send-o"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>


    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>User List</strong>
                </div>

                <div class="panel-body table-responsive">
                    <fieldset>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>User Id</th>
                                <th>Staff Id</th>
                                <th>User Name</th>
                                <th>Designation</th>
                                <th>Active Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($userlist)) {
                                $count = 0;
                                foreach ($userlist AS $row) {
                                    $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['UserId']; ?></td>
                                        <td><?php echo $row['StaffId']; ?></td>
                                        <td><?php echo $row['UserName']; ?></td>
                                        <td><?php echo $row['Designation']; ?></td>
                                        <td><?php echo $row['ActiveStatus']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>usermanager/index/<?php echo $row['UserId']; ?>"
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

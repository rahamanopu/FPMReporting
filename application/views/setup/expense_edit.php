<!-- Section  -->
<section id="main-content">    
    <div>
        <!-- BOXES -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong><?php echo isset($pageTitel) ? $pageTitel : ''?></strong>
                    </div>
                    <?php echo getFlashMsg(); ?>
                    <div class="panel-body">
                        <form class="form-horizontal" action="<?php echo base_url().$action ?>" method="post">
                            <input type="hidden" name="ExpenseId"
                                   value="<?php echo (isset($expense) && !empty($expense)) ? $expense['ExpenseId'] : '' ?>">
                            <input type="hidden" name="ExpenseDetailsID"
                            value="<?php echo (isset($expense) && !empty($expense)) ? $expense['ExpenseDetailsID'] : '' ?>">
                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="control-label col-sm-4">Plan Type: </label>
                                    <div class="col-sm-8">
                                    <label for="Category" class="control-label col-sm-4 text-primary"><b><?php echo $expense['Category'] ?></b></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SubCategory" class="control-label col-sm-4">Type: </label>
                                    <div class="col-sm-8">
                                    <label for="SubCategory" class="control-label col-sm-4 text-primary"><b><?php echo $expense['SubCategory'] ?></b></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="EmpName" class="control-label col-sm-4">Employee Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="EmpName" id="EmpName"
                                               class="form-control"
                                               value="<?php echo (isset($expense['EmpName'])) ? $expense['EmpName'] : '' ?>"
                                               required placeholder="Employee Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="UserLevel" class="control-label col-sm-4">User Level</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="UserLevel" id="UserLevel" class="form-control"
                                               value="<?php echo (isset($expense['UserLevel'])) ? $expense['UserLevel'] : '' ?>"
                                               required placeholder="UserLevel">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="LevelCode" class="control-label col-sm-4">Level Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="LevelCode" id="LevelCode" class="form-control"
                                               value="<?php echo (isset($expense['LevelCode'])) ? $expense['LevelCode'] : '' ?>"
                                               required placeholder="LevelCode">
                                    </div>
                                </div>
                            </div>                            
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ExpenseDate" class="control-label col-sm-4">Expense Date</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="ExpenseDate" id="ExpenseDate" class="form-control datePicker"
                                                value="<?php echo (isset($expense['ExpenseDate'])) ? date('Y-m-d',strtotime($expense['ExpenseDate'])) : '' ?>"
                                                required placeholder="ExpenseDate">
                                        </div>
                                    </div>
                                </div>
                            <?php if($expense['SubCategory'] == 'DA') {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DAExpType" class="control-label col-sm-4">Daily Expense Type</label>
                                        <div class="col-sm-8">
                                            <select name="DAExpType" class="form-control" require>
                                                <option value="">Select</option>
                                                <option value="Breakfast" <?php echo (strtolower($expense['DAExpType'])=='breakfast') ? 'selected' : '' ?>>Breakfast</option>
                                                <option value="Lunch"  <?php echo (strtolower($expense['DAExpType'])=='lunch') ? 'selected' : '' ?>>Lunch</option>
                                                <option value="Dinner"  <?php echo (strtolower($expense['DAExpType'])=='dinner') ? 'selected' : '' ?>>Dinner</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DistributorCode" class="control-label col-sm-4">Distributor</label>
                                        <div class="col-sm-8">
                                            <select name="DistributorCode" class="form-control" require>
                                                <?php foreach($distributors as $distributor) {
                                                    ?>
                                                    <option value="<?php echo $distributor['DistributorCode']?>" <?php echo ($expense['DistributorCode']==$distributor['DistributorCode']) ? 'selected' : '' ?>><?php echo $distributor['DistributorName']?></option>
                                                    <?php
                                                }?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Place" class="control-label col-sm-4">Place</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="Place" id="Place" class="form-control"
                                                value="<?php echo (isset($expense['Place'])) ? $expense['Place'] : '' ?>"
                                                required placeholder="Place">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="TypeOfWork" class="control-label col-sm-4">Type Of Work</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="TypeOfWork" id="TypeOfWork" class="form-control"
                                                value="<?php echo (isset($expense['TypeOfWork'])) ? $expense['TypeOfWork'] : '' ?>"
                                                 placeholder="Type Of Work">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="StartDate" class="control-label col-sm-4">Start Time</label>
                                        <div class="col-sm-8">
                                            <input type="time" name="StartDate" id="StartDate" class="form-control"
                                                value="<?php echo (isset($expense['StartDate'])) ? date('H:i',strtotime($expense['StartDate'])) : '' ?>"
                                                 placeholder="Start Time">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="EndDate" class="control-label col-sm-4">End Time</label>
                                        <div class="col-sm-8">
                                            <input type="time" name="EndDate" id="StartDate" class="form-control"
                                                value="<?php echo (isset($expense['EndDate'])) ? date('H:i',strtotime($expense['EndDate'])) : '' ?>"
                                                 placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Amount" class="control-label col-sm-4">Amount</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="Amount" id="Amount" class="form-control"
                                                value="<?php echo (isset($expense['Amount'])) ? $expense['Amount'] : '' ?>"
                                                required placeholder="Amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="SeniorNameVisitedWith" class="control-label col-sm-4">Senior Name & Id</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="SeniorNameVisitedWith" id="SeniorNameVisitedWith" class="form-control"
                                                value="<?php echo (isset($expense['SeniorNameVisitedWith'])) ? $expense['SeniorNameVisitedWith'] : '' ?>"
                                                placeholder="Senior Name & ID Visited With">
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } else if($expense['SubCategory'] == 'TA') {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="LocationFrom" class="control-label col-sm-4">Location From</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="LocationFrom" id="LocationFrom" class="form-control"
                                                value="<?php echo (isset($expense['LocationFrom'])) ? $expense['LocationFrom'] : '' ?>"
                                                required placeholder="Location From">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="LocationTo" class="control-label col-sm-4">Location To</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="LocationTo" id="LocationTo" class="form-control"
                                                   value="<?php echo (isset($expense['LocationTo'])) ? $expense['LocationTo'] : '' ?>"
                                                   required placeholder="Location To">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ExpseneTransportID" class="control-label col-sm-4">Transport</label>
                                        <div class="col-sm-8">
                                            <select name="ExpseneTransportID" class="form-control" require>
                                                <?php foreach($expenseTransports as $expenseTransport) {
                                                    ?>
                                                    <option value="<?php echo $expenseTransport['ExpseneTransportName']?>" <?php echo ($expense['ExpseneTransportID']==$expenseTransport['ExpseneTransportName']) ? 'selected' : '' ?>><?php echo $expenseTransport['ExpseneTransportName']?></option>
                                                    <?php
                                                }?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="PurposeOfTransport" class="control-label col-sm-4">Purpose Of Transport</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="PurposeOfTransport" id="PurposeOfTransport" class="form-control"
                                                value="<?php echo (isset($expense['PurposeOfTransport'])) ? $expense['PurposeOfTransport'] : '' ?>"
                                                placeholder="Purpose Of Transport">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ContactPersonName" class="control-label col-sm-4">Contact Person Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="ContactPersonName" id="ContactPersonName" class="form-control"
                                                value="<?php echo (isset($expense['ContactPersonName'])) ? $expense['ContactPersonName'] : '' ?>"
                                                placeholder="Contact Person Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ContactPersonMobile" class="control-label col-sm-4">Contact Person Mobile</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="ContactPersonMobile" id="ContactPersonMobile" class="form-control"
                                                value="<?php echo (isset($expense['ContactPersonMobile'])) ? $expense['ContactPersonMobile'] : '' ?>"
                                                placeholder="Contact Person Mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Amount" class="control-label col-sm-4">Amount</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="Amount" id="Amount" class="form-control"
                                                value="<?php echo (isset($expense['Amount'])) ? $expense['Amount'] : '' ?>"
                                                required placeholder="Amount">
                                        </div>
                                    </div>
                                </div>

                                <?php

                            } else if($expense['SubCategory'] == 'Accommodation Cost') {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="HotelName" class="control-label col-sm-4">Hotel Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="HotelName" id="HotelName" class="form-control"
                                                value="<?php echo (isset($expense['HotelName'])) ? $expense['HotelName'] : '' ?>"
                                                placeholder="Hotel Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="HotelPlace" class="control-label col-sm-4">Hotel Place</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="HotelPlace" id="HotelPlace" class="form-control"
                                                value="<?php echo (isset($expense['HotelPlace'])) ? $expense['HotelPlace'] : '' ?>"
                                                placeholder="Hotel Place">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="NightStatyFrom" class="control-label col-sm-4">Night Stay From</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="NightStatyFrom" id="NightStatyFrom" class="form-control datePicker"
                                                value="<?php echo (isset($expense['NightStatyFrom'])) ? date('Y-m-d',strtotime($expense['NightStatyFrom'])) : '' ?>"
                                                required placeholder="Night Stay From">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="NightStayTo" class="control-label col-sm-4">Night Stay To</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="NightStayTo" id="NightStayTo" class="form-control datePicker"
                                                value="<?php echo (isset($expense['NightStayTo'])) ? date('Y-m-d', strtotime($expense['NightStayTo'])) : '' ?>"
                                                required placeholder="Night Stay To">
                                        </div>
                                    </div>
                                </div>                               


                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Amount" class="control-label col-sm-4">Amount</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="Amount" id="Amount" class="form-control"
                                                value="<?php echo (isset($expense['Amount'])) ? $expense['Amount'] : '' ?>"
                                                required placeholder="Amount">
                                        </div>
                                    </div>
                                </div>


                                <?php

                            }else if(in_array($expense['SubCategory'],['PhotoCopy','Courier Bill','Print','Other'])) {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Purpose" class="control-label col-sm-4">Purpose</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="Purpose" id="Purpose" class="form-control"
                                                value="<?php echo (isset($expense['Purpose'])) ? $expense['Purpose'] : '' ?>"
                                                placeholder="Purpose">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Amount" class="control-label col-sm-4">Amount</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="Amount" id="Amount" class="form-control"
                                                value="<?php echo (isset($expense['Amount'])) ? $expense['Amount'] : '' ?>"
                                                required placeholder="Amount">
                                        </div>
                                    </div>
                                </div>

                                <?php

                            }?>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="HotelPlace" class="control-label col-sm-4">Remarks</label>
                                    <div class="col-sm-8">
                                        <textarea  name="Remarks" id="Remarks" class="form-control" cols="10" placeholder="Enter Remarks Here"><?php echo (isset($expense['Remarks'])) ? $expense['Remarks'] : '' ?></textarea>

                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                    class="fa fa-send-o"></i> <?php echo (isset($expense) && !empty($expense)) ? 'Update' : 'Add' ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        // Form validation
        $("form").validate({
            // Specify validation rules
            rules: {},
            // Specify validation error messages
            messages: {},
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
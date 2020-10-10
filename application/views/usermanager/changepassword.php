<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/changepassword.js"></script>
 

<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title">Change Password</h3>                
    </div>
    
    <?php if(!empty($this->session->flashdata('msgtype')) and $this->session->flashdata('msgtype') == 'success'){ ?>
        <div class="alert alert-success noborder text-center weight-400 nomargin noradius">
            <?php echo $this->session->flashdata('insertmsg'); ?>
        </div>
    <?php } ?>
    <?php if(!empty($this->session->flashdata('msgtype')) and $this->session->flashdata('msgtype') == 'error'){ ?>
        <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
            <?php echo $this->session->flashdata('insertmsg'); ?>
        </div>
    <?php } ?>
     
    
    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>Password information</strong>
                </div> 
                
                <div class="panel-body">
                    <fieldset>
                        <form action="<?php echo base_url(); ?>usermanager/dochangepassword" 
                                method="post" onsubmit="return changepassword();">
                              
                            
                            <div class="col-md-12 form-group">
                                <div class="col-md-2">
                                    <font color="red">*</font> Current Password
                                </div>
                                <div class="col-md-8">                                     
                                    <input type="password" 
                                        name="currentpassword" 
                                        id="currentpassword" 
                                        value=""
                                        autocomplete="off"
                                        maxlength="150"
                                        class="form-control" required="">
                                </div>
                            </div>
                             
                            <div class="col-md-12 form-group">
                                <div class="col-md-2">
                                    <font color="red">*</font> New Password
                                </div>
                                <div class="col-md-8">                                     
                                    <input type="password" 
                                        name="newpassword" 
                                        id="newpassword" 
                                        value=""
                                        autocomplete="off"
                                        maxlength="150"
                                        class="form-control" required="">
                                </div>
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <div class="col-md-2">
                                    <font color="red">*</font> Confirm Password
                                </div>
                                <div class="col-md-8">                                     
                                    <input type="password" 
                                        name="confirmpassword" 
                                        id="confirmpassword" 
                                        value=""
                                        autocomplete="off"
                                        maxlength="150"
                                        class="form-control" required="">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12 form-group">
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-8">
                                    <input type="submit" value="Submit" id="submit"
                                        name="submit" class="btn btn-primary">  
                                </div>
                            </div>
                            
                             
                                   
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>   
            
</section>

 
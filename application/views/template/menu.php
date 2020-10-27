<?php
$userid = $this->session->userdata('userid');
$usermenu = unserialize(file_get_contents("assets/temp/usermenu_" . $userid . ".tmp"));
$segment = $this->uri->segment(1); 
$segment2 = $this->uri->segment(2);
$subMenuLink = $segment2 ? ($segment."/".$segment2) : $segment
?>
<aside id="sarah-left-panel" sarah-position-type="absolute">
<div class="profile-box">
    <div class="media">                          
        <div class="media-body">
            <h4 class="media-heading">Welcome <?php echo $this->session->userdata('emp_name'); ?></h4>
            <small><?php echo $this->session->userdata('designation'); ?></small>
        </div>
    </div>
</div>
<ul class="nav panel-list">
    <li class="nav-level">Navigation</li>
    <li <?php if($segment == ''){ ?>class="active" <?php } ?>>
        <a href="<?php echo base_url(); ?>">
            <i class="fa fa-tachometer"></i>
            <span class="menu-text">Dashboard</span>
            <span class="selected"></span>
        </a>
    </li>  
    

    <?php 
    //var_dump($usermenu);
    function filtersubmenu($val){
        global $menuname;
        if($val['MenuName'] == $menuname){
            return true;
        }else{
            return false;
        }
    }
    global $menuname;    
    if(!empty($usermenu)){
        foreach($usermenu as $row){ 
            if($menuname != $row['MenuName']){     
                $menuname = $row['MenuName'];
                $submenu = array_filter($usermenu,"filtersubmenu");
            ?>
            <li class="sarah-has-menu <?php if($segment == trim($row['MenuActiveLink'])){ ?> active <?php } ?>">
                <a href="javascript:void(0)">
                    <i class="fa fa-pencil-square-o"></i>
                    <span class="menu-text"><?php echo $row['MenuName']; ?></span>
                    <span class="selected"></span>
                </a>
                <ul class="sarah-sub-menu"> 
                    <?php 
                    if(!empty($submenu)){
                        foreach($submenu as $row1){
                            ?>
                            <li <?php if($subMenuLink == $row1['Link']){ ?>class="active" <?php } ?>>
                                <a href="<?php echo base_url().$row1['Link']; ?>">
                                    <span class="menu-text"><?php echo $row1['SubMenuName']; ?></span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    
                </ul>
            </li>
            <?php                
            }
        }
    }
    ?>
    
    <li class="sarah-has-menu <?php if($segment == 'report'){ ?> active <?php } ?>">
        <a href="javascript:void(0)">
            <i class="fa fa-sitemap"></i>
            <span class="menu-text">Report</span>
            <span class="selected"></span>
        </a>
        <ul class="sarah-sub-menu">
            <li <?php if($segment2 == 'attendancereport'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/attendancereport">
                    <span class="menu-text">Attendance Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'dailyAttendanceReport'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/dailyAttendanceReport">
                    <span class="menu-text">Daily Attendance Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'tourplan'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/tourplan">
                    <span class="menu-text">Tour Plan Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'distributorStock'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/distributorStock">
                    <span class="menu-text">Distributor Stock Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'distributorCompititorStock'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/distributorCompititorStock">
                    <span class="menu-text">Distributor Compititor Stock</span>
                    <span class="selected"></span>
                </a>
            </li>
             <li <?php if($segment2 == 'distributorExpense'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/distributorExpense">
                    <span class="menu-text">TSI Expense</span>
                    <span class="selected"></span>
                </a>
            </li> 
            <li <?php if($segment2 == 'distributorSecondarySales'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/distributorSecondarySales">
                    <span class="menu-text">Distibutor Sales Projection</span>
                    <span class="selected"></span>
                </a>
            </li> 
            <li <?php if($segment2 == 'distributorSecondarySalesProjection'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/distributorSecondarySalesProjection">
                    <span class="menu-text">Distibutor Secoundary Sales Projection</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'distributorAndRetailerLocation'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/distributorAndRetailerLocation">
                    <span class="menu-text">Distibutor and Retailer Location</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'userCurrentLocation'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/userCurrentLocation">
                    <span class="menu-text">Users Current Location</span>
                    <span class="selected"></span>
                </a>
            </li> 
            <li <?php if($segment2 == 'retailerStock'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/retailerStock">
                    <span class="menu-text">Retailer Stock Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'retailerCompititorStock'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/retailerCompititorStock">
                    <span class="menu-text">Retailer Comptititor Stock Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'retailers'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/retailers">
                    <span class="menu-text">Retailer List</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li <?php if($segment2 == 'retailerOrder'){ ?>class="active" <?php } ?>>
                <a href="<?php echo base_url(); ?>report/retailerOrder">
                    <span class="menu-text">Retailer Order</span>
                    <span class="selected"></span>
                </a>
            </li>

        </ul>
    </li>

    <li>
        <a href="<?php echo base_url(); ?>authenticate/logout">
            <i class="fa fa-sign-out"></i>
            <span class="menu-text">Log Out</span>
            <span class="selected"></span>
        </a>
    </li>

</ul>
</aside>
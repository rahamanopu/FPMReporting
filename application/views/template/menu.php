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

    <li>
        <a href="<?php echo base_url(); ?>authenticate/logout">
            <i class="fa fa-sign-out"></i>
            <span class="menu-text">Log Out</span>
            <span class="selected"></span>
        </a>
    </li>

</ul>
</aside>
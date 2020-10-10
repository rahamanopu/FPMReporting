<header id="sarah-header" sarah-lpanel-effect="shrink">
    <div class="sarah-left-header">
        <a href="#"><i class="fa fa-users"></i> <span><?php echo $this->config->item('softwarename'); ?></span></a>
        <span class="sarah-sidebar-toggle"><a href="#"></a></span>
    </div>

    <div class="sarah-right-header" sarah-position-type="relative" >
        <span class="sarah-sidebar-toggle"><a href="#"></a></span>
        <ul class="left-navbar">
        </ul>  
    </div>
    <input type="hidden" name="ajaxDataLoadUrl" id="ajaxDataLoadUrl" value="<?php echo isset($ajaxDataLoadUrl) ?  $ajaxDataLoadUrl : '';?>">
    <input type="hidden" name="ajaxDataLimit" id="ajaxDataLimit" value="<?php echo isset($ajaxDataLimit) ?  $ajaxDataLimit : '';?>">
</header>
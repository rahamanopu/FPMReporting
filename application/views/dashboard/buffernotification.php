<!-- Feedback Box -->
<?php if(!empty($business)){ ?>
<!--for balck-->
<?php loadcategorydetails('box warning', 'Re-Size Buffer Upward &uarr;', $blackzone, $datefrom, $dateto , 'black', 'white'); ?>
<!--for balck-->

<!--for red-->
<?php loadcategorydetails('box danger', 'Re-Size Buffer Upward  &uarr;', $redzone, $datefrom, $dateto, 'red', 'white'); ?>
<!--for red-->

<!--for green-->
<?php loadcategorydetails('box success', 'Re-Size Buffer Downward &darr;', $greenzone, $datefrom, $dateto,'green', 'white'); ?>
<!--for green-->

<!--for white-->
<?php loadcategorydetails('box default', 'Re-Size Buffer Downward &darr;', $whitezone, $datefrom, $dateto,'white', 'black'); ?>
<!--for white-->
<?php } ?>

<?php 
function filterbusiness($val){
    global $businessname;
    if($val['Business_Name'] == $businessname){
        return true;
    }
}

function loadcategorydetails($classname, $titel, $zonearray, $datefrom, 
        $dateto, $bgcolor, $fontcolor)
{
    //echo "<pre />"; print_r($zonearray); exit();
    $businesslist = array_values(array_unique(array_column($zonearray, 'Business_Name')));
//echo "<pre />"; print_r($businesslist); exit();
?>
<!--for red-->
    <div class="col-md-3 col-sm-6">
        <!-- BOX -->
        <div style="background-color: <?php echo $bgcolor; ?>; " class="<?php echo $classname; ?>">
            <h4 style="color: <?php echo $fontcolor; ?>; font-weight: bold;" class="text-center"><?php echo $titel; ?></h4>
        </div>            
        <?php 
        for($i = 0; $i < count($businesslist); $i++){ 
            global $businessname;
            if(!empty($businesslist[$i])){
                $businessname = $businesslist[$i];
            }else{
                $businessname = '';
            }
            $locationlist = array_filter($zonearray, "filterbusiness");
            //echo "<pre />"; print_r($locationlist); exit();
            ?>
        <div class="<?php echo $classname; ?>">
            <div class="box-title">
                <div class="col-md-12 text-left">
                    <h4 style="font-weight: bold;">Business : <?php echo $businesslist[$i]; ?></h4>
                    <hr style="margin-top: 5px; margin-bottom: 5px;" />
                </div>                            
                <div class="col-md-12">
                    <ul>
                        <?php 
                        if(!empty($locationlist)){
                            foreach ($locationlist as $location) {
                                ?>
                                <li>
                                    <a target="_blank" href="<?php echo base_url(); ?>dashboard/groupdetails/<?php echo $datefrom; ?>/<?php echo $dateto; ?>/<?php echo $location['Business']; ?>/?alertgroup=<?php echo $location['Alert_Group']; ?>&location=<?php echo $location['Location']; ?>&materialtype=<?php echo $location['MaterialType']; ?>">
                                        <h4><?php echo $location['Total']; ?> - 
                                            <?php echo $location['MaterialType'] . ' - ' . $location['Location']; ?></h4>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                  
                </div>
                <i class="fa fa-globe"></i>
            </div>
        </div>  
        <?php } ?>
    </div>
<!--for red-->
<?php
}
?>

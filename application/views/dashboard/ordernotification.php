<?php
if (!empty($orderbusinesslist)) {
    foreach ($orderbusinesslist as $orderbusiness) {
        ?>
        <div class="col-md-3 col-sm-6">
            <!-- BOX -->
            <div class="box success" style="border: 0px; background-color: #f7f7e1;">
                <h4 class="text-center" style="font-weight: bold;"><?php echo $orderbusiness['BusinessName']; ?></h4>
            </div> 
            <?php
            global $businesscode1;
            $businesscode1 = $orderbusiness['BusinessCode'];
            $filterarray = array_values(array_filter($ordersummery, function ($e) { //print_r($e); exit();
                        global $businesscode1;
                        return $e['Business'] == $businesscode1;
                    }));
            //echo "<pre />"; print_r($filterarray); exit();
            ?>    
            <div class="box success" style="border: 0px; background-color: #f7f7e1;">
                <ul>
                    <?php
                    if (!empty($filterarray)) {
                        foreach ($filterarray as $row) {
                            ?>
                            <li>
                                <a target="_blank" href="<?php echo base_url(); ?>dashboard/orderdetails?businesscode=<?php echo $businesscode; ?>&locationcode=<?php echo $locationcode; ?>&materialtypecode=<?php echo $materialtypecode; ?>&materialcode=<?php echo $materialcode; ?>&selectedbusinesscode=<?php echo $businesscode1; ?>&selectedlocation=<?php echo $row['Location']; ?>&selectedmaterialtype=<?php echo $row['MaterialType']; ?>&asondate=<?php echo $row['ASofDate']; ?>">
                                    <h4><b><?php echo $row['Total']; ?> (<?php echo $row['MaterialType']; ?>) </b> in <?php echo $row['Location']; ?> on <?php echo $row['ASofDate']; ?>
                                    </h4>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>


        <?php
    }
}
?>
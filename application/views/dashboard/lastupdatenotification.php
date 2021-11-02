<?php if(!empty($lastupdate))    { 
    $hader = array_keys($lastupdate[0]);
    //echo "<pre />"; print_r($lastupdate);
    //echo "<pre />"; print_r(array_keys($lastupdate[0])); exit();
    ?>
    <div class="content-title" style="background-color: #f7f7e1;">
        <h3 class="main-title" style="color: black;">Last Update Notification : 
            <font style="font-size: 16px;">
            <?php 
            $string = "";
            foreach($hader as $row){
              $string  .= str_replace("_"," ",$row) . ": " . $lastupdate[0][$row].', ';
            }
            echo substr($string, 0, -2)
            ?>
            </font>  
        </h3>
    </div>
<?php } ?>
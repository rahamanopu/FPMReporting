<style>
hr {
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>
<?php //echo json_encode($rows['valid']); exit(); ?>


<?php
//var_dump($filterdata); exit();
if(!empty($filterdata[0]['BusinessName'])){
    $businessname   = $filterdata[0]['BusinessCode'] . ' - ' .$filterdata[0]['BusinessName'];
    $locationname   = $filterdata[0]['LocationCode'] . ' - ' .$filterdata[0]['Location'];
    $materialtype   = $filterdata[0]['Material_Type'];
}else{
    $businessname   = '';
    $alertname      = '';
    $materialtype   = '';
}
?>
<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h4 class="main-title">Business : <b><?php echo $businessname; ?></b></h4>
        <hr />
        <h4 class="main-title">Plant : <b><?php echo  $locationname; ?></b></h4>
        <hr />
        <h4 class="main-title">Material type : <b><?php echo  $materialtype; ?></b></h4>
                       
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
                <div class="panel-body">
                    <fieldset>                             
                        <div class="col-md-12">
                            <?php if(!empty($filterdata)){ ?>
                            <a href="<?php echo base_url(); ?>dashboard/orderdetails?businesscode=<?php echo $businesscode; ?>&locationcode=<?php echo $locationcode; ?>&materialtypecode=<?php echo $materialtypecode; ?>&materialcode=<?php echo $materialcode; ?>&selectedbusinesscode=<?php echo $selectedbusinesscode; ?>&selectedlocation=<?php echo $selectedlocation; ?>&selectedmaterialtype=<?php echo $selectedmaterialtype; ?>&asondate=<?php echo $selectedasondate; ?>&excel=yes">
                                <button class="btn btn-primary">
                                    Excel export
                                </button>
                            </a>
                            <?php 
                            }
                            if(!empty($filterdata)){ 
                                showtable($filterdata, $materialtype);          
                            } 
                            ?>
                        </div>    
                        
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
function showtable($array, $materialtype){
    if (empty($array)) {
        echo "<font color='red'>No data found! </font>";
    }
    if (!empty($array)) {
        ?>
        <table id="tableformat" class="table table-bordered table-vertical-middle nomargin table-fixed">
            <thead>
                <tr>                
                    <?php
                    $index = array_keys($array[0]);
                    $count = 0;
                    echo "<th>SL</th>";
                    for($i = 5; $i < count($index) - 3; $i++){
                        ?>
                        <th>
                            <?php echo str_replace('_', ' ', $index[$i]); ?>
                        </th>
                        <?php 
                    }
                    ?>                        
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($array); $i++) {
                    $arrayvalue = array_values($array[$i]);
                    ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <?php
                        for ($j = 5; $j < count($index) - 3; $j++) {
                            $value = $arrayvalue[$j];
                            if (is_numeric($value) and $j != 5) {
                                ?><td style="text-align: right;">
                                    <?php 
                                    if($j == 7){
                                        echo number_format($value,0); 
                                    }else{
                                        if($value == 0){
                                            echo '';
                                        }else{
                                            if($materialtype == "FG"){
                                                echo number_format($value,0);                                             
                                            }else{
                                                echo number_format($value,2);                                             
                                            }
                                        }                                        
                                    }
                                    ?>
                                </td><?php
                            }else{ ?>   
                                <?php 
                                $bgcolor    = '';
                                $color      = '';
                                if($j == 6 || $j == 5){
                                    $bgcolor = $array[$i]['BackColor'];
                                    $color = $array[$i]['FontColor'];
                                }
                                ?>
                                <td style="text-align: left; background-color: <?php echo $bgcolor; ?>; color: <?php echo $color; ?>;">
                                    <?php echo $value; ?>
                                </td>                                    
                                <?php
                            }
                        } 
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    <?php 
    }
}
?>
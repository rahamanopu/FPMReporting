<style>
hr {
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>
<?php //echo json_encode($rows['valid']); exit(); ?>
<script type="text/javascript">
    var exceldata = [];
    var base_url = '<?php echo base_url(); ?>';
    var effectivedate = '<?php echo date('Y-m-d') ?>';
</script>

<?php
//var_dump($filtermaterialdetails); exit();
if(!empty($filtermaterialdetails[0]['BusinessName'])){
    $businessname   = $filtermaterialdetails[0]['BusinessCode'] . ' - ' .$filtermaterialdetails[0]['BusinessName'];
    $maeterialname  = $filtermaterialdetails[0]['Material'];
    $maeterialcode  = $filtermaterialdetails[0]['MaterialCode'];
    $locationcode   = $filtermaterialdetails[0]['LocationCode'] . ' - ' . $filtermaterialdetails[0]['LocationName'];
}else{
    $businessname   = '';
    $maeterialname  = '';
    $locationcode   = '';
}
?>
<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">

        <h4 class="main-title">Business : <b><?php echo $businessname; ?></b></h4>
        <hr />
        <h4 class="main-title">Plant : <b><?php echo  $locationcode; ?></b></h4>
        <hr />
        <h4 class="main-title">Material : <b><?php echo  $maeterialcode . ' - ' .$maeterialname; ?></b></h4>  
        <hr />
        <h4 class="main-title">Aleart Group : <b><?php echo  $aleartgroup; ?></b></h4>                  
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
                            <?php if(!empty($filtermaterialdetails)){ ?>
                            <a href="<?php echo base_url('dashboard/materialdetailsexport/'.$datefrom.'/'.$dateto.'/'.$businesscode.'/?alertgroup='.$aleartgroup.'&location='.$location.'&materialcode='.$materialcode); ?>">
                                <button class="btn btn-primary">
                                    Excel export
                                </button>
                            </a>
                            <?php 
                            }
                                if(!empty($filtermaterialdetails)){ 
                                    showtable($filtermaterialdetails, $datefrom, $dateto, $businesscode, $aleartgroup, $location);          
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
function showtable($array, $datefrom, $dateto, $businesscode, $alertgroup, $location){
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
                    for($i = 7; $i < count($index) - 1; $i++){
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
                        for ($j = 7; $j < count($index) - 1; $j++) {
                            $value = $arrayvalue[$j];
                            if (is_numeric($value)) {
                                ?><td style="text-align: right;">
                                    <?php 
                                        if($j == 8){
                                            echo number_format($value,0); 
                                        }else if($j == 10){
                                            echo number_format($value,2); 
                                        }else{
                                            echo number_format($value,2); 
                                        }
                                    ?></td><?php
                            }else{ ?>                                    
                                <td style="text-align: left;">
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
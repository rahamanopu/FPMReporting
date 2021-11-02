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
if(!empty($filterdetailsdata[0]['BusinessName'])){
    $businessname = $filterdetailsdata[0]['BusinessCode'] . ' - ' .$filterdetailsdata[0]['BusinessName'];
    $alertname = $filterdetailsdata[0]['Alert'];
    $locationprint = $filterdetailsdata[0]['LocationCode'] . ' - ' .$location;
    $materialtype = $filterdetailsdata[0]['Material_Type'];
}else{
    $businessname   = '';
    $alertname      = '';
    $locationprint  = '';
    $materialtype   = '';
}
?>
<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h4 class="main-title">Business : <b><?php echo $businessname; ?></b></h4>
        <hr />
        <h4 class="main-title">Plant : <b><?php echo  $locationprint; ?></b></h4>
        <hr />
        <h4 class="main-title">Notification : <b><?php echo  $alertname; ?></b></h4>  
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
                            <?php if(!empty($filterdetailsdata)){ ?>
                            <a href="<?php echo base_url('dashboard/groupdetailsexport/'.$datefrom.'/'.$dateto.'/'.$businesscode.'/?alertgroup='.$aleartgroup.'&location='.$location.'&materialtype='.$materialtype); ?>">
                                <button class="btn btn-primary">
                                    Excel export
                                </button>
                            </a>
                            <?php 
                            }
                                if(!empty($filterdetailsdata)){ 
                                    showtable($filterdetailsdata, $datefrom, $dateto, $businesscode, $aleartgroup, $location);          
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
                    for($i = 5; $i < count($index) - 2; $i++){
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
                        for ($j = 5; $j < count($index) - 2; $j++) {
                            $value = $arrayvalue[$j];
                            ?>                                    
                            <td style="<?php if($j == 7){ ?> text-align: right; <?php }else{ ?> text-align: left; <?php } ?>">
                                <?php if($j == 5 || $j == 6){ ?> <a target="_blank" href="<?php echo base_url('dashboard/materialdetails/'.$datefrom.'/'.$dateto.'/'.$businesscode.'/?alertgroup='.$alertgroup.'&location='.$location.'&materialcode='.$arrayvalue[5]); ?>"><?php } ?>
                                <?php if($j == 7){ echo number_format($value,0); }else{echo $value; } ?>
                                <?php if($j == 5 || $j == 6){ ?></a><?php } ?>
                            </td>                                    
                            <?php
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
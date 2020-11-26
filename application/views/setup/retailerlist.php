<script type="text/javascript">

    var period = '<?php if(!empty($periodformat)){ echo $periodformat; } ?>';
    var levelcode = '<?php if(!empty($fmecode)){ echo $fmecode; } ?>';

    
    
</script>

<script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script>

<?php
$segment3 = $this->uri->segment(2);
?>

<!-- Section  -->
<section id="main-content">            
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title"><?php echo $pageTitel; ?></h3>                
    </div> 


    <div id="content" class="dashboard padding-20">
        <!-- BOXES -->
        
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                 	
                <div class="panel-body">
                    <fieldset>
                        <form action="<?php echo base_url().$action;?>" method="post" >
                            <div class="col-md-12">                       

                                <div class="col-md-1">
                                    Region
                                </div>
                                <div class="col-md-3">
                                    <select name="regioncode" id="regioncode" class="form-control" onchange="doChangeArea(this.value)">
                                        <option></option>
                                        <?php 
                                        if(!empty($regions)){ 
                                            foreach ($regions AS $row){
                                        ?>
                                            <option 
                                                <?php if(!empty($_POST['regioncode']) AND $row['Level3'] == $_POST['regioncode']){ ?> selected="selected" <?php } ?>
                                                value="<?php echo $row['Level3']; ?>"><?php echo $row['Level3'].' - '.$row['Level3Name']; ?></option>
                                        <?php 
                                            }
                                        } 
                                        ?>                                    
                                    </select> 
                                </div>

                                <div class="col-md-1">
                                    Area
                                </div>
                                <div class="col-md-3">
                                    <select name="areacode" id="areacode" class="form-control" onchange="doChangeTerritory(this.value)">
                                        <?php if(!empty($areainfo) && COUNT($areainfo) > 1){ ?> <option></option> <?php } ?>
                                        <?php                                      
                                        if(!empty($areainfo)){ 
                                            foreach ($areainfo AS $row){
                                        ?>
                                            <option 
                                                <?php if(!empty($_POST['areacode']) AND $row['Level2'] == $_POST['areacode']){ ?> selected="selected" <?php } ?>
                                                value="<?php echo $row['Level2']; ?>"><?php echo $row['Level2'].' - '.$row['Level2Name']; ?></option>
                                        <?php 
                                            }
                                        }  
                                        ?>                                    
                                    </select> 
                                </div>
                            
                                <div class="col-md-1">
                                    TSI
                                </div>
                                <div class="col-md-3">
                                    <select name="fmecode" id="fmecode" class="form-control" 
										<?php if(isset($showDistributorField) && $showDistributorField == true) { ?> onchange="doLoadDistributor(this.value)" <?php } ?>>
                                        <?php if(!empty($fmelist) && COUNT($fmelist) > 1){ ?> <option></option> <?php } ?>
                                        <?php                                      
                                        if(!empty($fmelist)){ 
                                            foreach ($fmelist AS $row){
                                        ?>
                                            <option 
                                                <?php if(!empty($_POST['fmecode']) AND $row['Level1'] == $_POST['fmecode']){ ?> selected="selected" <?php } ?>
                                                value="<?php echo $row['Level1']; ?>"><?php echo $row['Level1'].' - '.$row['Level1Name']; ?></option>
                                        <?php 
                                            }
                                        }  
                                        ?>                                    
                                    </select> 
                                </div>
								
								<?php if(isset($showDistributorField) && $showDistributorField == true) { ?>
								<div class="col-md-1 form-group">
                                    Distributor
                                </div>
                                <div class="col-md-3">
                                    <select name="distributorcode" id="distributorcode" class="form-control" >
                                        <?php if(!empty($distributorlist) && COUNT($distributorlist) > 1){ ?> <option></option> <?php } ?>
                                        <?php                                      
                                        if(!empty($distributorlist)){ 
                                            foreach ($distributorlist AS $row){
                                        ?>
                                            <option 
                                                <?php if(!empty($_POST['distributorcode']) AND $row['DistributorCode'] == $_POST['distributorcode']){ ?> selected="selected" <?php } ?>
                                                value="<?php echo $row['DistributorCode']; ?>"><?php echo $row['DistributorCode'].' - '.$row['DistributorName']; ?></option>
                                        <?php 
                                            }
                                        }  
                                        ?>                                    
                                    </select> 
                                </div>
								<?php } ?>
								
                                <?php if(isset($expenseTypeHeadField) && $expenseTypeHeadField== true) {
                                    ?>

                                <div class="col-md-1" style="margin-top:5px;">Expense Head</div>
                                <div class="col-md-3" style="margin-top:5px;">
                                    <select name="expenseTypeHead" id="expenseTypeHead" class="form-control" >
                                        <?php if(!empty($expenseTypeHeads) && COUNT($expenseTypeHeads) > 1){ ?> <option></option> <?php } ?>
                                        <?php                                      
                                        if(!empty($expenseTypeHeads)){ 
                                            foreach ($expenseTypeHeads AS $row){
                                        ?>
                                            <option value="<?php echo $row['HeadShortName']?>" 
                                            <?php echo ($row['HeadShortName'] == $expenseTypeHead) ? 'selected': ''?>
                                            ><?php echo $row['HeadName']?></option>
                                        <?php 
                                            }
                                        }  
                                        ?>                                    
                                    </select> 
                                </div>

                                    <?php
                                }?>

                                <?php if(isset($expenseTypeSubHeadField) && $expenseTypeSubHeadField== true) {
                                    ?>

                                <div class="col-md-1" style="margin-top:5px;">Sub Head</div>
                                <div class="col-md-3" style="margin-top:5px;">
                                    <select name="expenseTypeSubHead" id="expenseTypeSubHead" class="form-control" >
                                        <?php if(!empty($expenseTypeSubHeads) && COUNT($expenseTypeSubHeads) > 1){ ?> <option></option> <?php } ?>
                                        <?php                                      
                                        if(!empty($expenseTypeSubHeads)){ 
                                            foreach ($expenseTypeSubHeads AS $row){
                                        ?>
                                            <option value="<?php echo $row['SubHeadShortName']?>" 
                                            <?php echo ($row['SubHeadShortName'] == $expenseTypeSubHead) ? 'selected': ''?>
                                            ><?php echo $row['SubHeadName']?></option>
                                        <?php 
                                            }
                                        }  
                                        ?>                                    
                                    </select> 
                                </div>

                                    <?php
                                }?>
                                
                                
                                <?php if(isset($showDateFromField) && $showDateFromField== true){?>
                                <div class="col-md-1"  style="margin-top:5px;">
                                    Date From
                                </div>
                                <div class="col-md-3"  style="margin-top:5px;">
                                    <input type="text" name="startDate" autocomplete="off"
                                           id="" class="form-control datePicker" 
                                           required="required"
                                           value="<?php if (!empty($startDate)) {
                                    echo $startDate;
                                } ?>"
                                           >
                                </div>
                                <?php }?>

                                <?php if(isset($showDateToField) && $showDateToField== true){?>
                                <div class="col-md-1"  style="margin-top:5px;">
                                    Date TO
                                </div>
                                <div class="col-md-3"  style="margin-top:5px;">
                                    <input type="text" name="endDate" autocomplete="off"
                                           id="" class="form-control datePicker" 
                                           required="required"
                                           value="<?php if (!empty($endDate)) {
                                    echo $endDate;
                                } ?>"
                                           >
                                </div>
                                <?php }?>

                                <?php if(isset($showPeriodField)){?>
                                <div class="col-md-1"  style="margin-top:5px;">
                                    Period
                                </div>
                                <div class="col-md-3"  style="margin-top:5px;">
                                    <input type="month" name="period" autocomplete="off"
                                           id="period" class="form-control" 
                                           required="required"
                                           value="<?php if (!empty($period)) {
                                    echo $period;
                                } ?>"
                                           >
                                </div>
                                <?php }?>

                                <div class="col-md-2"  style="margin-top:5px;">
                                    <input type="submit" value="Submit"
                                           name="submit" class="btn btn-primary">
                                </div> 
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- /BOXES --> 
        <?php if(isset($expenses)) {?>
        <div class="row">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">                    
                    <div class="exportallplantable table-responsive">    
                    <table class="table table-bordered table-hover  table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Delete</th>
                            <?php
                            $index = array_keys($expenses[0]);
                            for($i = 2; $i < count($index); $i++){
                                ?>
                                <th><?php echo str_replace(array('_'), array(' '), $index[$i]); ?></th>
                                <?php
                            }
                            ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count = 0;

                        for ($i = 0; $i < count($expenses); $i++) {
                            $arrayvalue = array_values($expenses[$i]);

                            $eachRow = "<tr><td>". ++$count."</td>";
                            $eachRow .="<td><a  href='".base_url()."setup/retailerEdit/".$arrayvalue[2]."' class='btn btn-warning btn-sm' target='_blank'>Edit</a></td>";

                            for ($j = 2; $j < count($index); $j++) {
                                $value = $arrayvalue[$j];
                                $eachRow .="<td>".$value."</td>";
                            }

                            $eachRow .= "</tr>";
                            echo $eachRow;

                            ?>
                            <?php
                        }


                        ?>
                        

                        </tbody>
                        </table>
                    </div> 

					<?php if(!empty($pagingData)){
						?>
						<ul class="pagination">
							<?php foreach($pagingData AS $row){ ?>
								<li <?php if(!empty($page) and $page == $row['PageNo']){ ?> class="active" <?php } ?>>
									<a href="<?php echo base_url().$action.'?regioncode='.$regioncode.'&areacode='.$areacode.'&fmecode='.$fmecode.'&pagelimit='.$pagelimit.'&page='.$row['PageNo']; ?>"><?php echo $row['PageNo']; ?></a></li>
							<?php } ?>
						</ul>
					<?php } ?>					

                </div>
            </div>
        </div>
        <?php }?>
    </div>

</section>



<style>
.selected {
    background-color: #CCC;
    color: #FFF;
}
table tr td{
    vertical-align: middle !important;
}

.panel>.table-bordered, .panel>.table-responsive>.table-bordered{
    border: 1px solid #CCC;
}
</style>

 

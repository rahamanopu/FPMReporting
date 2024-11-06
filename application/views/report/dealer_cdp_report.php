<!-- <script src="<?php echo base_url(); ?>assets/js/levelManagement.js"></script> -->
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
                    <form action="<?php echo base_url().$action; ?>" method="post" >
                    <div class="col-md-12">
                        
                        <div class="col-md-1"  style="margin-top:5px;">
                            Period
                        </div>
                        <div class="col-md-3"  style="margin-top:5px;">
                            <input type="text" name="period" autocomplete="off"
                                id="" class="form-control monthPicker" 
                                required="required"
                                value="<?php echo $period;?>">
                        </div>
                        
                        <div class="col-md-2">
                            <input type="submit" value="Submit"
                                name="submit" class="btn btn-primary">
                        </div> 
                    </div>
                </div>
                </form>
                </fieldset>
            </div>
        </div>
    </div>
    <!-- /BOXES --> 
    <div class="row padding-left-10">
        <div id="panel-1" class="panel panel-default">
            <div class="panel-body">

                <?php if(!empty($priorityData)){ ?>
                    <a style="margin-bottom:5px;" class="btn btn-default" href="<?php echo base_url().$action.'?&period='.$period.'&excel=yes'; ?>">
                        Export To Excel
                    </a>
                    <div class="exportallplantable">    
                        <table class="table table-bordered table-hover  table-striped" id="commontable">
                            <thead>                            
                                <tr>         
                                    <?php
                                    $index = array_keys($priorityData[0]);
                                    $count = 0;
                                    for($i = 0; $i < count($index); $i++){
                                        ?><th <?php if($i < 12){ ?> class="brackgroundwhtie" <?php } ?>><?php echo str_replace(array('_','Per','Prac'), array(' ',' / ','Prac.'), $index[$i]); ?></th><?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            $count = 0;
                            for ($i = 0; $i < count($priorityData); $i++) { $count++;
                                $arrayvalue = array_values($priorityData[$i]);
                                ?>
                                <tr>
                                    <?php
                                    $date = '';
                                    $level = '';
                                    // echo '<pre>',print_r($index);die();
                                    for ($j = 0; $j < count($index); $j++) {
                                        $value = $arrayvalue[$j];   
                                        if (is_numeric($value)) { 
                                            if($j > 11){
                                                echo "<td style='text-align: right;'>" . number_format($value,1)."</td>"; 
                                            }else{
                                                echo "<td style='text-align: right;'>" . $value."</td>"; 
                                            }

                                        }else{ 
                                                echo "<td>" . $value."</td>"; 
                                        }
                                    } 
                                    ?>
                                    
                                </tr>

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                   
            </div>
        </div>
    </div>
    </div>

</section>

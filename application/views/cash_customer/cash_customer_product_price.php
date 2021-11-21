<!-- Section  -->
<section id="main-content">   
    <?php echo getFlashMsg();?>         
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
                        <form action="<?php echo base_url().$action;?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="col-md-8">
                                <div class="col-md-12 margin-top-3">
                                    <label class="control-label col-md-4">Period for Price</label>
                                    <div class="col-md-8">
                                        <input type="month" name="period" class="form-control">

                                    </div>

                                </div>
                            
                                <div class="col-md-12 margin-top-3">
                                    <label class="control-label col-md-4">Product Cash Price Excel File</label>
                                    <div class="col-md-8">
                                        <input type="file" name="cash_price_file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 margin-top-3">
                                    <div class="col-md-8 col-md-offset-4">                                    
                                        <input type="submit" value="Submit"
                                            name="submit" class="btn btn-primary">
                                        
                                    </div> 
                                </div> 
                            </div>
                            <div class="col-md-4 bg-success padding-10">
                                <div class="col-md-12 margin-top-3">
                                    <label class="control-label col-md-4">Sample File(Download)</label>
                                    <div class="col-md-8">
                                       <a class="btn btn-danger" href="<?php echo base_url().'assets/upload/import/PaintCashPriceUpload.xlsx';?>">Sample File</a>
                                    </div>
                                </div>

                            </div> 
                           
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
        
    </div>

</section>


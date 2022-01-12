<!-- Section  -->
<section id="main-content">
    
    <div>
        <!-- BOXES -->
        <div class="row">
        <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong><?php echo isset($pageTitle) ? $pageTitle : ''?></strong>
                    </div>
                    
                    
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">                    
                    <?php echo getFlashMsg(); ?>

                    <div class="panel-body">
                        <a class="btn btn-sm btn-default margin-bottom-2" href="<?php echo base_url().'setup/product-SMS-order?excel=yes'?>">Export Excel</a>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>                                 
                                    <th>ProductCode</th>
                                    <th>SMSCODE</th>
                                    <th>ProductName</th>
                                    <th>Unit</th>
                                    <th>PackSizeWT</th>
                                    <th>PackSize</th>
                                    <th>BrandCode</th>
                                    <th>MRP</th>
                                    <th>Business</th>
                                    <th>SMSOrder</th>
                                    <th>Edit</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {  
        $(document).on('click','.btn-toggle',function() {
            var btnGroup = $(this); 
            var productCode = btnGroup.attr('data-productCode');
            var smsOrderStatus = btnGroup.attr('data-smsOrder');
            var newOrderStatus = (smsOrderStatus=='Y') ? 'N':'Y'; 
            console.log("==========",productCode,"======",smsOrderStatus,"======",newOrderStatus);
            // return true;

            $.ajax({
                url: base_url + 'setup/productSMSOrderUpdate',
                data:{
                    'productCode' : productCode,
                    'smsOrder' : newOrderStatus,
                },
                dataType:'json',
                type:'post',
                success: function(response) {
                    console.log(response);
                    if(response.success === true) {
                        $(btnGroup).find('.btn').toggleClass('active');  
                        $(btnGroup).find('.btn').toggleClass('btn-primary');
                        $(btnGroup).find('.btn').toggleClass('btn-default');

                        $(btnGroup).parent().siblings().children('#smsOrder_'+productCode).html(newOrderStatus);
                        $(btnGroup).attr('data-smsOrder',newOrderStatus);
                    }

                }
            });

        });      
       
    });
</script>

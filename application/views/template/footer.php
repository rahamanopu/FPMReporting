

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '<?php echo base_url(); ?>assets/plugins/';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sarah.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>


<!--Manually Load DataTable-->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    $(document).ready(function () {
        $(".bs-multiselect").multiselect({
            enableFiltering: true,
            includeSelectAllOption: true
        });
        // datePicker
        $(".datePicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });

        var ajaxDataLoadUrl = $("#ajaxDataLoadUrl").val();
        var ajaxDataLimit = $("#ajaxDataLimit").val();
        if(ajaxDataLimit =='') {
            ajaxDataLimit = 25;
        }
        var dataTable = jQuery("#dataTable").dataTable({
            'processing': true,
            'serverSide': true,
            'pageLength': ajaxDataLimit,

            'order': [],
            'ajax': {
                url: ajaxDataLoadUrl,
                type: 'POST'
            },
            'columnDefs': {
                'targets': [0, 3, 4],
                'orderable': false
            }
        });
    });
</script>

<script src="<?php echo base_url(); ?>assets/plugins/datepicker/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery_validation.js"></script>


<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = '<?php echo base_url(); ?>assets/plugins/';</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sarah.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>

<?php /*
<!--Manually Load DataTable-->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
*/
?>
<script type="text/javascript">
loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
    loadScript(plugin_path + "datatables/js/dataTables.tableTools.min.js", function(){
        loadScript(plugin_path + "datatables/js/dataTables.colReorder.min.js", function(){
            loadScript(plugin_path + "datatables/js/dataTables.scroller.min.js", function(){
                loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){
                    loadScript(plugin_path + "select2/js/select2.full.min.js", function(){
                        loadScript(plugin_path + "datatables/dataTables.fixedHeader.min.js", function(){
                            loadScript(plugin_path + "datatables/dataTables.fixedColumns.min.js", function(){    
                            if (jQuery().dataTable) {
                                // Active General Datatable
                                jQuery('.dataTable').DataTable({
                                    pageLength: 25
                                });
                                // End Active General Datatable
                                // Datatable with TableTools
                                function initTable1() {
                                    var table = jQuery('#datatable');
                                    /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */
                                    /* Set tabletools buttons and button container */
                                    jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
                                        "container": "btn-group tabletools-btn-group pull-right",
                                        "buttons": {
                                            "normal": "btn btn-sm btn-default",
                                            "disabled": "btn btn-sm btn-default disabled"
                                        }
                                    });
                                    //table.buttons().disable();
                                    var oTable = table.dataTable({
                                        "order": [],
                                        fixedColumns: {
                                            leftColumns: 3
                                        },
                                        "columnDefs": [
                                            { "width": "20%", "targets": 1 },
                                            { "width": "7%", "targets": 2 }
                                        ],
                                        scrollY: "400px",
                                        scrollX: true,
                                        scrollCollapse: true,
                                        paging: false,
                                        "searching": false,
                                        "lengthMenu": [
                                            [5, 10, 20, 30, -1],
                                            [5, 10, 20, 30, "All"] // change per page values here
                                        ],
                                        // set the initial value
                                        "pageLength": 10,
                                        "bSort": false,
                                        "fixedHeader": true,
                                        "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable                                                
                                    });

                                    var tableWrapper = jQuery('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
                                    tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
                                }
                                initTable1();
                                 
                                
                                
                                function initdoctorbrandtable() {
                                    var table = jQuery('#commontable');
                                    /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */
                                    /* Set tabletools buttons and button container */
                                    jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
                                        "container": "btn-group tabletools-btn-group pull-right",
                                        "buttons": {
                                            "normal": "btn btn-sm btn-default",
                                            "disabled": "btn btn-sm btn-default disabled"
                                        }
                                    });
                                    //table.buttons().disable();
                                    var oTable = table.dataTable({
                                        "order": [],
                                        fixedColumns: {
                                            leftColumns: 0
                                        },
                                        "columnDefs": [
                                        ],
                                        scrollY: "400px",
                                        scrollX: true,
                                        scrollCollapse: true,
                                        paging: false,
                                        "searching": false,
                                        "pageLength": 10,
                                        "bSort": false,
                                        "fixedHeader": true,
                                        "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable                                                
                                    });
                                    //var tableWrapper = jQuery('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
                                    //tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
                                }
                                initdoctorbrandtable();


                                // Dynamic Datatable 
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

                                 // End Dynamic Datatable 
                                
                                 
                                
                            }
                        });    
                        });
                    });
                });
            });
        });
    });
});
$(document).ready(function(){
    //$('[data-toggle="tooltip"]').tooltip();
});
</script>



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
            
        
               
    });
</script>

<script src="<?php echo base_url(); ?>assets/plugins/datepicker/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery_validation.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.chained-1.0.1.js"></script>

 
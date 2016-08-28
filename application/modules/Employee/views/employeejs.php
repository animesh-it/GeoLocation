<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
	$(document).ready(function(){
		var usertable = $('#PartnerbranchesListTable').DataTable({
			"aoColumnDefs":[
				{
					"bSortable": true,
					"aTargets": [8]
				}
			]
		});
	});

</script>
<!--Date Pciker-->
        

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link href="http://localhost/cascrm/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="http://localhost/cascrm/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<script src="http://localhost/cascrm/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script>
	if($('.datepicker').length > 0){
			$('.datepicker').datepicker();
	}
	if($('.select2').length > 0){
			$('.select2').select2();
	}

	$('.showMap').on('click', function(){
		var employee = $('#Employee').val();
		var fromDate = $('#FromDate').val();
		var toDate	 = $('#ToDate').val();
		$.ajax({
			url: '<?php echo base_url()?>Employee/MapData',
			type: 'POST',
			data: {
					Employee : employee,
					FromDate : fromDate,
					ToDate   : toDate,
					Submit	 : 'Submit'
			},
			success : function(msg)
			{
				$('.showMapData').html(msg);
			}
		})
	});
</script>
<!--END OF DATEPICKER-->
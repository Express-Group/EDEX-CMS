<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li><i class="ace-icon fa fa-home home-icon"></i><a href="#">Home</a></li>
				<li><a href="#">Venue</a></li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<button class="btn btn-info" id="bootbox-confirm" onclick="add_venue_modal()">Add Venue</button>
			</div>
			
			<div class="modal fade" id="venue_modal" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<form name="venue_form" id="venue_form" action="" method="POST" enctype="multipart/form-data">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label class="col-md-3">Venue</label>
									<div class="col-md-9">
										<textarea class="form-control" name="venue_txt" id="venue_txt"></textarea>
										<span class="error" id="venue_error"></span>
									</div>
								</div>
								<div id="status"></div>
							</div>
							<input type="hidden" name="venue_edit" id="venue_edit" value="">
							<div class="modal-footer">
								<button type="button"  onclick="validate()" class="btn btn-primary submit"></button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
							<div class="clearfix">
								<div class="pull-right tableTools-container"></div>
							</div>
							<div>
								<table id="dynamic-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="center">	S.No</th>
											<th class="center">Venue</th>
											<th class="center">
												<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
												Created On
											</th>
											<th class="hidden-480 center">Status</th>
											<th class="center">Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$i =1;
										if($content['rows'] >0){
										foreach($content['value'] as $data) {?>
										<tr>
											<td class="center">	<?php echo $i;?></td>
											<td><?php echo $data['venue_details'];?></td>
											<td><?php echo $data['created_on'];?></td>
											<td class="hidden-480">
												<?php if($data['status']=='1'){ ?>
												<span class="label label-sm label-success">Active</span>
												<?php }else {?>
												<span class="label label-sm label-warning">Deactive</span>
												<?php } ?>
											</td>
											<td>
												<div class="hidden-sm hidden-xs action-buttons">
													<a class="green" href="javascript:edit_venue(<?php echo $data['venue_id'];?>)">
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>

													<a class="red" href="javascript:delete_venue(<?php echo $data['venue_id'];?>)">
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
											</td>
										</tr>
										<?php $i++; } } else{?>
										<tr>
											<td colspan='6'>No Data available</td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								<div class="pagination">
									<?php echo $pagination;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript">

	function add_venue_modal()
	{
		$(".modal-title").html("Add Venue");
		$("#venue_form").attr("action","<?php echo base_url();?>neet-cpanel/createvenue");
		$(".submit").html("Add");
		$("#venue_error").html("");
		$("#status").html("");
		$('#venue_form').trigger("reset");
		$("#venue_modal").modal();
	}
	
	function validate()
	{
		var venue_txt 	= $("#venue_txt").val();
		var status 		= 1;
		if(venue_txt == ""){ status = 0; $("#venue_error").html("Enter Venue"); }
		if(status == 1){
			$('#venue_form').submit();
		}
	}
	
	function edit_venue(venue_id)
	{
		if(venue_id !='')
		{
			$.ajax({
				url			: "<?php echo base_url();?>neet-cpanel/get_venuedetails",
				type		: "POST",
				data 		: { venue_id : venue_id },
				dataType	: 'json',
				success		: (function(data)
					{ 
						$(".modal-title").html("Edit Venue");
						$("#venue_edit").val(data.id);
						$("#venue_txt").val(data.venue); 
						$("#status").html(data.status);
						$("#venue_form").attr("action","<?php echo base_url();?>neet-cpanel/updatevenue");
						$(".submit").html("Update");
						$("#venue_error").html("");
						$("#venue_modal").modal();
					}
				),
				error		:(function(err)
					{ 
						console.log(err); 
						$("#venue_modal").modal('hide');
						toastr.error('Something Went Wrong');
					}
				)
			});
		}else{
			toastr.error('Something Went Wrong');
		}
	}
	
	function delete_venue(venue_id)
	{
		if(venue_id !=''){
			if(	confirm("Are you sure want to delete?") ){
				$.ajax({
					url			: "<?php echo base_url();?>neet-cpanel/delete_venue",
					type		: "POST",
					data		: { venue_id : venue_id },
					dataType	: 'json',
					success		: (function(data)
					{
						if(data.val == 1){
							location.reload();
						}else{
							toastr.error('Something Went Wrong');
						}
					}),
					error		: (function(err){
						console.log(err);
						toastr.error('Something Went Wrong');
					})
				});
			}
		}else{
			toastr.error('Something Went Wrong');
		}
	}
</script>
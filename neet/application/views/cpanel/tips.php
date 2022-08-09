<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li><i class="ace-icon fa fa-home home-icon"></i><a href="<?php echo base_url();?>neet-cpanel/dashboard">Home</a></li>
				<li><a href="<?php echo base_url();?>neet-cpanel/tips">Tips</a></li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<button class="btn btn-info" id="bootbox-confirm" onclick="add_tip_modal()">Add Tips</button>
			</div>
			
			<div class="modal fade" id="tips_modal" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<form name="tips_form" id="tips_form" action="" method="POST" enctype="multipart/form-data">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label class="col-md-3">Tips</label>
									<div class="col-md-9">
										<textarea class="form-control" name="tips" id="tips_txt"></textarea>
										<span class="error" id="tips_error"></span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3">Upload Image</label>
									<div class="col-md-9">
										<input type="file" name="tips_image" id="tips_image" />
										<span class="error" id="image_error"></span>
									</div>
								</div>
								<div class="edit_image col-md-9 col-md-offset-3"></div>
								<div id="status" style="margin-top:3%;"></div>
								<input type="hidden" name="tips_edit" id="tips_edit" value="">
								<input type="hidden" name="tips_edit_image" id="tips_edit_image" value="">
							</div>
							<div class="modal-footer">
								<button type="button" onclick="validate()" class="btn btn-primary submit"></button>
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
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">	S.No</th>
										<th>Tips</th>
										<th>Tips Image</th>
										<th>Created On </th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php $i=1; 
									if($content['rows'] >0){
									foreach($content['value'] as $data) { ?>
									<tr>
										<td class="center">	<?php echo $i; ?> </td>
										<td class="center"> <?php echo $data['tips_txt']; ?> </td>
										<td class="center"><img src="<?php echo base_url().'uploads/'.$data['tips_image']; ?>" style="width:100px;" /> </td>
										<td class="center"> <?php echo $data['created_on']; ?> </td>
										<td class="center">
											<?php if($data['status']=='1'){ ?>
												<span class="label label-sm label-success">Active</span>
											<?php }else { ?>
												<span class="label label-sm label-warning">Deactive</span>
											<?php } ?></td>
										<td class="center">
											<div class="hidden-sm hidden-xs action-buttons">
												<a class="green" href="javascript:edit_tips(<?php echo $data['tips_id']; ?>)">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												<a class="red" href="javascript:delete_tips(<?php echo $data['tips_id']; ?>)">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
											</div>
										</td>
									</tr>
									<?php $i++; } } else {?>
										 <tr>
											<td colspan='6'>No Data available</td>
										</tr>
									<?php } ?>
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

<script language="javascript" type="text/javascript">

	var base_url = '<?php echo base_url();?>';
	function add_tip_modal()
	{
		$(".modal-title").html("Add Tips");
		$("#tips_form").attr("action",base_url+"neet-cpanel/createtips").trigger("reset");
		$(".submit").html("Add");
		$("#tips_edit").val("");
		$("#tips_error").html("");
		$(".edit_image").html("");
		$("#image_error").html("");
		$("#status").html("");		
		$("#tips_modal").modal();
	}
	
	function validate()
	{
		var tips_txt 		= $("#tips_txt").val();
		var tips_image		= $("#tips_image").val();
		var tips_edit_image	= $("#tips_edit_image").val();
		var status 		= 1;
		if(tips_txt == ""){ status = 0; $("#tips_error").html("Enter Tips"); }
		else{ $("#tips_error").html(""); }
		if(tips_edit_image == ''){
			if(tips_image == ""){ status = 0; $("#image_error").html("Upload Image"); }
			else { $("#image_error").html(""); }
		}
		if(tips_image!='') {
			var splitextension 	= tips_image.split('.');
			var extension 		= splitextension[1].toLowerCase();
			if(extension != 'jpeg' && extension != 'jpg' && extension != 'png' )
			{
				status = 0;
				$("#image_error").html("Upload Valid Image file ( jpeg ,jpg ,png only accepted )");
			}else{
				$("#image_error").html("");
			}
		}
		if(status == 1){
			$('#tips_form').submit();
		}
	}
	
	function edit_tips(tips_id)
	{
		var image_path, url = '' ;
		if(tips_id !='')
		{
			$.ajax({
				url			: base_url+"neet-cpanel/get_tipdetails",
				type		: "POST",
				data 		: { tips_id : tips_id },
				dataType	: 'json',
				success		: (function(data)
					{ 
						//console.log(data);
						if(data.id != 0){
							
							$(".modal-title").html("Edit Tips");
							$(".submit").html("Update");
							$("#tips_edit").val(data.id);
							$("#tips_txt").val(data.tips);
							$("#tips_edit_image").val(data.image);							
							if(data.show_image !=''){
								url		= base_url+'uploads/'+data.show_image;
								image_path = "<img style='width:100px;' src="+url+" >";
							}
							$(".edit_image").html(image_path); 
							$("#status").html(data.status);
							$("#tips_form").attr("action",base_url+"neet-cpanel/updatetips");
							$("#tips_error").html("");
							$("#image_error").html("");
							$("#tips_modal").modal();
						}else{
							toastr.error('Something Went Wrong');
						}
					}
				),
				error		:(function(err)
					{ 
						console.log(err); 
						$("#tips_modal").modal('hide');
						toastr.error('Something Went Wrong');
					}
				)
			});
		}else{
			toastr.error('Something Went Wrong');
		}
	}
	
	function delete_tips(tips_id)
	{
		if(tips_id !=''){
			if(	confirm("Are you sure want to delete?") ){
				$.ajax({
					url			: base_url+"neet-cpanel/delete_tips",
					type		: "POST",
					data		: { tips_id  : tips_id  },
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
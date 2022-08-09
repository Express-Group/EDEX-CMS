<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li><i class="ace-icon fa fa-home home-icon"></i><a href="<?php echo base_url();?>neet-cpanel/dashboard">Home</a></li>
				<li><a href="<?php echo base_url();?>neet-cpanel/video">Videos</a></li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<button class="btn btn-info" id="bootbox-confirm" onclick="add_video_modal()">Add Video</button>
			</div>
			
			<div class="modal fade" id="video_modal" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<form name="video_form" id="video_form" action="" method="POST" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label class="col-md-3">Video Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="video_title" id="video_title" />
										<span class="error" id="title_error"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">Video Embed Link</label>
									<div class="col-md-9">
										<textarea class="form-control" name="video_embed" id="video_embed"></textarea>
										<span class="error" id="embed_error"></span>
									</div>
								</div>
								<div id="status" class="form-group"></div>
								<input type="hidden" name="video_edit" id="video_edit" value="">
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
							<div>
								<table id="dynamic-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="center">	S.No</th>
											<th>Video Title</th>
											<th>Embed Video</th>
											<th>
												<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
												Created On
											</th>
											<th class="hidden-480">Status</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php $i=1; 
										if($content['rows'] >0){
										foreach($content['value'] as $data) {?>
										<tr>
											
											<td class="center">	<?php echo $i;?></td>
											<td class="center"><?php echo $data['video_title'];?></td>
											<td class="center" style="width:30%;"><?php echo html_entity_decode($data['video_embed']); ?></td>
											<td class="center"><?php echo $data['created_on'];?></td>
											<td class="center">
												<?php if($data['status']=='1'){ ?>
												<span class="label label-sm label-success">Active</span>
												<?php }else {?>
												<span class="label label-sm label-warning">Deactive</span>
												<?php } ?>
											</td>
											<td class="center">
												<div class="hidden-sm hidden-xs action-buttons">
													<a class="green" href="javascript:edit_video(<?php echo $data['video_id'];?>)">
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>
													<a class="red" href="javascript:delete_video(<?php echo $data['video_id'];?>)">
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
</div>

<script language="javascript" type="text/javascript">

	var base_url = '<?php echo base_url();?>';
	function add_video_modal()
	{
		$(".modal-title").html("Add Video");
		$("#video_form").attr("action",base_url+"neet-cpanel/createvideo").trigger("reset");
		$(".submit").html("Add");
		$("#video_edit").val("");
		$("#title_error").html("");
		$("#embed_error").html("");
		$("#status").html("");		
		$("#video_modal").modal();
	}
	
	function validate()
	{
		var video_title 	= $("#video_title").val();
		var video_embed		= $("#video_embed").val();
		var status 			= 1;
		if(video_title == ""){ status = 0; $("#title_error").html("Enter Video Title"); }
		else{ $("#title_error").html(""); }
		if(video_embed == ""){ status = 0; $("#embed_error").html("Enter Embed Video link"); }
		else{ $("#embed_error").html(""); }
		if(status == 1){
			$('#video_form').submit();
		}
	}
	
	function edit_video(video_id)
	{
		if(video_id !='')
		{
			$.ajax({
				url			: base_url+"neet-cpanel/get_videodetails",
				type		: "POST",
				data 		: { video_id : video_id },
				dataType	: 'json',
				success		: (function(data)
					{ 
						if(data.id != 0){
							$(".modal-title").html("Edit Video");
							$(".submit").html("Update");
							$("#video_edit").val(data.id);
							$("#video_title").val(data.title);
							$("#video_embed").val(data.embed);							
							$("#status").html(data.status);
							$("#video_form").attr("action",base_url+"neet-cpanel/updatevideo");
							$("#title_error").html("");
							$("#embed_error").html("");
							$("#video_modal").modal();
						}else{
							toastr.error('Something Went Wrong');
						}
					}
				),
				error		:(function(err)
					{ 
						console.log(err); 
						$("#video_modal").modal('hide');
						toastr.error('Something Went Wrong');
					}
				)
			});
		}else{
			toastr.error('Something Went Wrong');
		}
	}
	
	function delete_video(video_id)
	{
		if(video_id !=''){
			if(	confirm("Are you sure want to delete?") ){
				$.ajax({
					url			: base_url+"neet-cpanel/delete_video",
					type		: "POST",
					data		: { video_id  : video_id  },
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
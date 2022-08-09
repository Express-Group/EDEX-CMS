<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li><i class="ace-icon fa fa-home home-icon"></i><a href="<?php echo base_url();?>neet-cpanel/dashboard">Home</a></li>
				<li><a href="<?php echo base_url();?>neet-cpanel/news">News</a></li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<button class="btn btn-info" id="bootbox-confirm" onclick="add_news_modal()">Add News</button>
			</div>
			
			<div class="modal fade" id="news_modal" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<form name="news_form" id="news_form" action="" method="POST" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label class="col-md-3">News Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="news_title" id="news_title" />
										<span class="error" id="news_error"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3">News Link</label>
									<div class="col-md-9">
										<textarea class="form-control" name="news_link" id="news_link"></textarea>
										<span class="error" id="link_error"></span>
									</div>
								</div>
								<div id="status" class="form-group"></div>
								<input type="hidden" name="news_edit" id="news_edit" value="">
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
											<th style="width:25%;">News Title</th>
											<th >News Link </th>
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
											<td class="center"><?php echo $data['news_title'];?></td>
											<td class="center"><a href="<?php echo $data['news_url'];?>" target="_blank"><?php echo $data['news_url'];?></a></td>
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
													<a class="green" href="javascript:edit_news(<?php echo $data['news_id'];?>)">
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>
													<a class="red" href="javascript:delete_news(<?php echo $data['news_id'];?>)">
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
	function add_news_modal()
	{
		$(".modal-title").html("Add News");
		$("#news_form").attr("action",base_url+"neet-cpanel/createnews").trigger("reset");
		$(".submit").html("Add");
		$("#news_edit").val("");
		$("#news_error").html("");
		$("#link_error").html("");
		$("#status").html("");		
		$("#news_modal").modal();
	}
	
	function validate()
	{
		var news_title 	= $("#news_title").val();
		var news_link		= $("#news_link").val();
		var status 			= 1;
		if(news_title == ""){ status = 0; $("#news_error").html("Enter News Title"); }
		else{ $("#news_error").html(""); }
		if(news_link == ""){ status = 0; $("#link_error").html("Enter News Link"); }
		else{ $("#link_error").html(""); }
		if(status == 1){
			$('#news_form').submit();
		}
	}
	
	function edit_news(news_id)
	{
		if(news_id !='')
		{
			$.ajax({
				url			: base_url+"neet-cpanel/get_newsdetails",
				type		: "POST",
				data 		: { news_id : news_id  },
				dataType	: 'json',
				success		: (function(data)
					{ 
						if(data.id != 0){
							$(".modal-title").html("Edit News");
							$(".submit").html("Update");
							$("#news_edit").val(data.id);
							$("#news_title").val(data.title);
							$("#news_link").val(data.news_link);							
							$("#status").html(data.status);
							$("#news_form").attr("action",base_url+"neet-cpanel/updatenews");
							$("#news_error").html("");
							$("#link_error").html("");
							$("#news_modal").modal();
						}else{
							toastr.error('Something Went Wrong');
						}
					}
				),
				error		:(function(err)
					{ 
						console.log(err); 
						$("#news_modal").modal('hide');
						toastr.error('Something Went Wrong');
					}
				)
			});
		}else{
			toastr.error('Something Went Wrong');
		}
	}
	
	function delete_news(news_id)
	{
		if(news_id !=''){
			if(	confirm("Are you sure want to delete?") ){
				$.ajax({
					url			: base_url+"neet-cpanel/delete_news",
					type		: "POST",
					data		: { news_id  : news_id  },
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
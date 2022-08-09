<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li><i class="ace-icon fa fa-home home-icon"></i><a href="<?php echo base_url();?>neet-cpanel/dashboard">Home</a></li>
				<li><a href="<?php echo base_url();?>neet-cpanel/questions">Questions</a></li>
			</ul>
		</div>

		<div class="page-content">
			<div class="page-header">
				<a href="<?php echo base_url();?>neet-cpanel/questions/add" class="btn btn-info pull-right" id="bootbox-confirm">Add Questions</a>
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
											<th class="center">	Question Id</th>
											<th>Question</th>
											<th>Subject</th>
											<th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>Created On</th>
											<th class="hidden-480">Status</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>	
									<?php
									foreach($data as $questions){
										echo '<tr>';
										echo '<td>'.$questions->qid.'</td>';
										echo '<td>'.$questions->question.'</td>';
										echo '<td>'.$questions->subject.'</td>';
										echo '<td>'.$questions->created_on.'</td>';
										if($questions->status==1){
											echo '<td style="color:green;">Active</td>';
										}else{
											echo '<td style="color:red;">Inactive</td>';
										}
										echo '<td><a class="green" href="'.base_url('neet-cpanel/questions/edit?id='.$questions->qid).'"><i class="ace-icon fa fa-pencil bigger-130"></i></a></td>';
										echo '</tr>';
									}
									?>
									</tbody>
								</table>
								<div class="pagination"><?php echo $pagination ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
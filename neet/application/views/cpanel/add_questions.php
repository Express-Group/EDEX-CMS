<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="main-content">
<style> .form-group p{color:red;} </style>
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li><i class="ace-icon fa fa-home home-icon"></i><a href="<?php echo base_url();?>neet-cpanel/dashboard">Home</a></li>
				<li><i class="ace-icon"></i><a href="<?php echo base_url();?>neet-cpanel/questions">Questions</a></li>
				<?php if($this->input->get('id')!=''):  ?>
					<li><a href="<?php echo base_url();?>neet-cpanel/questions/edit?id=<?php echo $this->input->get('id'); ?>"> Edit Questions</a></li>
				<?php else:  ?>
					<li><a href="<?php echo base_url();?>neet-cpanel/questions/add"> Add Questions</a></li>
				<?php endif;  ?>
			</ul>
		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
							<div class="clearfix">
								<div class="pull-right tableTools-container"></div>
							</div><br>
							<div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
								  <div class="panel panel-primary">
									<div class="panel-heading text-center"><?php echo ($this->input->get('id')!='') ? 'EDIT' : 'ADD' ; ?> QUESTIONS</div>
									<div class="panel-body">
										<form method="post" action="" enctype="multipart/form-data">
										<div class="form-group">
											<label>Subject <sup>*</sup></label>
											<select name="subject" class="form-control">
												<option value="">Select any one</option>
												<option value="Maths" <?php if($this->input->get('id')!='' && $questiondetails['subject']=='Maths'){ echo ' selected '; } ?>>Maths</option>
												<option value="Chemistry" <?php if($this->input->get('id')!='' && $questiondetails['subject']=='Chemistry'){ echo ' selected '; } ?>>Chemistry</option>
												<option value="Physics" <?php if($this->input->get('id')!='' && $questiondetails['subject']=='Physics'){ echo ' selected '; } ?>>Physics</option>
											</select>
											<?php echo form_error('subject'); ?>
										</div>
										<div class="form-group">
											<label>Question <sup>*</sup></label>
											<input type="text" name="question" class="form-control" value="<?php  echo (set_value('question')!='') ? set_value('question') : @$questiondetails['question'] ?>">
											<?php echo form_error('question'); ?>
										</div>
										<div class="form-group">
											<label>Answer <sup>*</sup></label>
											<textarea style="min-height:200px;" cols="6"  name="answer" class="form-control"><?php  echo (set_value('answer')!='') ? set_value('answer') : @$questiondetails['answer'] ?></textarea>
											<?php echo form_error('answer'); ?>
										</div>
										<div class="form-group">
											<label>File Upload (supports pdf ,doc ,docx) </label>
											<?php if($this->input->get('id')!='' && $questiondetails['file_path']!=''){ ?>
											<br><span><a href="<?php echo base_url('assets/images/Questions/'.$questiondetails['file_path']) ?>"><?php echo $questiondetails['file_path']; ?></a></span>
											<?php } ?>
											<input type="file" name="file_upload" class="form-control">
											<?php echo ($error!='') ? $error : ''; ?>
										</div>
										<div class="form-group">
											<?php if($this->input->get('id')!=''){ ?>
											<input type="hidden" name="qid" value="<?php echo $questiondetails['qid']; ?>">
											<input type="hidden" name="file_temp" value="<?php echo $questiondetails['file_path']; ?>">
											<?php } ?>
											<button class="btn btn-info" type="submit">Submit</button>
											<button class="btn btn-info" type="reset">Reset</button>
											<button onclick="window.location.href='<?php echo base_url('neet-cpanel/questions') ?>'" class="btn btn-info" type="button">Go Back</button>
										</div>
										</form>
									</div>
								  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
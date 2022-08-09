<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							Copyright © 2019 Designed and Developed by <span class="blue bolder">ENPL</span>. All rights reserved.
						</span>
					</div>
				</div>
			</div>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div>
		<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>	
		<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/spinbox.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/daterangepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.knob.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/autosize.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.inputlimiter.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-tag.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/toastr.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>
		
		
		<script type="text/javascript">

		
			jQuery(function($) {
			<?php if( ($this->session->flashdata('error')) !='' ) { ?>
				toastr.error("<?php echo $this->session->flashdata('error');?>");
			<?php } else if( ($this->session->flashdata('success')) !='' ) { ?>	
				toastr.success("<?php echo $this->session->flashdata('success');?>");
			<?php } ?>
			})
		
			<?php if( ($this->session->flashdata('question')) =='success' ): ?>	
			toastr.success('question created successfully');
			<?php endif; ?>
			<?php if( ($this->session->flashdata('question')) =='error' ): ?>	
			toastr.success('Something went wrong pls try again');
			<?php endif; ?>
				
				
			jQuery(function($) {
				
				$('#tips_image').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
			
			
			})
			
		</script>
	</body>
</html>
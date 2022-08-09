<?php if($this->input->get('user_upload')=='true'): ?>
<style>
sup{color:#f00;}
.border-button{
	width: 25%;
    background: #fff;
    border: 1px solid #f4981d;
	outline:none !important;
}
.single-button,.single-button:hover,.single-button:active,.single-button:focus{
	width: 25%;
    background: #f4981d;
    color: #fff;
    border: 1px solid #f4981d;
	outline:none !important;
}
.custom_error{
	margin-top: 2px;
    color: #f00;
}
.form-group-n{
	width: 48%;
    float: left;
    margin-left: 1%;
	margin-bottom:15px;
}
.form-group-s{
	width: 100%;
    float: left;
	margin-bottom:15px;
}
.review-fields{
	background: white;
    position: fixed;
    top: 0;
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.07);
    top: 19%;
    z-index: 999999999;
}
.review-title{
    background: #f4981d;
    margin: 0 0 10px;
    padding: 10px 0 10px;
    color: #fff;
}
</style>
<h3 class="text-uppercase text-center">Upload Your Video</h3>
<?php if(isset($_GET['process']) && $_GET['process']=='success'): ?>
	<div class="alert alert-success alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a>
		<strong>Success!</strong> Your video has uploaded successfully.
		<p class="text-center"><a href="http://cms.edexlive.com/shortfilm">Go to main page</a></p> 
	</div>
<?php endif; ?>
<?php if(isset($_GET['process']) && $_GET['process']=='failure'): ?>
	<div class="alert alert-danger  alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a>
		<strong>error! </strong>  Something went wrong.please try again.
		<p class="text-center"><a href="http://cms.edexlive.com/shortfilm">Go to main page</a></p> 
	</div>
<?php endif; ?>
<form method="post" action="<?php print 'http://cms.edexlive.com/user/commonwidget/save_video' ?>" id="file_form" enctype="multipart/form-data">
<div class="row">
<div class="form-group-n">
	<label>Title of the film <sup>*</sup></label>
	<input type="text" id="film_title" name="film_title" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter title of the film">
	<p class="custom_error"></p>
</div>
<div class="form-group-n">
	<label>Duration <sup>*</sup></label>
	<input type="text" id="duration" name="duration" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter Video duration">
	<p class="custom_error"></p>
</div>
</div>
<div class="row">
<div class="form-group-n">
	<label>Dropbox upload link <sup>*</sup></label>
	<input type="url" id="upload_link" name="upload_link" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter Dropbox upload link">
	<p class="custom_error"></p>
</div>
<div class="form-group-n">
	<label>Language <sup>*</sup></label>
	<input type="text" id="language" name="language" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter Language">
	<p class="custom_error"></p> 
</div>
</div>
<div class="row">
<div class="form-group-n">
	<label>Summary of film <sup>*</sup></label>
	<input type="text" id="summary" name="summary" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter Summary of film">
	<p class="custom_error"></p> 
</div>
<div class="form-group-n">
	<label>Year and month of completion <sup>*</sup></label>
	<input type="text" id="year_month" name="year_month" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter Year and month of completion">
	<p class="custom_error"></p> 
</div>
</div>
<div class="form-group-s">
	<label>Location of team members <sup>*</sup></label>
	<input type="text" class="form-control" id="location" name="location" data-toggle="tooltip" data-placement="top" title="Enter Location of team members">
	<p class="custom_error"></p> 
</div>
<div class="form-group-s">
	<label>Team members</label>
</div>

<div class="form-group-s">
	<button class="btn single-button add_description" style="width:auto;" data-toggle="tooltip" data-placement="top" title="Add Team Members Details"><i class="fa fa-plus-square" aria-hidden="true"></i> </button>
</div>
<div class="row">
<div class="form-group-n">
	<label>Equipment used  <sup>*</sup></label>
	<input type="text" id="equipment" name="equipment" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter Equipment used" placeholder="(please specify camera make/model)">
	<p class="custom_error"></p> 
</div>
<div class="form-group-n">
	<label>Other festivals/awards <sup>*</sup></label>
	<input type="text" id="awards" name="awards" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter Other festivals/awards">
	<p class="custom_error"></p> 
</div>
</div>
<div class="checkbox">
    <label id="terms_1"><input type="checkbox" id="terms" value="">I have read the rules of the competition and attest that my film adheres to them in every regard</label>
	<p class="custom_error"></p> 
</div>
<input type="hidden" id="description_count" name="description_count" value="0">
<div class="form-group-s text-center">
	<button type="button" class="btn single-button review_file" name=""><i class="fa fa-floppy-o" aria-hidden="true"></i>  Review</button>
	<button type="submit" class="btn single-button save_file" name="save_file"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Submit</button>
</div>
</form>
<script>
var description_count=1;
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	$('.add_description').click(function(e){
		e.preventDefault();
		$(this).parent('.form-group-s').before('<div class="form-group-s team_members_'+description_count+'" style="border-bottom: 2px solid #f4981d;"><span style="float: left;width: 100%;font-weight: bold;">'+description_count+'.</span><div class="form-group-n"><input type="text" class="form-control" placeholder="Enter team member name" id="member_name_'+description_count+'" name="member_name_'+description_count+'"><p class="custom_error"></p> </div><div class="form-group-n"><input type="text" class="form-control" placeholder="Enter team member role" id="member_role_'+description_count+'" name="member_role_'+description_count+'"><p class="custom_error"></p> </div><div class="form-group-n"><input type="text" class="form-control" placeholder="Enter team member college" id="member_college_'+description_count+'" name="member_college_'+description_count+'"><p class="custom_error"></p> </div><div class="form-group-n"><input type="date" class="form-control" placeholder="Enter team member DOB" id="member_dob_'+description_count+'" name="member_dob_'+description_count+'"><p class="custom_error"></p> </div><div class="form-group-s"><input type="text" class="form-control" placeholder="Enter team member contact" id="member_contact_'+description_count+'" name="member_contact_'+description_count+'"><p class="custom_error"></p> </div></div>');
		if(description_count==1){
		$(this).after('<button style="margin-left: 6px;width: auto;" class="btn single-button remove_description" data-toggle="tooltip" data-placement="top" title="remove more description"><i class="fa fa-minus-square" aria-hidden="true"></i></button>');
		}
		$('#description_count').val(description_count);
		description_count++;
	});
	$(document).on('click','.remove_description',function(e){
		e.preventDefault();
		var count=$('#description_count').val();
		$('.team_members_'+count).remove();
		description_count=count;
		$('#description_count').val(count-1);
		if(description_count==1){
			$('.remove_description').remove();
		}
		
	});
	$('.save_file').on('click',function(e){
		e.preventDefault();
		var error_count=0;
		var regex = /^[a-zA-Z ]{2,30}$/;
		var phone_regex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/; 
		var email_regex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i; 
		var film_title=$('#film_title').val();
		var duration=$('#duration').val();
		var upload_link=$('#upload_link').val();
		var language=$('#language').val();
		var summary=$('#summary').val();
		var year_month=$('#year_month').val();
		var location=$('#location').val();
		var equipment=$('#equipment').val();
		var awards=$('#awards').val();
		if(!regex.test(film_title.trim())){
			error_count++;
			$('#film_title').next('.custom_error').html('Enter a Valid Title');
		}else{
			$('#film_title').next('.custom_error').html('');
		}
		if(duration.trim()=='' || duration.trim()==null){
			error_count++;
			$('#duration').next('.custom_error').html('Enter a Valid Duration');
		}else{
			$('#duration').next('.custom_error').html('');
		}
		if(upload_link.trim()=='' || upload_link.trim()==null){
			error_count++;
			$('#upload_link').next('.custom_error').html('Enter a Valid Dropbox Link');
		}else{
			$('#upload_link').next('.custom_error').html('');
		}
		if(!regex.test(language.trim())){
			error_count++;
			$('#language').next('.custom_error').html('Enter a Valid Language');
		}else{
			$('#language').next('.custom_error').html('');
		}
		if(!regex.test(summary.trim())){
			error_count++;
			$('#summary').next('.custom_error').html('Enter a Valid Summary');
		}else{
			$('#summary').next('.custom_error').html('');
		}
		if(year_month.trim()=='' || year_month.trim()==null ){
				error_count++;
				$('#year_month').next('.custom_error').html('Enter a Year and month of completion');
		}else{
			$('#title').next('.custom_error').html('');
		}
		
		if(location.trim()=='' || location.trim()==null ){
				error_count++;
				$('#location').next('.custom_error').html('Enter a Valid Location');
		}else{
			$('#location').next('.custom_error').html('');
		}
		if(equipment.trim()=='' || equipment.trim()==null ){
				error_count++;
				$('#equipment').next('.custom_error').html('Enter a Valid Equipment used ');
		}else{
			$('#equipment').next('.custom_error').html('');
		}
		if(awards.trim()=='' || awards.trim()==null ){
				error_count++;
				$('#awards').next('.custom_error').html('Enter a Valid Other festivals/awards');
		}else{
			$('#awards').next('.custom_error').html('');
		}
		if($('#terms').is(":checked")){
			$('#terms_1').next('.custom_error').html('');
		}else{
			error_count++;
			$('#terms_1').next('.custom_error').html('Please Check the rules of the competition ');
		}
		
		var description_list=$('#description_count').val();
		for(var i=1;i<=description_list;i++){
			var name=$('#member_name_'+i).val();
			var role=$('#member_role_'+i).val();
			var college=$('#member_college_'+i).val();
			var dob=$('#member_dob_'+i).val();
			var contact=$('#member_contact_'+i).val();
			if(name.trim()=='' || name.trim()==null ){
				error_count++;
				$('#member_name_'+i).next('.custom_error').html('Enter a Valid Name');
			}else{
				$('#member_name_'+i).next('.custom_error').html('');
			}
			if(college.trim()=='' || college.trim()==null ){
				error_count++;
				$('#member_college_'+i).next('.custom_error').html('Enter a Valid College');
			}else{
				$('#member_college_'+i).next('.custom_error').html('');
			}
			if(role.trim()=='' || role.trim()==null ){
				error_count++;
				$('#member_role_'+i).next('.custom_error').html('Enter a Valid Role');
			}else{
				$('#member_role_'+i).next('.custom_error').html('');
			}
			if(dob.trim()=='' || dob.trim()==null ){
				error_count++;
				$('#member_dob_'+i).next('.custom_error').html('Enter a Valid DOB');
			}else{
				$('#member_dob_'+i).next('.custom_error').html('');
			}
			if(contact.trim()=='' || contact.trim()==null ){
				error_count++;
				$('#member_contact_'+i).next('.custom_error').html('Enter a Valid Contact');
			}else{
				$('#member_contact_'+i).next('.custom_error').html('');
			}
		}
		if(error_count==0){
			$('#file_form').submit();
		}
		
	});
	$('.review_file').on('click',function(){
	$(this).prop('disabled',true);
	var tof=$('#film_title').val();
	var duration=$('#duration').val();
	var upload_link=$('#upload_link').val();
	var language=$('#language').val();
	var summary=$('#summary').val();
	var year_month=$('#year_month').val();
	var location=$('#location').val();
	var list=$('#description_count').val();
		var template='';
		template +='<div class="col-md-6 col-md-offset-3 review-fields">';
		template +='<h4 class="text-center review-title">Review Your Data</h4>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Title of the film  : '+tof+' </label>';
		template +='</div>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Duration  : '+duration+' </label>';
		template +='</div>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Dropbox upload link  : '+upload_link+' </label>';
		template +='</div>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>language  : '+language+' </label>';
		template +='</div>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Summary of film   : '+summary+' </label>';
		template +='</div>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Year and month of completion    : '+year_month+' </label>';
		template +='</div>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Location of team members    : '+location+' </label>';
		template +='</div>';
			for(var i=1;i<=list;i++){
			template +='<div class="form-group" style="padding-left: 15px;">';
			template +='<label>Member Name    : '+$('#member_name_'+i).val()+' </label><br>';
			template +='<label>Member Role    : '+$('#member_role_'+i).val()+' </label><br>';
			template +='<label>Member College    : '+$('#member_college_'+i).val()+' </label><br>';
			template +='<label>Member DOB    : '+$('#member_dob_'+i).val()+' </label><br>';
			template +='<label>Member Contact    : '+$('#member_contact_'+i).val()+' </label><br>';
			template +='</div>';
			}
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Equipment used    : '+$('#equipment').val()+' </label>';
		template +='</div>';
		template +='<div class="form-group" style="padding-left: 15px;">';
		template +='<label>Other festivals/awards    : '+$('#awards').val()+' </label>';
		template +='</div>';
		template +='<div class="form-group text-right" style="padding-left: 15px;">';
		template +='<button class="btn btn-primary close-review" style="margin-right: 10px;background: #f4981d;  border: #f4981d;">Close</button>';
		template +='</div>';
		template +='</div>';
		$('body').append(template);
	});
	$(document).on('click','.close-review',function(){
		$('.review-fields').remove();
		$('.review_file').prop('disabled',false);
		
	});
});
</script>

<?php endif; ?>
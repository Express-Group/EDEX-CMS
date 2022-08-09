<!DOCTYPE html>
<html>
<head>
	<title><?php print $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.angularjs.org/1.2.0/angular-animate.min.js" ></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<style>
	html{
		--width--100--:100%;
		--float--left--:left;
		--background--:#3c8dbc;
	}
	html,body{
		font-family: 'Roboto', sans-serif ;
	}
	body{
		background:#f1f1f1;
	}
	header{
		width:var(--width--100--);
		float:var(--float--left--);
		padding: 8px;
		background: var(--background--);
		color: #fff;
	}
	.edex-button{
		background: #31759c;
		border: none;
		padding: 10px;
		box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.08);
		color: #fff;
		float: right;
		text-decoration: none !important
	}
	.edex-button:hover{ color: #fff; }
	section{
		width:var(--width--100--);
		float:var(--float--left--);
	}
	.inner-content{
		margin: 2% 2% 2%;
		width: 96%;
		padding: 13px;
		background: #fff;
		float:var(--float--left--);
		box-shadow:0 1px 3px -1px rgba(0, 0, 0, .4);
	}
	table{
		    border: 1px solid #31759c;
	}
	.tbl_heading{
		 background: #31759c;
		color: #fff;
		text-transform:uppercase;
	}
	.edex-edit-button,.edex-edit-button:active,.edex-edit-button:focus,.edex-edit-button:hover{
		border: none;
		border-radius: 0;
		background: #31759c;
		color: #fff;
	}
	.pagination{
		width: 100%;
    text-align: center;
	}
	.pagination a,.pagination strong{
		background: #31759c;
		color: #fff;
		padding: 8px 10px 8px;
	}
	.pagination strong{
		background:rgba(49, 117, 156, 0.65);
	}
	
	sup{color:#f00;}
.border-button{
	width: 25%;
    background: #fff;
    border: 1px solid #31759c;
	outline:none !important;
	border-radius: 0;
}
.single-button,.single-button:hover,.single-button:active,.single-button:focus{
	width: 25%;
    background: #31759c;
    color: #fff;
    border: 1px solid #31759c;
	outline:none !important;
	border-radius: 0;
}
.custom_error{
	margin-top: 2px;
    color: #f00;
}

.filters{
	width:100%;
	text-align:right;
	margin-bottom:1%;
}
.filters input{
	border: 1px solid #3c8dbc;
    width: 20%;
    height: 32px;
    padding: 6px;
}
.table td,.table th{text-align:center;}
.short_film_buttom{
	border: none;
    border-radius: 0;
    background: #31759c;
    color: #fff !important;
}
	</style>
</head>
<body ng-app="shortfilm" ng-controller="manager">
	<header>
		<div class="col-md-2">
			
		</div>
		<div class="col-md-8 text-center">
			<h4>SHORT FILM MANAGER</h4>
		</div>
		<div class="col-md-2 text-right">
			<a class="edex-button" ng-href="<?php print $url.folder_name?>">GO BACK</a>
		</div>
	</header>
	<section>
		<div class="inner-content">
			<div class="filters pull-right">
			<input type="search" ng-model="tbl_search" placeholder="Search Your Keyword">
			</div>
			 <table class="table table-hover">
				<thead>
				<tr class="tbl_heading">
					<th>{{th.name}}</th>
					<th>{{th.language}}</th>
					<th>{{th.summary}}</th>
					<th>{{th.ap_status}}</th>
					<th>{{th.created_on}}</th>
					<th>{{th.action}}</th>
				</tr>
				</thead>
				<tbody>
					<tr ng-repeat="tblrows in rows | filter:tbl_search"  class="tr_{{tblrows.sid}}">
						<td>{{ tblrows.title}}</td>
						<td>{{ tblrows.language}}</td>
						<td>{{ tblrows.summary}}</td>
						<td ng-if="tblrows.approval_status==0" ng-style="not_ap">NOT APPROVED</td>
						<td ng-if="tblrows.approval_status==1" ng-style="ap">APPROVED</td>
						<td >{{tblrows.created_on}}</td>
						<td ><button class="btn short_film_buttom" ng-click="edit($event,$index)"><i class="fa fa-pencil" aria-hidden="true"></i></button><button class="btn short_film_buttom" style="margin-left:5px;" ng-click="delete($event)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
					</tr>
					
				</tbody>
			</table>
			<div pagination  class="pagination" ng-bind-html="pagination |unsafe">
				
			</div>
		</div>
	</section>
	
	
<!--MODAL BOX-->
<button type="button" data-toggle="modal" data-target="#edit_box" id="editor" ng-hide="true">Open Modal</button>
<div class="modal fade" id="edit_box" role="dialog" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center" ng-bind="shortfilm_title" style="font-weight:bold;"></h4>
        </div>
		
        <div class="modal-body">
			<div ng-style="modal_row">
				<div class="form-group">
					<input type="hidden" ng-model="sid_edit">
					<input type="checkbox" ng-checked="shortfilm_ap_status" ng-model="shortfilm_ap_status">
					<label ng-if="shortfilm_ap_status==1" ng-style="ap_text">Approved</label>
					<label ng-if="shortfilm_ap_status==0" ng-style="ap_text_error">Not Approved</label>
				</div>
			</div>
			
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Title of the film <sup>*</sup></label>
					<input type="text" name="shortfilm_title" class="form-control" ng-model="shortfilm_title" required>
					<span class="custom_error" ng-show="er_title">Enter a valid title</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Duration <sup>*</sup></label>
					<input type="text" name="shortfilm_duration" class="form-control" ng-model="shortfilm_duration">
					<span class="custom_error" ng-show="er_duration">Enter a valid duration</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Dropbox upload link <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="shortfilm_link" name="shortfilm_link">
					<span class="custom_error" ng-show="er_dlink">Enter a valid Dropbox link</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Youtube link <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="youtube_link">
					<span class="custom_error" ng-show="er_ylink">Enter a valid Youtube link</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Language  <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="shortfilm_language">
					<span class="custom_error" ng-show="er_language">Enter a valid Language</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Summary of film  <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="shortfilm_summary">
					<span class="custom_error" ng-show="er_summary">Enter a valid Language</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Year and month of completion  <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="shortfilm_year">
					<span class="custom_error" ng-show="er_year">Enter a valid Year and month of completion</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Location of team members <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="shortfilm_location">
					<span class="custom_error" ng-show="er_location">Enter a valid Location</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Equipment used(please specify camera make/model) <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="shortfilm_equipment">
					<span class="custom_error" ng-show="er_equipment">Enter a valid Equipment used</span>
				</div>
			</div>
			<div ng-style="modal_row">
				<div class="form-group">
					<label>Other festivals/awards <sup>*</sup></label>
					<input type="text" class="form-control" ng-model="shortfilm_awards">
					<span class="custom_error" ng-show="er_awards">Enter a valid Other festivals/awards</span>
				</div>
			</div>
			<div ng-style="modal_row" id="dynamic_fields">
				<input type="hidden" ng-model="member_count">
				<label style="width:100%">Team Members</label>
				<table class="table table-hover">
					<tr>
						<th>Member Name</th>
						<th>Member Role</th>
						<th>Member College</th>
						<th>Member DOB</th>
						<th>Member Contact</th>
					</tr>
					<tr ng-repeat="tables in table" ng-if="tbl_count!=0">
						<td><input  class="form-control" type="text" id="name_{{$index}}" value="{{ tables.name}}"><span class="custom_error" id="er_name{{$index}}"></span></td>
						<td><input  class="form-control" type="text" id="role_{{$index}}" value="{{ tables.role}}"><span class="custom_error" id="er_role{{$index}}"></span></td>
						<td><input  class="form-control" type="text" id="college_{{$index}}" value="{{ tables.college}}"><span class="custom_error" id="er_college{{$index}}"></span></td>
						<td><input  class="form-control" type="text" id="dob_{{$index}}" value="{{ tables.dob}}"><span class="custom_error" id="er_dob{{$index}}"></span></td>
						<td><input  class="form-control" type="text" id="contact_{{$index}}" value="{{ tables.contact}}"><span class="custom_error" id="er_contact{{$index}}"></span></td>
					</tr>
				</table>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" ng-click="save()">Publish</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<!--END-->

</body>

<script>
	var app=angular.module("shortfilm",['ngSanitize']);
	app.filter('unsafe', function($sce) { return $sce.trustAsHtml; });
	app.controller("manager",function($scope,$http,$compile){
		$scope.ap_text_error={"color":"red"};
		$scope.ap_text={"color":"green"};
		$scope.not_ap={"color":"#f00","font-weight":"bold"};
		$scope.ap={"color":"#4CAF50","font-weight":"bold"};
		$scope.modal_row={"width":"100%","margin-bottom":"10px"};
		var pager = 0;
		$scope.th={"name":"Name of the film","language":"language","summary":"summary","ap_status":"aproval status","created_on":"created on","action":"action"};
		$scope.edit=function($event,$index){
			$scope.myindex=$index;
			var Class=$($event.target).parents('tr').attr('class').split('_');
			Class =Class[1];
			var datas=$.param({'sid':Class});
			$http({
				method:'POST',
				url :'<?php print $url.folder_name?>/short_film/GetDetails',
				data: datas,
				headers:{ 'Content-Type' : 'application/x-www-form-urlencoded'}
			
			}).then(function success(response){
				var res=response.data.result;
				$scope.sid_edit=res[0].sid;
				$scope.shortfilm_title=res[0].title;
				$scope.shortfilm_duration=res[0].duration;
				$scope.shortfilm_link=res[0].dropbox_link;
				$scope.youtube_link=res[0].youtube_link;
				$scope.shortfilm_language=res[0].language;
				$scope.shortfilm_summary=res[0].summary;
				$scope.shortfilm_year=res[0].year_month_competition;
				$scope.shortfilm_location=res[0].member_location;
				$scope.shortfilm_equipment=res[0].equipment_used;
				$scope.shortfilm_awards=res[0].awards;
				if(res[0].approval_status==1){
					$scope.shortfilm_ap_status=true;
				}else{
					$scope.shortfilm_ap_status=false;
				}
				
				if(res[0].teammembers=='' || res[0].teammembers==null || res[0].teammembers==undefined){
						$scope.tbl_count=0;
						$scope.member_count=0;
				}else{
				var member=JSON.parse(res[0].teammembers);
				var member_length=member.details.length;
				
				if(member_length==0 || member_length==null || member_length==undefined){
				$scope.tbl_count=0;
				$scope.member_count=0;
				}else{
				$scope.tbl_count=1;
				$scope.member_count=member_length;
				}
				var template=[];
				for(var i=0;i<member_length;i++){
					template.push({name:member.details[i].name,role:member.details[i].role,college:member.details[i].college,dob:member.details[i].dob,contact:member.details[i].contact});
					
				}
				$scope.table=template;
				}
				document.querySelector('#editor').click();
			},function error(response){
			
			});
			
		};
		$scope.delete=function($event){
			var Class=$($event.target).parents('tr').attr('class').split('_');
			Class =Class[1];
			alert(Class);
		};
		$scope.save=function(){
			var count=0;
			//alert($scope.shortfilm_ap_status);
			var status=$scope.shortfilm_ap_status;
			if($scope.shortfilm_title=='' || $scope.shortfilm_title==undefined){ $scope.er_title=1;count ++; }else{ $scope.er_title=0; }
			if($scope.shortfilm_duration=='' || $scope.shortfilm_duration==undefined){ $scope.er_duration=1;count ++; }else{ $scope.er_duration=0; }
			if($scope.shortfilm_link=='' || $scope.shortfilm_link==undefined){ $scope.er_dlink=1;count ++; }else{ $scope.er_dlink=0; }
			if($scope.youtube_link=='' || $scope.youtube_link==undefined){ $scope.er_ylink=1;count ++; }else{ $scope.er_ylink=0; }
			if($scope.shortfilm_language=='' || $scope.shortfilm_language==undefined){ $scope.er_language=1;count ++; }else{ $scope.er_language=0; }
			if($scope.shortfilm_summary=='' || $scope.shortfilm_summary==undefined){ $scope.er_summary=1;count ++; }else{ $scope.er_summary=0; }
			if($scope.shortfilm_year=='' || $scope.shortfilm_year==undefined){ $scope.er_year=1;count ++; }else{ $scope.er_year=0; }
			if($scope.shortfilm_location=='' || $scope.shortfilm_location==undefined){ $scope.er_location=1;count ++; }else{ $scope.er_location=0; }
			if($scope.shortfilm_equipment=='' || $scope.shortfilm_equipment==undefined){ $scope.er_equipment=1;count ++; }else{ $scope.er_equipment=0; }
			if($scope.shortfilm_awards=='' || $scope.shortfilm_awards==undefined){ $scope.er_awards=1;count ++; }else{ $scope.er_awards=0; }
			if($scope.shortfilm_ap_status==1 && ($scope.youtube_link=='' || $scope.youtube_link==undefined )){
				alert('Please fill the youtube link field (or) Change the aproval status');
				count ++;
			}
			var ar_name='';
			var ar_role='';
			var	ar_college='';
			var ar_dob='';
			var	ar_contact='';
			if($scope.member_count!=0){
				for(var $i=0;$i<$scope.member_count;$i++){
					var name=document.querySelector('#name_'+$i).value;
					var role=document.querySelector('#role_'+$i).value;
					var college=document.querySelector('#college_'+$i).value;
					var dob=document.querySelector('#dob_'+$i).value;
					var contact=document.querySelector('#contact_'+$i).value;
					if(name=='' || name==undefined){ count++; document.querySelector('#er_name'+$i).innerHTML="Enter a valid Name"; }else{document.querySelector('#er_name'+$i).innerHTML="";}
					if(role=='' || role==undefined){ count++; document.querySelector('#er_role'+$i).innerHTML="Enter a valid Role"; }else{document.querySelector('#er_role'+$i).innerHTML="";}
					if(college=='' || college==undefined){ count++; document.querySelector('#er_college'+$i).innerHTML="Enter a valid College"; }else{document.querySelector('#er_college'+$i).innerHTML="";}
					if(dob=='' || dob==undefined){ count++; document.querySelector('#er_dob'+$i).innerHTML="Enter a valid DOB"; }else{document.querySelector('#er_dob'+$i).innerHTML="";}
					if(contact=='' || contact==undefined){ count++; document.querySelector('#er_contact'+$i).innerHTML="Enter a valid Contact"; }else{document.querySelector('#er_contact'+$i).innerHTML="";}
					ar_name += name+'|~|'; ar_role += role+'|~|'; ar_college += college+'|~|'; ar_dob += dob+'|~|'; ar_contact += contact+'|~|';
				}
			}
			if(count==0){
				var parameter = $.param({title:$scope.shortfilm_title,duration:$scope.shortfilm_duration,dropbox_link:$scope.shortfilm_link,youtube_link:$scope.youtube_link,language:$scope.shortfilm_language,summary:$scope.shortfilm_summary,year:$scope.shortfilm_year,location:$scope.shortfilm_location,equipment:$scope.shortfilm_equipment,awards:$scope.shortfilm_awards,approval_status:$scope.shortfilm_ap_status,member_name:ar_name,member_role:ar_role,member_college:ar_college,member_dob:ar_dob,member_contact:ar_contact,member_count:$scope.member_count,sid:$scope.sid_edit});
				$http({
					method: 'POST',
					url: '<?php print $url.folder_name?>/short_film/updateRows',
					data:parameter,
					headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
				})
				.then(function success(response){
				//alert(response.data);
					if(response.data==1){
						alert('Row updated successfully');
						$('#edit_box').modal('hide');
						$scope.rows[$scope.myindex].approval_status=$scope.shortfilm_ap_status;
						$scope.rows[$scope.myindex].title=$scope.shortfilm_title;
						$scope.rows[$scope.myindex].language=$scope.shortfilm_language;
						$scope.rows[$scope.myindex].summary=$scope.shortfilm_summary;
						
					}else{
						alert('Something went wrong.try again');
					}
						
				},function error(response){
				});
				
			}
		};
		var datas = $.param({ per_page: 6,page:pager });
		$http({
			method: 'POST',
			url: '<?php print $url.folder_name?>/short_film/getRows',
			data:datas,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.then(function success(response){
			$scope.rows = response.data.records;
			$scope.pagination=response.data.pagination;			
		},function error(response){
			if(response.status==400 || response.status==500){
			
			}
		});
		 
	});
	
	app.directive('pagination', function($http){ 
		return {
			restrict: 'A', //attribute only
			link: function(scope, elem, attr, ctrl) {
				elem.bind('click',function(e){
					e.preventDefault();
					if(e.target.href !=undefined){
						var href=e.target.href.split('?');
						href=href[1].split('=');
						href=href[1];
						var datas = $.param({ per_page: 6,page:href });
						$http({
							method: 'POST',
							url: '<?php print $url.folder_name?>/short_film/getRows',
							data:datas,
							headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
						})
						.then(function success(response){
							scope.rows = response.data.records;
							scope.pagination=response.data.pagination;			
						},function error(response){
							if(response.status==400 || response.status==500){
			
							}
						});
					}
				});
			}
		};
	}); 
</script>
</html>
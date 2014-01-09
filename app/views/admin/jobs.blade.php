@extends('orchestra/foundation::layout.main')

@section('content')

<table class="table table-striped table-bordered">

 	@foreach($jobs as $job)


 	<tr>
 		<td><input type="checkbox"  class="chkID" data-id={{ $job->id }}> </td>
 		<td><img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail"></td>
 		<td>{{ $job->job_title }}</td>
 	



	 		<td>{{ $job->company_name }}</td>
	 		<td>{{ $job->job_location }}</td>
	 		<td><a href="#myModal{{$job->id}}" role="button" class="btn" data-toggle="modal">
	 			{{ $job->getApprovalStatus($job->id) }}</a>
	 		</td>

	 		<td> {{ HTML::link('admin/job/'.$job->id.'/edit','Edit') }} | {{ HTML::link('admin/job/'.$job->id.'/delete','Delete') }}</td>
	 	
	 	</tr>

 	<!-- Modal -->

		<div id="myModal{{$job->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="		true" style="width:450px; margin: 58px auto; background-color:#e3e3e3;">

	  		<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			    <h3 id="myModalLabel">You are Disapporiving </h3>
	    	</div>
		  <div class="modal-body">
		  		<div class="col-md-8">
				   <img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail">
				    {{ HTML::link('job/'.$job->id.'/detail',$job->job_title) }}
				</div>
				<div class="col-md-4">
						{{ $job->job_type }}
				</div>
				<div class="col-md-10">
					{{ $job->company_name }}
					{{ $job->job_location }}
				</div>
				<div style="margin-bottom:15px;" class="col-md-10">
				{{ Form::open(array('url'=>'admin/job/disapprove','POST'))}}
					{{ Form::textarea('disapprove_reason')}}
					{{ Form::hidden('id',$job->id)}}

				
				</div>
				<div class="modal-footer">
				    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				    {{ Form::hidden('approval_status',$job->approved)}}
				    {{ Form::submit($job->getApprovalStatus($job->id),array('class'=>'btn btn-primary')) }}
				    {{ Form::close() }}
		  		</div>
		</div>
	</div>
		
 	@endforeach
 	<input type="checkbox" id="selectall">
 	{{ Form::label('selectall','Select All')}}

</table>
{{ Form::open(array('url'=>'admin/approve/all','POST')) }}
	{{ Form::hidden('approveId','',array('id'=>'approveID')) }}
	{{ Form::submit('Approve All',array('class'=>'btn btn-success'))}}
{{ Form::close() }}

<script>
	$(document).ready(function(){

	$("#selectall").change(function(){
	    var status = $(this).is(":checked") ? true : false;
	    $(".chkID").prop("checked",status);
	    
	
	    var vals = new Array();
    $("input:checkbox").each(function(){
  
	    if($(this).is(":checked")){

	        
	    	vals.push($(this).data("id"));
	        
	    }
	});
	console.log(vals);
});




		$("div .container").html("<h2>Admin Listings</h2>");

		 /*-------------------------------------*/

    $(".navbar-nav:first-child").append('<li><a href="/admin/extensions">Extensions</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="/admin/users">Users</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="/admin/jobs">Jobs</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="/admin/settings">Settings</a></li>');

    /*-----------------------------------------------------------------------------------*/

    });

</script>
@stop

@extends('orchestra/foundation::layout.main')

@section('content')

<table class="table table-striped table-bordered">
 	@foreach($jobs as $job)
 	<tr>
 	
 		<td><img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail"></td>
 		<td>{{ $job->job_title }}</td>
 	


 		<td>{{ $job->company_name }} </td>
 		<td>{{ $job->job_location }}</td>
 		<td><a href="#myModal" role="button" class="btn" data-toggle="modal">Approve</a></td>

 		<td> {{ HTML::link('admin/job/'.$job->id.'/edit','Edit') }} | {{ HTML::link('admin/job/'.$job->id.'/delete','Delete') }}</td>
 	
 	</tr>

 	<!-- Modal -->
		<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:450px; margin: 58px auto; background-color:#e3e3e3;">
	  		<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			    <h3 id="myModalLabel">You are Disaporiving </h3>
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
		{{ Form::textarea('description')}}
		</div>
		  <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button class="btn btn-primary">Disaproved</button>
		  </div>
</div>
 	@endforeach
</table>
<script>
	$(document).ready(function(){

		$("div .container").html("<h2>Admin Listings</h2>");

		 /*-------------------------------------*/
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/extensions">Extensions</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/users">Users</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/jobs">Jobs</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/settings">Settings</a></li>');
    });

</script>
@stop

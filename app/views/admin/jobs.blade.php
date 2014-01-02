@extends('orchestra/foundation::layout.main')

@section('content')

<table class="table table-striped">
 	@foreach($jobs as $job)
 	<tr>
 	
 		<td><img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail"></td>
 		<td>{{ $job->job_title }}</td>
 	


 		<td>{{ $job->company_name }} </td>
 		<td>{{ $job->job_location }}</td>
 		<td>{{ HTML::link('#',$job->approved($job->approved)) }}</td>
 		<td> {{ HTML::link('admin/job/'.$job->id.'/edit','Edit') }} | {{ HTML::link('admin/job/'.$job->id.'/delete','Delete') }}</td>
 	
 	</tr>
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

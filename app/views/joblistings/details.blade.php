@extends('layouts.scaffold')

@section('main')
<div style="width:700px; margin:0 auto;">
<table class="table table-striped ">
	<tr>
		<td>
			<img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail">
		</td>
	</tr>	
	<tr>
		<td>
			<a href="" target="_blank">Visit company website</a>
		</td>
	</tr>	
	<tr>
		<td>
			{{ $job->company_name }}
		</td>
	</tr>	
	<tr>
		<td>
			{{ $job->job_location }}
		</td>	
	</tr>
		
	<tr>
		<td>
			{{ $job->job_title }}
		</td>
	</tr>


	<tr>

		<td>
						
			{{  $job->created_at }}
		</td>
	</tr>

	<tr>
		<td>
			{{ $job->job_description }}
		</td>
	</tr>

	<tr>
		<td>
			<h3>How to Apply</h3>
			<p>Email resumes to: <b>info@example.com</b> </p>
		</td>
	</tr>	
	<tr>
		<td>
		{{ HTML::link('job/'.$job->id.'/apply', 'Apply to job',array('class'=>'btn btn-primary pull-right'))}}
		</td>
	</tr>	
</table>
</div>
@stop
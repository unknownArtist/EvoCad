@extends('layouts.scaffold')

@section('main')

	<ul>
		<li>
			{{ $job->job_title }}
		</li>
		<li>
			{{ $job->company_name }}
		</li>
		<li>
			{{ $job->job_location }}
		</li>
		<li>
			{{ $job->created_at }}
		</li>
		<li>
			{{ $job->job_description }}
		</li>

		{{ HTML::link('job/'.$job->id.'/apply', 'Apply to job',array('class'=>'btn btn-primary'))}}

	</ul>
@stop
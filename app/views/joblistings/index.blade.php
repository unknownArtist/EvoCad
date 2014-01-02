@extends('layouts.scaffold')

@section('main')

<h1>Job Listings</h1>

<p>{{ link_to_route('JobListings.create', 'Add new Job') }}</p>

@if ($JobListings->count())
<div class="row show-grid">
	@foreach ($JobListings as $job)

	<img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail">

		<div class="col-md-8">{{ HTML::link('job/'.$job->id.'/detail',$job->job_title) }}</div>
		{{ $job->company_name }}
		<div class="col-md-4 pull-right">
			{{ $job->job_location }},
			{{ $job->job_type }}
		</div>
	<hr>
	@endforeach
</div>
@else
	There are no JobListings
@endif

@stop

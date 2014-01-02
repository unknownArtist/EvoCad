@extends('layouts.scaffold')

@section('main')

<h1>Edit JobListing</h1>
{{ Form::model($JobListing, array('method' => 'PATCH', 'route' => array('JobListings.update', $JobListing->id))) }}
	<ul>
        <li>
            {{ Form::label('job_title', 'Job_title:') }}
            {{ Form::text('job_title') }}
        </li>

        <li>
            {{ Form::label('job_type', 'Job_type:') }}
            {{ Form::text('job_type') }}
        </li>

        <li>
            {{ Form::label('job_description', 'Job_description:') }}
            {{ Form::text('job_description') }}
        </li>

        <li>
            {{ Form::label('job_location', 'Job_location:') }}
            {{ Form::text('job_location') }}
        </li>

        <li>
            {{ Form::label('job_relocation', 'Job_relocation:') }}
            {{ Form::checkbox('job_relocation') }}
        </li>

        <li>
            {{ Form::label('job_remotely', 'Job_remotely:') }}
            {{ Form::checkbox('job_remotely') }}
        </li>

        <li>
            {{ Form::label('job_apply_by', 'Job_apply_by:') }}
            {{ Form::text('job_apply_by') }}
        </li>

        <li>
            {{ Form::label('job_instruction', 'Job_instruction:') }}
            {{ Form::textarea('job_instruction') }}
        </li>

        <li>
            {{ Form::label('company_name', 'Company_name:') }}
            {{ Form::text('company_name') }}
        </li>

        <li>
            {{ Form::label('company_name_status', 'Company_name_status:') }}
            {{ Form::checkbox('company_name_status') }}
        </li>

        <li>
            {{ Form::label('company_url', 'Company_url:') }}
            {{ Form::text('company_url') }}
        </li>

        <li>
            {{ Form::label('company_descripton', 'Company_descripton:') }}
            {{ Form::textarea('company_descripton') }}
        </li>

        <li>
            {{ Form::label('company_logo', 'Company_logo:') }}
            {{ Form::text('company_logo') }}
        </li>

        <li>
            {{ Form::label('term_and_conditions', 'Term_and_conditions:') }}
            {{ Form::checkbox('term_and_conditions') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('JobListings.show', 'Cancel', $JobListing->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop

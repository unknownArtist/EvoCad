@extends('layouts.scaffold')

@section('main')

<h1>Create JobListing</h1>

{{ Form::open(array('route' => 'JobListings.store','POST','files'=>true)) }}
	<ul>
        <li>
            {{ Form::label('job_title', 'Job Title') }}
            {{ Form::text('job_title') }}
        </li>

        <li>
            {{ Form::label('job_type', 'Job Type:') }}
            {{ Form::select('job_type',array('Full-time'=>'Full-time','Internship'=>'Internship')) }}
        </li>

        <li>
            {{ Form::label('job_description', 'Description:') }}
            {{ Form::textarea('job_description') }}
        </li>

        <li>
            {{ Form::label('job_location', 'Location:') }}
            {{ Form::text('job_location') }}
        </li>

        <li>
            {{ Form::label('job_relocation', 'Relocation assistance offered for this position') }}
            {{ Form::checkbox('job_relocation') }}
        </li>

        <li>
            {{ Form::label('job_remotely', 'Work can be done from anywhere(i.e telecommuting') }}
            {{ Form::checkbox('job_remotely') }}
        </li>

        <li>
            {{ Form::label('job_apply_by', 'How to apply?') }}
            {{ Form::select('methodURLEmail',array('URL'=>'URL','Email'=>'Email'),'',array('id'=>'method')) }}
        </li>
        <li>
            {{ Form::label('url', 'URL',array('id'=>'jobAppBy')) }}
            {{ Form::text('job_apply_by','') }}
        </li>

        <li>
            {{ Form::label('job_instruction', 'Instruction:') }}
            {{ Form::textarea('job_instruction') }}
        </li>

        <li>
            <h4>Company info</h4>
            {{ Form::label('company_name', 'Company Name') }}
            {{ Form::text('company_name') }}
        </li>

        <li>
            {{ Form::label('company_name_status', 'Hide the company name') }}
            {{ Form::checkbox('company_name_status') }}
        </li>

        <li>
            {{ Form::label('company_url', 'Company URL') }}
            {{ Form::text('company_url') }}
        </li>

        <li>
            {{ Form::label('company_descripton', 'Company Descripton:') }}
            {{ Form::textarea('company_descripton') }}
        </li>

        <li>
            <h4>Company Logo</h4>
            {{ Form::label('company_logo', 'Please select a picture for your company') }}
            {{ Form::file('company_logo') }}
        </li>

        <li>
            {{ Form::label('term_and_conditions', 'Accept term and conditions') }}
            {{ Form::checkbox('term_and_conditions') }}
        </li>

		<li>
			{{ Form::submit('Next step', array('class' => 'btn btn-info')) }}
            {{ HTML::link('job/list','Back',array('class'=>'btn btn-success'))}}
		</li>
	</ul>
{{ Form::close() }}

<script>
    $(document).ready(function(){

        $('#method').change(function(){

            $('#jobAppBy').html($('#method').val());
        });
    });
</script>

@stop



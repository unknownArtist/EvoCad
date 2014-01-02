@extends('orchestra/foundation::layout.main')

@section('content')
<style type="text/css">

</style>
@if ($errors->any())
            <div class="flash alert">
                <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
            </div>
            @endif
{{ Form::model($job, array('method' => 'POST','url'=>'admin/job/update','files'=>true)) }}
	<ul>
        <li>
            {{ Form::label('job_title', 'Job Title') }}
            {{ Form::text('job_title') }}
        </li>

        <li>
            {{ Form::label('job_type', 'Job Type:') }}
            {{ Form::text('job_type') }}
        </li>

        <li>
            {{ Form::label('job_description', 'Description:') }}
            {{ Form::text('job_description') }}
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
            {{ Form::label('url', 'URL',array('id'=>'jobAppBy')) }}
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
            {{ Form::file('company_logo') }}
            <img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail">
        </li>
        <li> 
            {{ Form::label('published',"Publish this job in ")}}
            {{ Form::text('publish','',array('id'=>'date-picker')) }}
        </li>
        
        <li>
            {{ Form::label('term_and_conditions', 'Term_and_conditions:') }}
            {{ Form::checkbox('term_and_conditions') }}
        </li>

		<li>
            {{ Form::hidden('id',$job->id) }}
            {{ Form::hidden('logo',$job->company_logo) }}
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif
<script>
    $(document).ready(function(){

        $('#method').change(function(){

            $('#jobAppBy').html($('#method').val());
        });

    /*-------------------------------------*/
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/extensions">Extensions</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/users">Users</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/jobs">Jobs</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/settings">Settings</a></li>');
    });
</script>

@stop
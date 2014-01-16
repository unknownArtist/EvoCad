@extends('orchestra/foundation::layout.main')

@section('content')

{{ HTML::script('js/bootstrap-datepicker.js')}}
{{ HTML::style('css/datepicker.css')}}


{{ HTML::style('src/bootstrap-wysihtml5.css')}}
{{ HTML::script('lib/js/wysihtml5-0.3.0.js')}}

{{ HTML::script('lib/js/bootstrap.min.js')}}
{{ HTML::script('src/bootstrap3-wysihtml5.js')}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript">
    
</script>
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
            {{ Form::label('job_title', 'Job Title') }}<br>
            {{ Form::text('job_title') }}
        </li>

         <li>
            {{ Form::label('job_type', 'Job Type:') }}
            {{ Form::select('job_type',array('Full-time'=>'Full-time','Internship'=>'Internship')) }}
        </li>

        <li>
            {{ Form::label('job_description', 'Description:') }}<br>
            {{ Form::textarea('job_description') }}
        </li>

        <li>
            {{ Form::label('job_location', 'Location:') }}<br>
            {{ Form::text('job_location') }}
        </li>

        <li>
            {{ Form::label('job_relocation', 'Relocation assistance offered for this position') }}<br>
            {{ Form::checkbox('job_relocation') }}
        </li>

        <li>
            {{ Form::label('job_remotely', 'Work can be done from anywhere(i.e telecommuting') }}<br>
            {{ Form::checkbox('job_remotely') }}
        </li>
         <li>
            {{ Form::label('job_apply_by', 'How to apply?') }}
            {{ Form::select('methodURLEmail',array('URL'=>'URL','Email'=>'Email'),'',array('id'=>'method')) }}
        </li>

        <li>
            {{ Form::label('url', 'URL',array('id'=>'jobAppBy')) }}<br>
            {{ Form::text('job_apply_by') }}
        </li>

        <li>
            {{ Form::label('job_instruction', 'Job_instruction:') }}<br>
            {{ Form::text('job_instruction') }}
        </li>

        <li>
            {{ Form::label('company_name', 'Company_name:') }}<br>
            {{ Form::text('company_name') }}
        </li>

        <li>
            {{ Form::label('company_name_status', 'Hide company name:') }}<br>
           <!--  <input type="checkbox" id="agentshow" name="company_name_status" checked={{ $job->company_name_status }}/> -->
           {{ Form::checkbox('company_name_status')}}
         </li>

        <li>
            {{ Form::label('company_url', 'Company_url:') }}<br>
            {{ Form::text('company_url') }}
        </li>

        <li>
            {{ Form::label('company_descripton', 'Company Descripton:') }}<br>
            {{ Form::textarea('company_descripton',$job->company_descripton, array('id' => 'some-textarea')) }}
        </li>

        <li>
            {{ Form::label('company_logo', 'Company_logo:') }}<br>
            {{ Form::file('company_logo') }}
            <img src="/uploads/company_logo/{{ $job->company_logo }}" alt="..." class="img-thumbnail">
        </li>
        <li> 
            {{ Form::label('published',"Publish this job in ")}}<br>
            {{ Form::text('published',$job->published,array('class'=>'datepicker')) }}
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
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
<script>
    $(document).ready(function(){
        

        $('#method').change(function(){

            $('#jobAppBy').html($('#method').val());
        });
$("#agentshow").click(function(){
     if($(this).is(':checked')){
          $(this).val('1');
     }else{
          $(this).val('0');
     }
});
    /*-------------------------------------*/
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/extensions">Extensions</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/users">Users</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/jobs">Jobs</a></li>');
    $(".navbar-nav:first-child").append('<li><a href="http://localhost:8000/admin/settings">Settings</a></li>');
    });

    $('.datepicker').datepicker({
        'format': 'yyyy-mm-dd'
    }
    );
</script>

 

@stop
@extends('layouts.scaffold')

@section('main')

<h1>Show JobListing</h1>

<p>{{ link_to_route('JobListings.index', 'Return to all JobListings') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Job_title</th>
				<th>Job_type</th>
				<th>Job_description</th>
				<th>Job_location</th>
				<th>Job_relocation</th>
				<th>Job_remotely</th>
				<th>Job_apply_by</th>
				<th>Job_instruction</th>
				<th>Company_name</th>
				<th>Company_name_status</th>
				<th>Company_url</th>
				<th>Company_descripton</th>
				<th>Company_logo</th>
				<th>Term_and_conditions</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $JobListing->job_title }}}</td>
					<td>{{{ $JobListing->job_type }}}</td>
					<td>{{{ $JobListing->job_description }}}</td>
					<td>{{{ $JobListing->job_location }}}</td>
					<td>{{{ $JobListing->job_relocation }}}</td>
					<td>{{{ $JobListing->job_remotely }}}</td>
					<td>{{{ $JobListing->job_apply_by }}}</td>
					<td>{{{ $JobListing->job_instruction }}}</td>
					<td>{{{ $JobListing->company_name }}}</td>
					<td>{{{ $JobListing->company_name_status }}}</td>
					<td>{{{ $JobListing->company_url }}}</td>
					<td>{{{ $JobListing->company_descripton }}}</td>
					<td>{{{ $JobListing->company_logo }}}</td>
					<td>{{{ $JobListing->term_and_conditions }}}</td>
                    <td>{{ link_to_route('JobListings.edit', 'Edit', array($JobListing->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('JobListings.destroy', $JobListing->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop

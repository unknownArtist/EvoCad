<?php

class JobListing extends Eloquent {
	protected $guarded = array();
	protected $table = 'JobListings';
	
	public static $rules = array(
		'job_title' => 'required',
		'job_type' => 'required',
		'job_description' => 'required',
		'job_location' => 'required',
		// 'job_relocation' => 'required',
		// 'job_remotely' => 'required',
		'job_apply_by' => 'required',
		'job_instruction' => 'required',
		'company_name' => 'required',
		// 'company_name_status' => 'required',
		'company_url' => 'required',
		'company_descripton' => 'required',
		'company_logo' => 'required',
		'term_and_conditions' => 'required'
	);

	public function getStatus($status)
	{   
		if($status)
		{
			return "Yes";
		}else
			{
				return "No";
			}
		return false;
	}
	public function approved($approved)
	{
		if($approved)
		{
			return "Disapprove";
		}
		return "Approve";
	}
	public static function search($type = NULL, $location = NULL, $searchTerm = NULL)
	{
		$table = new JobListing();

		if(isset($type))
		{
			$result = $table->where('job_type',$type);
		}
		if(isset($location))
		{
			$result = $table->where('job_location',$location);
		}
		if(isset($searchTerm))
		{
			$result = $table->where('job_title','LIKE','%'.$searchTerm.'%')
							->orwhere('job_type','LIKE','%'.$searchTerm.'%')
							->orwhere('job_location','LIKE','%'.$searchTerm.'%')
							->orwhere('job_desctiption','LIKE','%'.$searchTerm.'%')
							->orwhere('company_name','LIKE','%'.$searchTerm.'%')
							->orwhere('company_desctiption','LIKE','%'.$searchTerm.'%');

		}

		return $result->get();
	}
	public function getApprovalStatus($id)
	{
		$jl = JobListing::find($id);

		if($jl->approved == 0)
		{
			return 'Approve';
		}else
			{
				return 'Disapprove';
			}
	}
}

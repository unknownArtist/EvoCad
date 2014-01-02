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
}

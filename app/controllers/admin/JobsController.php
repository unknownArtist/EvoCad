<?php

class JobsController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.jobs')
				   ->with('jobs',JobListing::paginate(15));
	}
	public function getEdit()
	{
		$id = Request::segment(3);

		return View::make('admin.edit')
				   ->with('job',JobListing::find($id));
	}
	public function postEdit()
	{
		$id = Input::get('id');
		$fields = Input::all();
		$fields['company_logo'] = Input::get('logo');
		unset($fields['_token']);
		unset($fields['logo']);
		$fields['job_relocation'] = Input::get('job_relocation');
		$fields['job_remotely'] = Input::get('job_remotely');
		$fields['company_name_status'] = Input::get('company_name_status');
		
		unset($fields['methodURLEmail']);

		if(Input::get('company_logo'))
		{
			if(Input::get('company_logo') != Input::get('logo'))
			{
				$fields['company_logo'] = $this->ImageCrop('company_logo','company_logo',100,100);
			}
		}
		


		$v = Validator::make($fields, JobListing::$rules);
		if($v->fails())
		{ 
			return Redirect::to('admin/job/'.$id.'/edit')->withErrors($v)->withInput();
		}

		DB::table('JobListings')->where('id',$id)->update($fields);
			return Redirect::to('admin/jobs')->with('message',"Job updated successfully");
	}
}
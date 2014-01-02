<?php

class JoblistingController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{	
		$jobLstng = JobListing::all();
        return View::make('joblistings.index')
        		   ->with('JobListings',$jobLstng);
	}
	public function getCreate()
	{
		return View::make('joblistings.create');
	}
	public function postCreate()
	{
		$fields = Input::all();
		unset($fields['methodURLEmail']);
		$fields['company_logo'] = $this->ImageCrop('company_logo','company_logo',100,100);


		$v = Validator::make($fields, JobListing::$rules);
		if($v->fails())
		{
			return Redirect::to('job/create')->withErrors($v)->withInput();
		}

			if(JobListing::create($fields))
			{
				return Redirect::to('job/list');
			}else
				{
					return Redirect::to('job/list')->with('errors','Job not created');
				}
	}
	public function getDetails()
	{
		$id = Request::segment(2);
		return View::make('joblistings.details')
				   ->with('job',JobListing::find($id));
	}

	
}

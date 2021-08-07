<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Job;
use App\Member;
use Auth;
use App;

class JobController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $jobs = Job::where('flag',0)->paginate(20);
        return view('Admin.Job.index',compact('jobs','user'))->with('no',1);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'job_name' => 'required'
        ]);
        $status = 0;
        $jobs = new Job;
        $jobs->job_name = $request->job_name;
        $jobs->flag = 0;
        $jobs->status = 1;
        if($jobs->save()) {
            $status = 1;
        }
        return response()->json([
            'status' => $status,
            'jobs' => $jobs->toArray(),
        ]);
    }

    public function edit($id)
    {
        $job = Job::where('id', $id)->first();
        return response([
            'job' => $job->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'job_name' => 'required'
        ]);
        $status = 0;
        $job = Job::find($request->id);
        $job->job_name = $request->job_name;

        if ($job->save()) {
          $status = 1;
        }

         return response([
            'status' => $status,
            'job' => $job->toArray()
        ]);
    }

    public function delete($id)
    {
        $status = 0;
        $job = Job::where('id', $id)->first();
        $job->flag = 1;
        $job->save();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function abort()
    {

        // Get the user from authentication
        $user = Auth::user();

        // Check if has not group throw forbidden
        if ($user->role_id != 1) 
        return App::abort(403);

    }

    public function view($id)
    {
        $status = 1;

        $member = Member::where('team_id','=',$id)->get();
    
        return response([
            'status' => $status,
            'member'=>$member
        ]);
    }

    //Search Team
    public function getMorejobs(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $jobs = Job::where('job_name','like','%'.$search.'%')->where('flag',0)->paginate(20);
            $no = 1;
            return view('Admin.Job.page_job',compact('jobs','user','no','search'))->render();
        }
        
    }
}

<?php

namespace App\Http\Controllers\TeamLeader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Timesheet;
use App\Member;
use App\Task;
use App\Job;
use Auth;

class TimeSheetController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $id = Auth::user()->id;
        $date = Carbon::today()->subDays(30);
        $timesheets = Timesheet::where('user_id',$id)->where(function($query) use ($date){
            $query->where('date','>=',$date);
        })->paginate(20);
        $jobs = Job::where('flag',0)->get();
        return view('TeamLeader.Timesheet.index',compact('timesheets','user','jobs'))->with('no',1);
    }

    public function getjobs()
    {
        $status = 0 ;
        $user = Auth::user()->id;
        $jobs = Job::where('flag',0)->get();
        $status = 1;
        return response([
            'status' => $status,
            'jobs' => $jobs
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'date' => 'required|before:tomorrow',
            'job_name' => 'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'remark'=>'required',
        ]);
        $status = 0;
        $user_id = Auth::user()->id;
        $timesheets = new Timesheet;
        $timesheets->date = $request->date;
        $timesheets->user_id = $user_id;
        $timesheets->job_name = $request->job_name;
        $timesheets->start_time = $request->start_time;
        $timesheets->end_time = $request->end_time;
        $t1 =  $request->start_time;
        $t2 =  $request->end_time;
        $time1=strtotime($t2);
        $time2=strtotime($t1);
        $total=( ($time1 - $time2)/60)/60;
        $timesheets->time_taken = $total;
        $timesheets->remark = $request->remark;
        $timesheets->status = 1;
        if($timesheets->save()) {
            $status = 1;
        }
        return response()->json([
            'status' => $status,
            'timesheets' => $timesheets->toArray(),
        ]);
    }

    public function edit($id)
    {
        $timesheet = Timesheet::where('id', $id)->first();
        return response([
            'timesheet' => $timesheet->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'date' => 'required|before:tomorrow',
            'job_name' => 'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'remark'=>'required',
        ]);
        $status = 0;
        $timesheet = Timesheet::find($request->id);
        $timesheet->date = $request->date;
        $timesheet->job_name = $request->job_name;
        $timesheet->start_time = $request->start_time;
        $timesheet->end_time = $request->end_time;
        $t1 =  $request->start_time;
        $t2 =  $request->end_time;
        $time1=strtotime($t2);
        $time2=strtotime($t1);
        $total=( ($time1 - $time2)/60)/60;
        $timesheet->time_taken = $total;
        $timesheet->remark = $request->remark;
        if ($timesheet->save()) {
          $status = 1;
        }

         return response([
            'status' => $status,
            'timesheet' => $timesheet->toArray()
        ]);
    }

    public function delete($id)
    {
        $status = 0;
        $timesheet = Timesheet::where('id', $id)->delete();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }
}

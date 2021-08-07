<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Timesheet;
use App\Member;
use App\Task;
use App\Job;
use App\Admin;
use DB;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

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
        return view('Admin.Timesheet.index',compact('timesheets','user','jobs'))->with('no',1);
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
    public function export(){
        $names=DB::select(DB::raw("SELECT `id`,`name` FROM `members` WHERE 1"));
        //dd($names);
        return view('Admin.export')->with('names', $names);
    }
    public function download($id,$name,$start_date,$end_date){
        function usersGenerator($result) {
            foreach ($result as $user) {
                yield $user;
            }
        }
        $dd="Date ".$start_date." to ".$end_date;
        if($id=='all'){
            $result1=DB::select(DB::raw("SELECT members.name as 'Name of Employee',sum(timesheets.time_taken) as 'Total Hour' FROM `timesheets`, members WHERE timesheets.user_id=members.id AND timesheets.date BETWEEN '$start_date' AND '$end_date' GROUP BY members.name"));
            $result2=DB::select(DB::raw("SELECT members.name as 'Name of Employee', teams.team_name as 'Team', timesheets.date as '$dd',timesheets.job_name as 'Job Name',timesheets.remark as 'Remark',timesheets.start_time as 'Start Time',timesheets.end_time as 'End Time',timesheets.time_taken as 'Total Hour' FROM `timesheets`, members,teams WHERE members.id=timesheets.user_id AND members.team_id=teams.id AND timesheets.date BETWEEN '$start_date' AND '$end_date' ORDER By members.name,timesheets.date"));
            $result3=DB::select(DB::raw("SELECT `job_name` as 'Job Name' ,SUM(`time_taken`) as 'Total Hour' FROM `timesheets` WHERE date BETWEEN '$start_date' AND '$end_date'  GROUP BY `job_name`"));
            
            $sheets= new SheetCollection(['All Data'=>usersGenerator($result2),'Total Hour'=>usersGenerator($result1),'Total Job'=>usersGenerator($result3)]);
            //dd($sheets);
            $filename=$name."_".$start_date."to".$end_date.".xlsx";
            //dd($result);
            (new FastExcel($sheets))->download($filename);
        }else{
            $result1=DB::select(DB::raw("SELECT members.name as 'Name of Employee', timesheets.date as '$dd',sum(timesheets.time_taken) as 'Total Hour' FROM `timesheets`, members WHERE timesheets.user_id=members.id AND timesheets.user_id='$id' AND timesheets.date BETWEEN '$start_date' AND '$end_date' GROUP BY timesheets.date,members.name"));
            $result2=DB::select(DB::raw("SELECT members.name as 'Name of Employee', timesheets.date as '$dd',timesheets.job_name as 'Job Name',timesheets.remark as 'Remark',timesheets.start_time as 'Start Time',timesheets.end_time as 'End Time',timesheets.time_taken as 'Total Hour' FROM `timesheets`, members WHERE members.id=timesheets.user_id AND timesheets.user_id='$id' AND timesheets.date BETWEEN '$start_date' AND '$end_date' ORDER By timesheets.date"));
            $result3=DB::select(DB::raw("SELECT `job_name` as 'Job Name' ,SUM(`time_taken`) as 'Total Hour' FROM `timesheets` WHERE user_id='$id' AND date BETWEEN '$start_date' AND '$end_date'  GROUP BY `job_name`"));
            
            $sheets= new SheetCollection(['All Data'=>usersGenerator($result2),'Total Hour'=>usersGenerator($result1),'Total Job'=>usersGenerator($result3)]);
            //dd($sheets);
            $filename=$name."_".$start_date."to".$end_date.".xlsx";
            //dd($result);
            (new FastExcel($sheets))->download($filename);
        }
    
    }

    public function timesheet()
    {
        $user = Auth::user()->fname;
        $date = Carbon::today();
        $timesheets = Timesheet::where('date',$date)->with('users')->paginate(20);
        return view('Admin.Timesheet.timesheet_summary',compact('timesheets'))->with('no',1); 
    }

    public function search(Request $request)
    {
            $status= 0;
            $query = $request->get('searchValue');
            $data = Timesheet::where('date','like','%'.$query.'%')->get();
            
            $totalData = $data->count();
                
            if($totalData == 0)
            {   
                $status = 0;
                $datas = array(
                    'totalData' => $totalData,
                    'status' => $status
                );
                echo json_encode($datas);
                
            }else{
                $status = 1;
                $datas = array(
                    'tableData' => $data,
                    'totalData' => $totalData,
                    'status' => $status
                );
                echo json_encode($datas);
            }
           
        }

        //search task
        public function getMoreTimesheets(Request $request)
        {
            $search = $request->search_query;
            if($request->ajax())
            {
                $user = Auth::user()->fname;
                $timesheets = Timesheet::where('date','like','%'.$search.'%')->paginate(20);
                $no = 1;
                return view('Admin.Timesheet.timesheetsummary_page',compact('timesheets','user','no','search'))->render();
            }
            
        }
}

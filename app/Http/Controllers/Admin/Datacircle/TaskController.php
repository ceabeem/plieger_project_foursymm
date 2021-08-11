<?php

namespace App\Http\Controllers\Admin\Datacircle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Team;
use Auth;
use App;
use App\Record;
use App\TeamworkStatus;

class TaskController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $flag = 0;
        $members =Member::where('role_id','!=',1)->where('role_id','!=',4)->where('role_id','!=',6)->where(function($query) use ($flag){
            $query->where('flag',$flag);
        } )->get();

        $status = 1;
        $tasks = Task::where('project_id',1)->where(function($query) use ($status){
            $query->where('status',$status);
            })->orderBy('id','DESC')->paginate(20);
      
        return view('Admin.Datacircle.Task.index',compact('tasks','members','user'))->with('no',1);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'task_name' => 'required',
            'member_id' => 'required'
        ]);
        $checkname = Task::where('task_name', $request->task_name)->first();
		if($checkname){
			return response()->json([
			'nameexists'=>1,
				]);	
		}
        $status = 0;
        $tasks = new Task;
        $tasks->task_name = $request->task_name;
        $tasks->project_id = 1;
        $tasks->member_id = $request->member_id;
        $member_name = Member::where('id',$tasks->member_id)->first();
        $assigned_member = $member_name['name'];
        $team_id = $member_name['team_id'];
        $team_name = Team::where('id',$team_id)->first();
        $assigned_team = $team_name['team_name'];
        $tasks->team_name = $assigned_team;
        $tasks->assigned_member = $assigned_member;
        $tasks->assigned_date = $request->assigned_date;
        $tasks->status = 1;
        if($tasks->save()) {
            
            $record = new Record;
            $aa=Task::max('id');
            $record->assign = '1';
            $record->task_id=$aa;
            $record->user_id=$request->member_id;
            if($record->save()){
                $work_status = TeamworkStatus::where('member_id',$request->member_id)->first();
                $work_status->total_assigned_task = $work_status->total_assigned_task + 1;
                $work_status->save();

                
            }
            $status = 1;
        }
        return response()->json([
            'status' => $status,
            'tasks' => $tasks->toArray(),
        ]);
    }

    public function edit($id)
    {
        $task = Task::where('id', $id)->first();
        return response([
            'task' => $task->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'task_name' => 'required',
            'member_id' => 'required'
        ]);
        $checkname = Task::where('task_name', $request->task_name)->first();
		if($checkname){
			if($checkname->id!=$request->id){
				return response()->json([
                    'nameexists'=>1,
                        ]);
			}
		}
        $status = 0;
        $task = Task::find($request->id);
        $member_id = $task['member_id'];
        $task->task_name = $request->task_name;
        $task->member_id = $request->member_id;
        $member_name = Member::where('id',$task->member_id)->first();
        $assigned_member = $member_name['name'];
        $team_id = $member_name['team_id'];
        $team_name = Team::where('id',$team_id)->first();
        $assigned_team = $team_name['team_name'];
        $task->team_name = $assigned_team;
        $task->assigned_member = $assigned_member;
        $task->assigned_date = $request->assigned_date;

        if ($task->save()) {
            $work_status = TeamworkStatus::where('member_id',$member_id)->first();
            $work_status->total_assigned_task = $work_status->total_assigned_task - 1;
            if($work_status->save()){
                $new_work_status = TeamworkStatus::where('member_id',$request->member_id)->first();
                $new_work_status->total_assigned_task = $new_work_status->total_assigned_task + 1;
                $new_work_status->save();
            }
        
          $status = 1;
        }

         return response([
            'status' => $status,
            'task' => $task->toArray()
        ]);
    }

    public function delete($id)
    {
        $status = 0;
        $task = Task::where('id', $id)->delete();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function getallmembers()
    {
        $status = 0 ;
        $flag = 0;
        $member_names = Member::where('role_id','!=',1)->where('role_id','!=',4)->where('role_id','!=',6)->where(function($query) use ($flag){
            $query->where('flag',$flag);
        })->get();
        $status = 1;
        return response([
            'status' => $status,
            'member_names' => $member_names
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

    //Search Task
    public function search(Request $request)
    {
            $status= 0;
            $search = $request->get('searchValue');
            $data = Task::where('project_id',1)->where(function($query) use ($search){
                $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
            })->get();
            
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
        public function getMoreTasks(Request $request)
        {
            $search = $request->search_query;
            if($request->ajax())
            {
                $user = Auth::user()->fname;
                $status = 1;
                
                $tasks = Task::where('project_id',1)->where(function($query) use ($status){
                    $query->where('status',$status);
                    })->where(function($query) use ($search){
                    $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
                })->orderBy('id','DESC')->paginate(20);
                
                $no = 1;
                return view('Admin.Datacircle.Task.task_page',compact('tasks','user','no','search'))->render();
            }
            
        }
}

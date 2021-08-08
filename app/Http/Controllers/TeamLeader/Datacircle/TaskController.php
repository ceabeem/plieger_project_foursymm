<?php

namespace App\Http\Controllers\TeamLeader\Datacircle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Team;
use Carbon\Carbon;
use App\Review;
use Auth;
use App\Record;

class TaskController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $status = 1;
        $tasks = Task::where('project_id',1)->where(function($query) use ($status){
            $query->where('status',$status);
        })->where(function($query) use ($user){
            $query->where('assigned_member',$user);
        })->orderBy('id','DESC')->paginate(20);
        return view('TeamLeader.Datacircle.Task.index',compact('tasks','user'))->with('no',1);
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
        $status = 0;
        $task = Task::find($request->id);
        $task->issue_remark = $request->issue_remark;
        $task->priority=$request->priority;
        $task->status = 6;
        if ($task->save()) {
            $status = 1;
            $record = new Record;
            $record->issue = '1';
            $record->task_id=$request->id;
            $record->user_id=$task->member_id;
            if($record->save()){
                
            }
            
        }

         return response([
            'status' => $status,
            'task' => $task->toArray()
        ]);
    }


    public function done($id)
    {
        $status = 0;
        $task = Task::where('id', $id)->first();
        $member_id = $task['member_id'];
        $members = Member::where('id',$member_id)->first();
        $team_id =$members['team_id'];
        $team_leader = Member::where('role_id',2)->where(function($query) use ($team_id){
            $query->where('team_id',$team_id);
        })->first();
        $review_assigned_member = $team_leader['name'];
        $task->review_assigned_member = $review_assigned_member;
        $task->status = 2;
        $task->save();
        $status = 1;
        $record = new Record;
        $record->assign_cmplt = '1';
        $record->task_id=$id;
        $record->user_id=$task->member_id;
        if($record->save()){
               
        }
    
        return response([
            'status' => $status
        ]);
    }

    

    
    //Search Task
    public function search(Request $request)
    {
            $status= 0;
            $search = $request->get('searchValue');
            $data = Task::where('project_id',1)->where(function($query) use ($status){
                $query->where('team_name','like','%'.$search.'%')->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
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

        public function getMoreTasks(Request $request)
        {
            $search = $request->search_query;
            if($request->ajax())
            {
                $user = Auth::user()->fname;
                $tasks = Task::where('project_id',1)->where(function($query) use ($status){
                    $query->where('status',$status);
                })->where(function($query) use ($user) {
                    $query->where('assigned_member',$user);
                })->where(function($query) use ($search){
                                $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
                        })->paginate(20);
                $no = 1;
                return view('Member.Datacircle.Task.task_page',compact('tasks','user','no','search'))->render();
            }
            
        }
    
       
}

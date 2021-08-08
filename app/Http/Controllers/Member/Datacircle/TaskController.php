<?php

namespace App\Http\Controllers\Member\Datacircle;

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
        $status =  1;
        $tasks = Task::where('project_id',1)->where(function($query) use ($status){
            $query->where('status',$status);
        })->where(function($query) use ($user){
            $query->where('assigned_member',$user);
        })->orderBy('id','DESC')->paginate(20);
        return view('Member.Datacircle.Task.index',compact('tasks','user'))->with('no',1);
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

    public function review()
    {
        $user = Auth::user()->fname;
        $status = 2;
        $reviews = Task::where('project_id',1)->where(function($query) use ($status){
            $query->where('status',$status);
        })->where(function($query) use ($user){
            $query->where('review_assigned_member',$user);
        })->paginate(20);
        return view('Member.Datacircle.Task.review',compact('reviews','user'))->with('no',1);
    }

    public function reviewed($id)
    {
        $status = 0;
        $user_id = Auth::user()->id;
        $member = Member::where('user_id',$user_id)->first();
        $member_id = $member['id'];
        $task = Task::where('id', $id)->first();
        $task->status = 3;
        if($task->save()){
            $review = Review::where('task_id',$id)->first();
            $review->review_finished_time = Carbon::now()->addHours('5')->addMinutes('45');
            $review->review_finished_date = Carbon::today();
            $review->save();
            $record = new Record;
            $record->review_cmplt = '1';
            $record->task_id=$id;
            $record->user_id=$task->member_id;
            if($record->save()){
                $work_status = TeamworkStatus::where('member_id',$member_id)->first();
                $work_status->reviewed_task = $work_status->reviewed_task + 1;
                $work_status->save();
            }
            
        }
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function issueedit($id)
    {
        $review = Task::where('id', $id)->first();
        return response([
            'review' => $review->toArray()
        ]);
    }

    public function issueupdate(Request $request)
    {
        $status = 0;
        $review = Task::find($request->id);
        $review->issue_remark = $request->issue_remark;
        $review->priority=$request->priority;
        $review->status = 6;
        if ($review->save()) {
            $status = 1;
            $record = new Record;
            $record->issue = '1';
            $record->task_id=$request->id;
            $record->user_id=$review->member_id;
            if($record->save()){
                
            }
            
        }

         return response([
            'status' => $status,
            'review' => $review->toArray()
        ]);
    }

    //Search Task
    public function search(Request $request)
    {
            $status= 0;
            $search = $request->get('searchValue');
            $data = Task::where('project_id',1)->where(function($query) use ($status){
                $query->where('status',$status);
            })->where(function($query) use ($search){
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
                $status = 1;
                $tasks = Task::where('project_id',1)->where(function($query) use ($status){
                    $query->where('status',$status);
                })->where(function($query) use ($user){
                    $query->where('assigned_member',$user);
                })->where(function($query) use ($search){
                    $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
                })->paginate(20);
                $no = 1;
                return view('Member.Datacircle.Task.task_page',compact('tasks','user','no','search'))->render();
            }
            
        }
    
        public function getMoreReviews(Request $request)
        {
            $search = $request->search_query;
            if($request->ajax())
            {
                $user = Auth::user()->fname;
                $status = 3;
                $reviews = Task::where('project_id',1)->where(function($query) use ($status){
                    $query->where('status',$status);
                })->where(function($query) use ($user){
                        $query->where('review_assigned_member',$user);
                })->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')
                            ->orwhere('team_name','like','%'.$search.'%')
                            ->orwhere('assigned_date','like','%'.$search.'%');
                        })->paginate(20);
                $no = 1;
                return view('Member.Datacircle.Task.review_page',compact('reviews','user','no','search'))->render();
            }
            
        }
}

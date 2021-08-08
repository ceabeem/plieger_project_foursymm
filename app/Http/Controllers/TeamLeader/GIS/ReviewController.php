<?php

namespace App\Http\Controllers\TeamLeader\GIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Review;
use Carbon\Carbon;
use App\Team;
use Auth;
use App;
use App\Record;
use App\TeamworkStatus;

class ReviewController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $user_id = Auth::user()->id;
        $member = Member::where('user_id',$user_id)->first();
        $team_id = $member['team_id'];
        $team = Team::where('id',$team_id)->first();
        $team_name = $team['team_name'];
        $status = 2;
        $reviews = Task::where('project_id',2)->where(function($query) use ($status){
            $query->where('status',$status);
        })->where(function($query) use ($team_name){
            $query->where('team_name',$team_name);
        })->where(function($query) use ($user){
            $query->where('review_assigned_member',$user)->orwhere('review_assigned_member',null);
        })->paginate(20);
        return view('TeamLeader.GIS.Review.index',compact('reviews','user'))->with('no',1);
    }

    //search review
    
    public function getMoreReviews(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $user_id = Auth::user()->id;
            $member = Member::where('user_id',$user_id)->first();
            $team_id = $member['team_id'];
            $team = Team::where('id',$team_id)->first();
            $team_name = $team['team_name'];
            $status = 2;
            $reviews = Task::where('project_id',2)->where(function($query) use ($status){
                $query->where('status',$status);
            })->where(function($query) use ($team_name){
                $query->where('team_name',$team_name);
            })->where(function($query) use ($user){
                $query->where('review_assigned_member',$user)->orwhere('review_assigned_member',null);
                
            })->where(function($query) use ($search){
                // $query->where('task_name','like','%'.$search.'%')->orwhere('review_assigned_member','like','%'.$search.'%');
                $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%');
            })->paginate(20);
            $no = 1;
            return view('TeamLeader.GIS.Review.review_page',compact('reviews','user','no','search'))->render();
        }
        
    }
    

    public function edit($id)
    {
        $review = Task::where('id', $id)->first();
        return response([
            'review' => $review->toArray()
        ]);
    }

    public function update(Request $request)
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

    public function reviewed($id)
    {
        $status = 0;
        $user_id = Auth::user()->id;
        $member = Member::where('user_id',$user_id)->first();
        $member_id = $member['id'];
        $task = Task::where('id', $id)->first();
        $task->status = 3;
        if($task->save()){
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

}

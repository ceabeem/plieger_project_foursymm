<?php

namespace App\Http\Controllers\Admin\Datacircle;

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

class PliegerReviewController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $sendstatus = 7;
        $feedbackstatus = 8;
        $sends = Task::where('project_id',1)->where(function($query) use ($sendstatus){
            $query->where('status',$sendstatus);
        })->paginate(10);
        $feedbacks = Task::where('project_id',1)->where(function($query) use ($feedbackstatus){
            $query->where('status',$feedbackstatus);
        })->paginate(10);
        return view('Admin.Datacircle.PliegerReview.index',compact('sends','user','feedbacks'))->with('no',1);
    }

    public function edit($id)
    {
        $pending = Task::where('id', $id)->first();
        return response([
            'pending' => $pending->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $status = 0;
        $pending = Task::find($request->id);
        $pending->member_id = $request->member_id;
        $member_name = Member::where('id',$pending->member_id)->first();
        $assigned_member = $member_name['name'];
        $team_id = $member_name['team_id'];
        $team_name = Team::where('id',$team_id)->first();
        $assigned_team = $team_name['team_name'];
        $pending->team_name = $assigned_team;
        $pending->review_assigned_member = $assigned_member;
        $pending->status = 2;

        if ($pending->save()) {
            $review = new Review;
            $review_info = Task::where('id',$request->id)->first();
            $review->task_name = $review_info->task_name;
            $review->member_id = $request->member_id;
            $review->task_id = $request->id;
            $review->team_name = $review_info->team_name;
            $review->review_assigned_member = $assigned_member;
            $review->review_assigned_date = Carbon::today();
            $review->review_assigned_time = Carbon::now()->addHours('5')->addMinutes('45');
            $review->status = 1;
            if ($review->save()){
                $record = new Record;
                $record->reassign = '1';
                $record->task_id=$request->id;
                $record->user_id=$request->member_id;
                if($record->save()){
                }
            }
            $status = 1;
        }

         return response([
            'status' => $status,
            'pending' => $pending->toArray()
        ]);
    }

    public function finish($id)
    {
        $status = 0;
        $pending = Task::where('id', $id)->first();
        $member_id = $pending['member_id'];
        $pending->status = 4;
        $pending->update();
        $status = 1;
        $record = new Record;
        $record->finish = '1';
        $record->task_id=$id;
        $record->user_id=$pending->member_id;
        if($record->save()){
            $work_status = TeamworkStatus::where('member_id',$member_id)->first();
            $work_status->team_supervisor_reviewed = $work_status->team_supervisor_reviewed + 1;
            $work_status->save();
               
        }
            
    
        return response([
            'status' => $status
        ]);
    }
    public function pliegerreview($id)
    {
        $status = 0;
        $pending = Task::where('id', $id)->first();
        $member_id = $pending['member_id'];
        $pending->status = 7;
        $pending->update();
        $status = 1;    
        return response([
            'status' => $status
        ]);
    }

    public function view($id)
    {
        $user = Auth::user()->fname;
        $taskview = Review::where('task_id',$id)->get();
        if($taskview){
            $taskview = $taskview->toArray();
        }
        return view('Admin.Datacircle.Review.detail',compact('taskview','user'))->with('no',1);
    }

    public function issueedit($id)
    {
        $pending = Task::where('id', $id)->first();
        return response([
            'pending' => $pending->toArray()
        ]);
    }

    public function issueupdate(Request $request)
    {
        $status = 0;
        $pending = Task::find($request->id);
        $pending->issue_remark = $request->issue_remark;
        $pending->status = 6;
        if ($pending->save()) {
            $status = 1; 
            $record = new Record;
            $record->issue = '1';
            $record->task_id=$request->id;
            $record->user_id=$pending->member_id;
            if($record->save()){
                
            }
            
        }
       
         return response([
            'status' => $status,
            'pending' => $pending->toArray()
        ]);
    }


    //search pending
    public function getMorePendings(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $status = 3;
            $pendings = Task::where('project_id',1)->where(function($query) use ($status){
                $query->where('status',$status);
                })->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
                        })->paginate(20);
            $no = 1;
            return view('Admin.Datacircle.ReviewPending.pending_page',compact('pendings','user','no','search'))->render();
        }
        
    }
    public function getMorePliegerReview2(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $status = 8;
            $feedbacks = Task::where('project_id',1)->where(function($query) use ($status){
                $query->where('status',$status);
                })->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
                        })->paginate(10);
            $no = 1;
            return view('Admin.Datacircle.PliegerReview.pending_page',compact('feedbacks','user','no','search'))->render();
        }
        
    }
    public function getMorePliegerReview1(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $status = 7;
            $sends = Task::where('project_id',1)->where(function($query) use ($status){
                $query->where('status',$status);
                })->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
                        })->paginate(10);
            $no = 1;
            return view('Admin.Datacircle.PliegerReview.pending_page2',compact('sends','user','no','search'))->render();
        }
        
    }
}

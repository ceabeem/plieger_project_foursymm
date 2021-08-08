<?php

namespace App\Http\Controllers\TeamLeader\Datacircle;

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

class ReviewPendingController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->id;
        $team_id = Member::where('user_id',$user)->first()->team_id;
        $team_name = Team::where('id',$team_id)->first()->team_name;
        $status = 3;
        $pendings = Task::where('project_id',1)->where(function($query) use ($status){
            $query->where('status',$status);
        })->where(function($query) use ($team_name){
            $query->where('team_name',$team_name);
        })->paginate(20);
        return view('TeamLeader.Datacircle.ReviewPending.index',compact('pendings','user'))->with('no',1);        
    }

    public function getallmembers()
    {
        $status = 0 ;
        $user = Auth::user()->id;
        $team_id = Member::where('user_id',$user)->first()->team_id;
        $member_names = Member::where('role_id',3)->where(function($query) use ($team_id){
            $query->where('team_id',$team_id);
        })->get();
        $status = 1;
        return response([
            'status' => $status,
            'member_names' => $member_names
        ]);
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
        $pending->status = 4;
        $pending->update();
        $status = 1;
        $record = new Record;
        $record->finish = '1';
        $record->task_id=$id;
        $record->user_id=$pending->member_id;
        if($record->save()){
               
        }
    
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
        return view('TeamLeader.Datacircle.Review.detail',compact('taskview','user'))->with('no',1);
    }

    //search pending
    public function getMorePendings(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->id;
            $team_id = Member::where('user_id',$user)->first()->team_id;
            $team_name = Team::where('id',$team_id)->first()->team_name;
            $pendings = Task::where('status',3)->where(function($query) use ($team_name){
                $query->where('team_name',$team_name);
            })->where(function($query) use ($search){
                $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
            })->paginate(20);
            $no = 1;
            return view('TeamLeader.Datacircle.ReviewPending.pending_page',compact('pendings','user','no','search'))->render();
        }
        
    }
}

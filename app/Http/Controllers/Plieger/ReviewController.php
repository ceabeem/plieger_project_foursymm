<?php

namespace App\Http\Controllers\Plieger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Review;
use Carbon\Carbon;
use Auth;
use App;
use App\Record;
use App\Pliegerfeedback;

class ReviewController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $pendings = Task::where('status',7)->paginate(20);
        return view('Plieger.review',compact('pendings','user'))->with('no',1);
    }

    public function finish()
    {
        $user = Auth::user()->fname;
        $finishs = Task::where('status',4)->paginate(20);
        return view('Admin.Review.finish',compact('finishs','user'))->with('no',1);
    }

    public function edit($id)
    {
        $finish = Task::where('id', $id)->first();
        return response([
            'finish' => $finish->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $status = 0;
        $finish = Task::find($request->id);
        $finish->member_id = $request->member_id;
        $member_name = Member::where('id',$finish->member_id)->first();
        $assigned_member = $member_name['name'];
        $finish->review_assigned_member = $assigned_member;
        $finish->status = 2;

        if ($finish->save()) {
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
          $review->save();
          $record = new Record;
          $record->reassign = '1';
          $record->task_id=$request->id;
          $record->user_id=$request->member_id;
          if($record->save()){
                 
          }
          $status = 1;
        }

         return response([
            'status' => $status,
            'finish' => $finish->toArray()
        ]);
    }

    public function upload($id)
    {
        $status = 0;
        $finish = Task::where('id', $id)->first();
        $finish->status = 5;
        $finish->finished_date = Carbon::today();
        $finish->update();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function uploadtask()
    {
        $user = Auth::user()->fname;
        $uploads = Task::where('status',5)->paginate(20);
        return view('Admin.Review.upload',compact('uploads','user'))->with('no',1);
    }

    public function abort()
    {

        // Get the user from authentication
        $user = Auth::user();

        // Check if has not group throw forbidden
        if ($user->role_id != 1) 
        return App::abort(403);

    }

    //search review
    public function getMoreReviews(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $reviews = Task::where('status',2)->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('review_assigned_member','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%');
                        })->paginate(20);
            $no = 1;
            return view('Admin.Review.review_page',compact('reviews','user','no','search'))->render();
        }
        
    }

    //search Finish
    public function getMoreFinish(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $finishs = Task::where('status',4)->where(function($query) use ($search){
                        $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%');
                        })->paginate(20);
            $no = 1;
            return view('Admin.Review.finish_page',compact('finishs','user','no','search'))->render();
        }
        
    }

    //search upload
    public function getMoreUpload(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $uploads = Task::where('status',5)->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('finished_date','like','%'.$search.'%');
                        })->paginate(20);
            $no = 1;
            return view('Admin.Review.upload_page',compact('uploads','user','no','search'))->render();
        }
        
    }
    public function issueupdate(Request $request)
    {
        $status = 0;
        $pending = Task::find($request->id);
        $pending->status = 8;
        $id=$request->id;
        if ($pending->save()) {
            $Pliegerfeedback = Pliegerfeedback::where('task_id', $id)->where(function($query) use ($id){
                $query->where('status',1);
            })->first();
            $Pliegerfeedback->feedback=$request->issue_remark;
            if ($Pliegerfeedback->save()){
                }

            $status = 1; 
        }
       
         return response([
            'status' => $status,
            'pending' => $pending->toArray()
        ]);
    }
    public function getMoreReview(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $pendings = Task::where('status',7)->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
                        })->paginate(10);
            $no = 1;
            return view('Plieger.pending_page',compact('pendings','user','no','search'))->render();
        }
        
    }
    public function queries($id)
    {
        $pending = Pliegerfeedback::where('task_id', $id)->where(function($query) use ($id){
            $query->where('status',1);
        })->first();
        // dd($pending);
        return response([
            'pending' => $pending->toArray()
        ]);
    }
}

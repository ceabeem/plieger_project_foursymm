<?php

namespace App\Http\Controllers\Admin\GIS;

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

class ReviewController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $status = 2;
        $reviews = Task::where('project_id',2)->where(function($query) use ($status){
            $query->where('status',$status);
            })->paginate(20);
        return view('Admin.GIS.Review.index',compact('reviews','user'))->with('no',1);
    }

    public function finish()
    {
        $user = Auth::user()->fname;
        $status = 4;
        $finishs = Task::where('project_id',2)->where(function($query) use ($status){
            $query->where('status',$status);
            })->paginate(20);
        return view('Admin.GIS.Review.finish',compact('finishs','user'))->with('no',1);
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
        $status = 5;
        $uploads = Task::where('project_id',2)->where(function($query) use ($status){
            $query->where('status',$status);
            })->paginate(20);
        return view('Admin.GIS.Review.upload',compact('uploads','user'))->with('no',1);
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
            $status = 2;
            $reviews = Task::where('project_id',2)->where(function($query) use ($status){
                $query->where('status',$status);
                })->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('review_assigned_member','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%');
                        })->paginate(20);
            $no = 1;
            return view('Admin.GIS.Review.review_page',compact('reviews','user','no','search'))->render();
        }
        
    }

    //search Finish
    public function getMoreFinish(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $status = 4;
            $finishs = Task::where('project_id',2)->where(function($query) use ($status){
                $query->where('status',$status);
                })->where(function($query) use ($search){
                        $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%');
                        })->paginate(20);
            $no = 1;
            return view('Admin.GIS.Review.finish_page',compact('finishs','user','no','search'))->render();
        }
        
    }

    //search upload
    public function getMoreUpload(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $status = 5;
            $uploads = Task::where('project_id',2)->where(function($query) use ($status){
                $query->where('status',$status);
                })->where(function($query) use ($search){
                            $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('finished_date','like','%'.$search.'%');
                        })->paginate(20);
            $no = 1;
            return view('Admin.GIS.Review.upload_page',compact('uploads','user','no','search'))->render();
        }
        
    }
}

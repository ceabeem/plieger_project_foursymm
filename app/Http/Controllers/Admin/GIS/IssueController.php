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

class IssueController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $status = 6;
        $issues = Task::where('project_id',2)->where(function($query) use ($status){
            $query->where('status',$status);
        })->orderBy('issue_feedback','DESC')->orderBy('priority','DESC')->paginate(20);
        return view('Admin.GIS.Review.issue',compact('issues','user'))->with('no',1);
    }

    public function issue($id)
    {
        $status = 0;
        $issue = Task::where('id', $id)->first();
        $issue->status = 1;
        $issue->issue_remark = "";
        $issue->issue_feedback = "";
        $issue->update();
        $status = 1;
        $record = new Record;
        $record->reassign = '1';
        $record->task_id=$id;
        $record->user_id=$issue->member_id;
        if($record->save()){
               
        }
        return response([
            'status' => $status
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

    public function getMoreIssue(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $status = 6;
            $issues = Task::where('project_id',2)->where(function($query) use ($status){
                $query->where('status',$status);
                })->where(function($query) use ($search){
                        $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('issue_remark','like','%'.$search.'%');
                    })->orderBy('issue_feedback','DESC')->orderBy('priority','DESC')->paginate(20);
            $no = 1;
            return view('Admin.GIS.Review.issue_page',compact('issues','user','no','search'))->render();
        }
        
    }
}

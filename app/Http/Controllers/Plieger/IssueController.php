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

class IssueController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $issues = Task::where('status',6)->orderBy('priority','DESC')->orderBy('issue_feedback','DESC')->paginate(20);
        return view('Plieger.issue',compact('issues','user'))->with('no',1);
    }

    public function issue($id)
    {
        $status = 0;
        $issue = Task::where('id', $id)->first();
        $issue->status = 1;
        $issue->issue_remark = "";
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
            $issues = Task::where('status',6)->where(function($query) use ($search){
                        $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('issue_remark','like','%'.$search.'%');
                    })->orderBy('priority','DESC')->orderBy('issue_feedback','DESC')->paginate(20);
            $no = 1;
            return view('Plieger.issue_page',compact('issues','user','no','search'))->render();
        }
        
    }
    public function issuefeedback(Request $request)
    {
        $status = 0;
        $pending = Task::find($request->id);
        $pending->issue_feedback = $request->issue_feedback;
        if ($pending->save()) {
            $status = 1; 
        }
       
         return response([
            'status' => $status,
            'pending' => $pending->toArray()
        ]);
    }
}

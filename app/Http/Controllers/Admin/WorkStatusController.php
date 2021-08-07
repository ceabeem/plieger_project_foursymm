<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Team;
use App\Member;
use App\Task;
use Auth;
use App;
use App\TeamworkStatus;

class WorkStatusController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $roleid=1;
        $work_status = TeamworkStatus::where('role_id','!=',4)->where(function($query) use ($roleid){
            $query->where('role_id','!=',$roleid);
        })->with('teams')->orderBy('team_id','ASC')->get();
        $reviews = Task::where('status',4)->count();
        return view('Admin.Team.teamsummary',compact('user','work_status','reviews'))->with('no',1);
    }
}

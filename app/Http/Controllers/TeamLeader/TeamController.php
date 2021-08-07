<?php

namespace App\Http\Controllers\TeamLeader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Team;
use App\Member;
Use App\Timesheet;
use Auth;

class TeamController extends Controller
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
        $team_id = $member->team_id;
        $members =Member::where('role_id',2)->where(function($query) use ($team_id){
            $query->where('team_id',$team_id)
                ->where('flag',0);
        } )->get();
        return view('TeamLeader.Team.Index',compact('members','user'))->with('no',1);
    }

    public function view($id)
    {
        $user = Auth::user()->fname;
        $date = Carbon::today()->subDays(30);
        $member = Member::where('id',$id)->first();
        $user_id = $member['user_id'];
        $name = $member['name'];
        $timesheets = Timesheet::where('user_id',$user_id)->where(function($query) use ($date){
            $query->where('date','>=',$date);
        })->paginate(20);
        return view('TeamLeader.Team.timesheet',compact('timesheets','user','name'))->with('no',1);
    }
}

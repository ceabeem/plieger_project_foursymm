<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Team;
use App\Member;
use Auth;
use App;
use App\TeamworkStatus;

class TeamController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $teams = Team::paginate(20);
        return view('Admin.Team.index',compact('teams','user'))->with('no',1);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'team_name' => 'required',
            
        ]);
        $checkname = Team::where('team_name', $request->team_name)->first();
		if($checkname){
			return response()->json([
			'nameexists'=>1,
				]);	
		}
        $status = 0;
        $teams = new Team;
        $teams->team_name = $request->team_name;
        $teams->status = 1;
        if($teams->save()) {
            $status = 1;
        }
        return response()->json([
            'status' => $status,
            'teams' => $teams->toArray(),
        ]);
    }

    public function edit($id)
    {
        $team = Team::where('id', $id)->first();
        return response([
            'team' => $team->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $status = 0;
        $this->validate($request,[
            'team_name' => 'required',
            
        ]);
        $checkname = Team::where('team_name', $request->team_name)->first();
		if($checkname){
			return response()->json([
			'nameexists'=>1,
				]);	
		}
        $team = Team::find($request->id);
        $team->team_name = $request->team_name;

        if ($team->save()) {
          $status = 1;
        }

         return response([
            'status' => $status,
            'team' => $team->toArray()
        ]);
    }

    public function delete($id)
    {
        $status = 0;
        $team = Team::where('id', $id)->delete();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function view($id)
    {
        $status = 1;
        $user = Auth::user()->fname;
        $members = TeamworkStatus::where('team_id',$id)->get();
    
        return view('Admin.Team.detail',compact('members','user'))->with('no',1);
    }

    //Search Team
    public function getMoreTeams(Request $request)
    {
        $search = $request->search_query;
        if($request->ajax())
        {
            $user = Auth::user()->fname;
            $teams = Team::where('team_name','like','%'.$search.'%')->paginate(20);
            $no = 1;
            return view('Admin.Team.page_team',compact('teams','user','no','search'))->render();
        }
        
    }

    
}

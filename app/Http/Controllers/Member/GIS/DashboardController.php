<?php

namespace App\Http\Controllers\Member\GIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Admin;
use App\Member;
use App\Task;
use App\Review;

class DashboardController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
	{
	    
		$user = Auth::user()->fname;
        $remaining_status = 1;
		$team_leader_review_status = 2;
		$team_supervisor_review_status = 3;
		$total_finished = 4;
		$total_uploaded = 5;
		$issues_remaining = 6;
		$plieger_remaining = 7;
		$total_assigned_task = Task::where('project_id',2)->all()->count();
        $remaining_task = Task::where('project_id',2)->where(function($query) use ($remaining_status){
			$query->where('status',$remaining_status);
		})->count();
        $team_leader_review = Task::where('project_id',2)->where(function($query) use ($team_leader_review_status){
			$query->where('status',$team_leader_review_status);
		})->count();
        $team_supervisor_review = Task::where('project_id',2)->where(function($query) use ($team_supervisor_review_status){
			$query->where('status',$team_supervisor_review_status);
		})->count();
        $total_finished = Task::where('project_id',2)->where(function($query) use ($total_finished){
			$query->where('status',$total_finished);
		})->count();
        $total_uploaded = Task::where('project_id',2)->where(function($query) use ($total_uploaded){
			$query->where('status',$total_uploaded);
		})->count();
        $issues_remaining = Task::where('project_id',2)->where(function($query) use ($issues_remaining){
			$query->where('status',$issues_remaining);
		})->count();
        $plieger_remaining = Task::where('project_id',2)->where(function($query) use ($plieger_remaining){
			$query->where('status',$plieger_remaining);
		})->count();
        return view('Member.GIS.index',compact('plieger_remaining','total_assigned_task','remaining_task','team_leader_review','team_supervisor_review','total_finished','total_uploaded','issues_remaining'));
	}
	
}

<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Admin;
use App\Member;
use App\Task;
use App\Review;

class UserController extends Controller
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
		$total_assigned_task = Task::where('project_id',1)->count();
        $remaining_task = Task::where('project_id',1)->where(function($query) use ($remaining_status){
			$query->where('status',$remaining_status);
		})->count();
        $team_leader_review = Task::where('project_id',1)->where(function($query) use ($team_leader_review_status){
			$query->where('status',$team_leader_review_status);
		})->count();
        $team_supervisor_review = Task::where('project_id',1)->where(function($query) use ($team_supervisor_review_status){
			$query->where('status',$team_supervisor_review_status);
		})->count();
        $total_finished = Task::where('project_id',1)->where(function($query) use ($total_finished){
			$query->where('status',$total_finished);
		})->count();
        $total_uploaded = Task::where('project_id',1)->where(function($query) use ($total_uploaded){
			$query->where('status',$total_uploaded);
		})->count();
        $issues_remaining = Task::where('project_id',1)->where(function($query) use ($issues_remaining){
			$query->where('status',$issues_remaining);
		})->count();
        $plieger_remaining = Task::where('project_id',1)->where(function($query) use ($plieger_remaining){
			$query->where('status',$plieger_remaining);
		})->count();
		$total_assigned_task1 = Task::where('project_id',2)->count();
        $remaining_task1 = Task::where('project_id',2)->where(function($query) use ($remaining_status){
			$query->where('status',$remaining_status);
		})->count();
        $team_leader_review1 = Task::where('project_id',2)->where(function($query) use ($team_leader_review_status){
			$query->where('status',$team_leader_review_status);
		})->count();
        $team_supervisor_review1 = Task::where('project_id',2)->where(function($query) use ($team_supervisor_review_status){
			$query->where('status',$team_supervisor_review_status);
		})->count();
        $total_finished1 = Task::where('project_id',2)->where(function($query) use ($total_finished){
			$query->where('status',$total_finished);
		})->count();
        $total_uploaded1 = Task::where('project_id',2)->where(function($query) use ($total_uploaded){
			$query->where('status',$total_uploaded);
		})->count();
        $issues_remaining1 = Task::where('project_id',2)->where(function($query) use ($issues_remaining){
			$query->where('status',$issues_remaining);
		})->count();
        $plieger_remaining1 = Task::where('project_id',2)->where(function($query) use ($plieger_remaining){
			$query->where('status',$plieger_remaining);
		})->count();
        return view('Member.index',compact('plieger_remaining','total_assigned_task','remaining_task','team_leader_review','team_supervisor_review','total_finished','total_uploaded','issues_remaining',
		'plieger_remaining1','total_assigned_task1','remaining_task1','team_leader_review1','team_supervisor_review1','total_finished1','total_uploaded1','issues_remaining1'));
	}


	public function detail()
    {
        $admin = Member::where('user_id',auth()->user()->id)->first();
		return view('Member.detail', compact('admin'));
	}

	public function update(Request $request)
	{
		$this->validate($request,[
            'name' => 'required',
            'mobile' => 'required|min:6',
            'email' => 'required|email'
		]);
		$checkemail = Admin::where('email', $request->email)->first();
		if($checkemail){
			if($checkemail->id!=auth()->user()->id){
				$emailexists=1;
				return response()->json([
				'emailexists'=>$emailexists,
				]);
			}			
		}
		$checkemail = Member::where('email', $request->email)->first();
       	if($checkemail){
			if($checkemail->user_id!=auth()->user()->id){
				$emailexists=1;
				return response()->json([
				'emailexists'=>$emailexists,
				]);
			}	
		}
		$status = 0;
		$admin = Admin::find(auth()->user()->id);
		$admin->fname=$request->input('name');
		$admin->lname=$request->input('name');
		$admin->email=$request->input('email');
		
		
		if ($admin->save()) {
			$admin = Member::where('user_id',auth()->user()->id)->first();
			$admin->name=$request->input('name');
			$admin->email=$request->input('email');
			$admin->mobile_no=$request->input('mobile');
			if($admin->update()){
				$status=1;	
			}
			
		}
        return response([
            'status' => $status,
            'admin' => $admin->toArray()
        ]);
	}

	public function changepassrq()
    {
        return view('Member.changepass');
	}
	
	public function changepass(Request $request)
	{	
		//return $request->current_password;
		$this->validate($request,[
            'current_password' => 'required',
            'new_password' => 'required|min:6|regex:/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/',
            'new_confirm_password' => 'same:new_password',
        ]);
		if (Hash::check($request->current_password,auth()->user()->password)) {
			Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
			return redirect()->back()->with('message', 'Password Updated!');
		}
		else
			return redirect()->back()->withErrors("Current Password dosenot Match!!");
			return auth()->user()->password;
		//return admin::find(1)->toArray();
	}
}

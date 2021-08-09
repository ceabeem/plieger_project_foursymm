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
		$total_assigned_task_dc = Task::where('project_id',1)->get();
        $total_assigned_task_gis = Task::where('project_id',2)->get();


        $remaining_task_dc = $total_assigned_task_dc->where('status',1)->count();
        $team_leader_review_dc = $total_assigned_task_dc->where('status',2)->count();
        $team_supervisor_review_dc = $total_assigned_task_dc->where('status',3)->count();
        $total_finished_dc = $total_assigned_task_dc->where('status',4)->count();
        $total_uploaded_dc = $total_assigned_task_dc->where('status',5)->count();
        $issues_remaining_dc = $total_assigned_task_dc->where('status',6)->count();
        $plieger_remaining_dc = $total_assigned_task_dc->where('status',7)->count();
		$plieger_feedback_dc = $total_assigned_task_dc->where('status',8)->count();


		$remaining_task_gis = $total_assigned_task_gis->where('status',1)->count();
        $team_leader_review_gis = $total_assigned_task_gis->where('status',2)->count();
        $team_supervisor_review_gis = $total_assigned_task_gis->where('status',3)->count();
        $total_finished_gis = $total_assigned_task_gis->where('status',4)->count();
        $total_uploaded_gis = $total_assigned_task_gis->where('status',5)->count();
        $issues_remaining_gis = $total_assigned_task_gis->where('status',6)->count();
        $plieger_remaining_gis = $total_assigned_task_gis->where('status',7)->count();
		$plieger_feedback_gis = $total_assigned_task_gis->where('status',8)->count();


        $total_assigned_task_dc = $total_assigned_task_dc->count();
        $total_assigned_task_gis = $total_assigned_task_gis->count();

        return view('Member.index',compact('plieger_remaining_dc','total_assigned_task_dc','remaining_task_dc','team_leader_review_dc','team_supervisor_review_dc','total_finished_dc','total_uploaded_dc','issues_remaining_dc','plieger_feedback_dc','plieger_remaining_gis','total_assigned_task_gis','remaining_task_gis','team_leader_review_gis','team_supervisor_review_gis','total_finished_gis','total_uploaded_gis','issues_remaining_gis','plieger_feedback_gis'));
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

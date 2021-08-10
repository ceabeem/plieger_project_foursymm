<?php

namespace App\Http\Controllers\TeamLeader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
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

	public function index(Request $request)
	{
		if(!$request->project_id){
			$project_id=1;
		}else{
			$project_id=$request->project_id;
		}
		$user = Auth::user()->fname;
		$status =3;
		$total_assigned_task = Task::where('project_id',$project_id)->get();


		$remaining_task = $total_assigned_task->where('status',1)->count();
		$team_leader_review = $total_assigned_task->where('status',2)->count();
		$team_supervisor_review = $total_assigned_task->where('status',3)->count();
		$total_finished = $total_assigned_task->where('status',4)->count();
		$total_uploaded = $total_assigned_task->where('status',5)->count();
		$issues_remaining = $total_assigned_task->where('status',6)->count();
		$plieger_remaining = $total_assigned_task->where('status',7)->count();
		$plieger_feedback = $total_assigned_task->where('status',8)->count();


		$total_assigned_task = $total_assigned_task->count();
		// return response($total_assigned_task);
		if($request->ajax())
		{
			return view('TeamLeader.index_data_ajax',compact('project_id','plieger_remaining','total_assigned_task','remaining_task','team_leader_review','team_supervisor_review','total_finished','total_uploaded','issues_remaining','plieger_feedback'))->render();

		}

		return view('TeamLeader.index',compact('project_id','plieger_remaining','total_assigned_task','remaining_task','team_leader_review','team_supervisor_review','total_finished','total_uploaded','issues_remaining','plieger_feedback'));
	}
	public function detail()
    {
        $admin = Member::where('user_id',auth()->user()->id)->first();
		return view('TeamLeader.detail', compact('admin'));
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
        return view('TeamLeader.changepass');
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

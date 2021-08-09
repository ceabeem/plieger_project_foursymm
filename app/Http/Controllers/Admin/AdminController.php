<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Auth;
use App\Admin;
use App\Member;
use App\Task;
use App\Review;
use App\Record;
use DB;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index()
	{
	    
	    $user = Auth::user()->fname;
        $status =3;
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

        return view('Admin.index',compact('plieger_remaining_dc','total_assigned_task_dc','remaining_task_dc','team_leader_review_dc','team_supervisor_review_dc','total_finished_dc','total_uploaded_dc','issues_remaining_dc','plieger_feedback_dc','plieger_remaining_gis','total_assigned_task_gis','remaining_task_gis','team_leader_review_gis','team_supervisor_review_gis','total_finished_gis','total_uploaded_gis','issues_remaining_gis','plieger_feedback_gis'));
	}
	public function showchart(Request $request)
    {
        
        $start= $request->get('startd');
        $end= $request->get('endd');
        $count=DB::select(DB::raw("SELECT COUNT(assign) as ta,COUNT(assign_cmplt) as tac,COUNT(reassign) as rac,COUNT(review_cmplt) as rc,COUNT(issue) as isc,COUNT(finish) as fin FROM records WHERE created_at BETWEEN '$start' AND '$end'"));
        foreach ($count as $count) {
            $ta=$count->ta;
			$tac=$count->tac;
			$rac=$count->rac;
            $rc=$count->rc;
            $isc=$count->isc;
            $fin=$count->fin;
        }
        
        $query=DB::select(DB::raw("SELECT COUNT(assign) as total_assign,COUNT(assign_cmplt) as assign_completed,COUNT(reassign) as reassign,COUNT(review_cmplt) as review_cmplt,COUNT(issue) as issue,COUNT(finish) as finish,created_at FROM records WHERE created_at BETWEEN '$start' AND '$end' GROUP BY created_at"));
        $total=[];
		$assign=[];
		$reassign=[];
        $assigncom=[];
        $reviewcom=[];
        $issue=[];
        $finish=[];
        
        foreach ($query as $query) {
            array_push($total,$query->created_at);
			array_push($assign,$query->total_assign);
			array_push($reassign,$query->reassign);
            array_push($assigncom,$query->assign_completed);
            array_push($reviewcom,$query->review_cmplt);
            array_push($issue,$query->issue);
            array_push($finish,$query->finish);
        }
        
        return response([
            'assign' => $assign,
            'total'=>$total,
			'assigncom'=>$assigncom,
			'reassign' => $reassign,
            'reviewcom'=>$reviewcom,
            'issue'=>$issue,
            'finish'=>$finish,
            'ta'=>$ta.' Assigned',
			'tac'=>$tac.' Assigned Completed',
			'rac'=>$rac.' Reassigned',
            'rc'=>$rc.' Reviewed',
            'isc'=>$isc.' Issues',
            'fin'=>$fin.' Finished',
            
        ]);
    }
	public function detail()
    {
        $admin = Member::where('user_id',auth()->user()->id)->first();
		return view('Admin.detail', compact('admin'));
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
        return view('Admin.changepass');
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

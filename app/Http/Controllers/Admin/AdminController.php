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
        $total_assigned_task = Task::all()->count();
        $remaining_task = Task::where('status',1)->count();
        $team_leader_review = Task::where('status',2)->count();
        $team_supervisor_review = Task::where('status',3)->count();
        $total_finished = Task::where('status',4)->count();
        $total_uploaded = Task::where('status',5)->count();
        $issues_remaining = Task::where('status',6)->count();
        $plieger_remaining = Task::where('status',7)->count();
		$plieger_feedback = Task::where('status',8)->count();
        return view('Admin.index',compact('plieger_remaining','total_assigned_task','remaining_task','team_leader_review','team_supervisor_review','total_finished','total_uploaded','issues_remaining','plieger_feedback'));
	    
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
            'mobile' => 'required|numeric|regex:/^(9)[0-9]{9}$/',
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

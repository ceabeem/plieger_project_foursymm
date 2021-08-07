<?php

namespace App\Http\Controllers\Plieger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Auth;
use App\Admin;
use App\Member;
use App\Task;
use App\Review;
use App\Pliegerfeedback;
use App\Record;
use Mail;
use DB;
use Carbon\Carbon;

class UserController extends Controller
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
        $plieger_send = Pliegerfeedback::count();
        return view('Plieger.index',compact('plieger_send','plieger_remaining','total_assigned_task','remaining_task','team_leader_review','team_supervisor_review','total_finished','total_uploaded','issues_remaining'));
	}
	public function detail()
    {
        $admin = Member::where('user_id',auth()->user()->id)->first();
		return view('Plieger.detail', compact('admin'));
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
        return view('Plieger.changepass');
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
	public function test(){
		$admin=DB::table('admins')->select('email')->where('role_id','1')->orwhere('role_id','5')->get();	
		// $admin2=DB::table('admins')->select('email')->where('role_id','5')->get();	
		$plieger_remaining = Task::where('status',7)->count();
		$date = Carbon::today();
        $today = Task::where('status',7)->where('updated_at','>=',$date)->count();
		$arr = [];

		$startweek=Carbon::today()->subDays(7);
		$today=Carbon::today();
		$total_assigned_task_start = Task::where('created_at','<',$startweek)->count();
		$total_assigned_task_end = Task::where('created_at','>',$startweek)->count();
		$total_assigned_task = Task::all()->count();


		$team_supervisor_review_start = Task::where('status',3)->where('updated_at','<',$startweek)->count();
		$team_supervisor_review_end = Task::where('status',3)->where('updated_at','>=',$startweek)->count();
		$team_supervisor_review = Task::where('status',3)->count();
        $total_finished_start = Task::where('status',4)->where('updated_at','<',$startweek)->count();
        $total_finished_end = Task::where('status',4)->where('updated_at','>=',$startweek)->count();
        $total_finished = Task::where('status',4)->count();
        $total_uploaded_start = Task::where('status',5)->where('updated_at','<',$startweek)->count();
        $total_uploaded_end = Task::where('status',5)->where('updated_at','>=',$startweek)->count();
        $total_uploaded = Task::where('status',5)->count();
		$leader_done_start =$team_supervisor_review_start+$total_finished_start+$total_uploaded_start;
        $leader_done_end = $team_supervisor_review_end+$total_finished_end+$total_uploaded_end;
        $leader_done = $team_supervisor_review+$total_finished+$total_uploaded;

		$Plieger_send_start = Task::where('status',7)->where('updated_at','<',$startweek)->count();
        $Plieger_send_end = Task::where('status',7)->where('updated_at','>=',$startweek)->count();
        $Plieger_send = Task::where('status',7)->count();
        $Plieger_recieve_start = Task::where('status',8)->where('updated_at','<',$startweek)->count();
        $Plieger_recieve_end = Task::where('status',8)->where('updated_at','>=',$startweek)->count();
        $Plieger_recieve= Task::where('status',8)->count();
		$supervisor_done_start =$total_finished_start+$total_uploaded_start+$Plieger_send_start+$Plieger_recieve_start;
        $supervisor_done_end = $total_finished_end+$total_uploaded_end+$Plieger_send_end+$Plieger_recieve_end;
        $supervisor_done = $total_finished+$total_uploaded+$Plieger_send+$Plieger_recieve;

		$Plieger_queries_start = Pliegerfeedback::where('created_at','<',$startweek)->count();
        $Plieger_queries_end = Pliegerfeedback::where('created_at','>=',$startweek)->count();
        $Plieger_queries= Pliegerfeedback::count();

		$Plieger_feedback_start = Pliegerfeedback::where('feedback','!=','null')->where('updated_at','<',$startweek)->count();
        $Plieger_feedback_end = Pliegerfeedback::where('feedback','!=','null')->where('updated_at','>=',$startweek)->count();
        $Plieger_feedback= Pliegerfeedback::where('feedback','!=','null')->count();
		
        $issues_remaining_start = Task::where('status',6)->where('updated_at','<',$startweek)->count();
        $issues_remaining_end = Task::where('status',6)->where('updated_at','>=',$startweek)->count();
        $issues_remaining = Task::where('status',6)->count();


		$perv_rem=Task::where('status',2)->where('updated_at','<',$startweek)->count();
		$completed_start=$team_supervisor_review+$total_finished+$total_uploaded+$Plieger_send+$Plieger_recieve+$perv_rem;
		$completed_end=Task::where('status',2)->where('updated_at','>=',$startweek)->count();
		$completed=$completed_start+$completed_end;
		
		foreach($admin as $row)
		{
			array_push($arr,$row->email);
		}

		// $admin=['prajapati.sabim@gmail.com'];
		// dd($arr);
		$data = array('plieger_remaining'=>$plieger_remaining,'today'=>$today,'total_assigned_task_start'=>$total_assigned_task_start,'total_assigned_task_end'=>$total_assigned_task_end,'total_assigned_task'=>$total_assigned_task,'total_assign_cmplt_task_start'=>$completed_start,'total_assign_cmplt_task_end'=>$completed_end,'total_assign_cmplt_task'=>$completed,
		'leader_done_start'=>$leader_done_start,
		'leader_done_end'=>$leader_done_end,
		'leader_done'=>$leader_done,
        'supervisor_done_start'=>$supervisor_done_start,
        'supervisor_done_end'=>$supervisor_done_end,
        'supervisor_done'=>$supervisor_done,
        'Plieger_send_start'=>$Plieger_queries_start,
        'Plieger_send_end'=>$Plieger_queries_end,
        'Plieger_send'=>$Plieger_queries,
        'Plieger_recieve_start'=>$Plieger_feedback_start,
        'Plieger_recieve_end'=>$Plieger_feedback_end,
        'Plieger_recieve'=>$Plieger_feedback,
        'total_uploaded_start'=>$total_uploaded_start,
        'total_uploaded_end'=>$total_uploaded_end,
        'total_uploaded'=>$total_uploaded,
        'issues_remaining_start'=>$issues_remaining_start,
        'issues_remaining_end'=>$issues_remaining_end,
        'issues_remaining'=>$issues_remaining,
		'today'=>$today,
	);
		// return view('emails.mail',$data);
    	Mail::send('emails.mail', $data, function($message)use ($arr) {
			$message->to($arr)->subject('Weekly Status of Plieger Data Enrichment Project');
            $message->from('xyz@gmail.com','Plieger Nepal Team');
		});
		echo "Basic Email Sent. Check your inbox.";
	}
}

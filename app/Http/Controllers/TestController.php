<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Task;
use Carbon\Carbon;
use App\Pliegerfeedback;
use App\ReportRecord;

class TestController extends Controller
{
    public function index()
    {
        $admin=DB::table('admins')->select('email')->where('role_id','1')->orwhere('role_id','5')->get();	
		$plieger_remaining = Task::where('status',7)->where('project_id',1)->count();
		$arr = [];

		$today=Carbon::now('Asia/Kathmandu');
		$total_assigned_task_start = ReportRecord::select('assigned_files')->where('id','1')->first();
        $total_assigned_task_start=$total_assigned_task_start['assigned_files'];
		$total_assigned_task = Task::where('project_id',1)->count();
		$total_assigned_task_end = $total_assigned_task-$total_assigned_task_start;


		$team_supervisor_review = Task::where('status',3)->where('project_id',1)->count();
        $total_finished = Task::where('status',4)->where('project_id',1)->count();
        $total_uploaded_start = ReportRecord::select('uploaded_files')->where('id','1')->first();
        $total_uploaded_start=$total_uploaded_start['uploaded_files'];
        $total_uploaded = Task::where('status',5)->where('project_id',1)->count();
        $total_uploaded_end =$total_uploaded-$total_uploaded_start;

		$leader_done_start =ReportRecord::select('teamleaders_reviewed')->where('id','1')->first();
        $leader_done_start=$leader_done_start['teamleaders_reviewed'];
        $leader_done = $team_supervisor_review+$total_finished+$total_uploaded;
        $leader_done_end = $leader_done-$leader_done_start;

        $Plieger_send = Task::where('status',7)->where('project_id',1)->count();
        $Plieger_recieve= Task::where('status',8)->where('project_id',1)->count();

		$supervisor_done_start =ReportRecord::select('supervisors_reviewed')->where('id','1')->first();
        $supervisor_done_start=$supervisor_done_start['supervisors_reviewed'];
        $supervisor_done = $total_finished+$total_uploaded+$Plieger_send+$Plieger_recieve;
        $supervisor_done_end = $supervisor_done-$supervisor_done_start;

		$Plieger_queries_start = ReportRecord::select('send_plieger')->where('id','1')->first();
        $Plieger_queries_start=$Plieger_queries_start['send_plieger'];
        $Plieger_queries= Pliegerfeedback::count();
        $Plieger_queries_end = $Plieger_queries-$Plieger_queries_start;

		$Plieger_feedback_start = ReportRecord::select('plieger_reviewed')->where('id','1')->first();
        $Plieger_feedback_start=$Plieger_feedback_start['plieger_reviewed'];
        $Plieger_feedback= Pliegerfeedback::where('feedback','!=','null')->count();
        $Plieger_feedback_end = $Plieger_feedback-$Plieger_feedback_start;
		
        $issues_remaining_start = ReportRecord::select('issue_files')->where('id','1')->first();
        $issues_remaining_start=$issues_remaining_start['issue_files'];
        $issues_remaining = Task::where('status',6)->where('project_id',1)->count();
        $issues_remaining_end = $issues_remaining-$issues_remaining_start;

        $remaining_files = Task::where('status',1)->where('project_id',1)->count();
        $completed_start=ReportRecord::select('assigned_completed')->where('id','1')->first();
        $completed_start=$completed_start['assigned_completed'];
		$completed=$total_assigned_task-$issues_remaining-$remaining_files;
        $completed_end=$completed-$completed_start;

        $savedata = ReportRecord::where('id','1')->first();
        $savedata->assigned_files = $total_assigned_task;
        $savedata->assigned_completed = $completed;
        $savedata->teamleaders_reviewed = $leader_done;
        $savedata->supervisors_reviewed = $supervisor_done;
        $savedata->send_plieger = $Plieger_queries;
        $savedata->plieger_reviewed = $Plieger_feedback;
        $savedata->uploaded_files = $total_uploaded;
        $savedata->issue_files = $issues_remaining;
        if ($savedata->save()) {
            
        }
		
		foreach($admin as $row)
		{
			array_push($arr,$row->email);
		}
        $arr = array_diff($arr, array("admin@test.com", "test@plieger.com"));
		//$arr=['prajapati.sabim@gmail.com'];
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
            'project'=>'Data Enrichment'
	    );
		return view('emails.mail',$data);
    	Mail::send('emails.mail', $data, function($message)use ($arr) {
			$message->to($arr)->subject('Weekly Status of Plieger Data Enrichment Project');
            $message->from('noreply@foursymmetrons.com','Plieger Nepal Team');
		});
        $this->info("Basic Email Sent. Check your inbox.");
	}
}

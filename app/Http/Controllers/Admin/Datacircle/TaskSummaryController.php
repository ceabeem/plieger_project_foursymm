<?php

namespace App\Http\Controllers\Admin\Datacircle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Team;
use Auth;
use App;
use Rap2hpoutre\FastExcel\FastExcel;
use DB;
use Rap2hpoutre\FastExcel\SheetCollection;

class TaskSummaryController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $tasks =Task::where('project_id',1)->paginate(20);
        return view('Admin.Datacircle.Task.tasksummary',compact('tasks','user'))->with('no',1);
    }

    public function search(Request $request)
    {
            $status= 0;
            $search = $request->get('searchValue');
            $data = Task::where('project_id',1)->where(function($query) use ($search){
                $query->where('task_name','like','%'.$search.'%')->orwhere('assigned_member','like','%'.$search.'%')->orwhere('team_name','like','%'.$search.'%')->orwhere('assigned_date','like','%'.$search.'%');
            })->get();
            
            $totalData = $data->count();
                
            if($totalData == 0)
            {   
                $status = 0;
                $datas = array(
                    'totalData' => $totalData,
                    'status' => $status
                );
                echo json_encode($datas);
                
            }else{
                $status = 1;
                $datas = array(
                    'tableData' => $data,
                    'totalData' => $totalData,
                    'status' => $status
                );
                echo json_encode($datas);
            }
           
        }

        //search task
        public function getMoreTasks(Request $request)
        {
            $search = $request->search_query;
            if($request->ajax())
            {
                $user = Auth::user()->fname;
                $tasks = Task::where('project_id',1)->where(function($query) use ($search){
                    $query->where('task_name','like','%'.$search.'%')
                            ->orwhere('assigned_member','like','%'.$search.'%')
                            ->orwhere('team_name','like','%'.$search.'%')
                            ->orwhere('assigned_date','like','%'.$search.'%');
                })->paginate(20);
                $no = 1;
                return view('Admin.Datacircle.Task.tasksummary_page',compact('tasks','user','no','search'))->render();
            }
            
        }
        
        public function download(){
            function usersGenerator($result) {
                foreach ($result as $user) {
                    yield $user;
                }
            }
            $result1=DB::select(DB::raw("SELECT `id` as 'Task ID',`task_name` as 'Task Name',`assigned_member` as 'Assigned Member',`team_name` as 'Team Name',`review_assigned_member` as 'Review Assign Member',`status` as 'File_Status',`issue_remark`as 'Issue Remark' FROM `tasks` WHERE 1"));
            foreach ($result1 as $tmp) {
                if ($tmp->File_Status==1){
                    $tmp->File_Status='Assign';
                }
                if ($tmp->File_Status==2){
                    $tmp->File_Status='Reviewing By TeamLeader';
                }
                if ($tmp->File_Status==3){
                    $tmp->File_Status='Reviewing By Supervisor';
                }
                if ($tmp->File_Status==4){
                    $tmp->File_Status='Finished';
                }
                if ($tmp->File_Status==5){
                    $tmp->File_Status='Uploaded';
                }
                if ($tmp->File_Status==6){
                    $tmp->File_Status='Issue File';
                }
            }
            $result2=DB::select(DB::raw("SELECT tasks.task_name as 'Task Name',members.name as 'Assign Member Name',records.assign,records.assign_cmplt,records.reassign,records.review,records.review_cmplt,records.issue,records.finish,records.updated_at as 'Date' FROM records,tasks,members WHERE records.task_id=tasks.id and records.user_id=members.id"));
            foreach ($result2 as $tmp1) {
                if ($tmp1->assign==1){
                    $tmp1->File_Status='assign';
                }
                if ($tmp1->assign_cmplt==1){
                    $tmp1->File_Status='assign_cmplt';
                }
                if ($tmp1->reassign==1){
                    $tmp1->File_Status='reassign';
                }
                if ($tmp1->review==1){
                    $tmp1->File_Status='review';
                }
                if ($tmp1->review_cmplt==1){
                    $tmp1->File_Status='review_cmplt';
                }
                if ($tmp1->issue==1){
                    $tmp1->File_Status='Issue File';
                }
                if ($tmp1->finish==1){
                    $tmp1->File_Status='finish File';
                }
                unset($tmp1->assign);
                unset($tmp1->assign_cmplt);
                unset($tmp1->review);
                unset($tmp1->review_cmplt);
                unset($tmp1->issue);
                unset($tmp1->finish);
                unset($tmp1->reassign);
            };
            $filename='TaskSummary.xlsx';
            #$task=usersGenerator($result1);
            $sheets= new SheetCollection(['File Status'=>usersGenerator($result1),'File Status 2'=>usersGenerator($result2)]);
            (new FastExcel($sheets))->download($filename);
            /*$tasks =Task::get();
            //dd($tasks);
            $filename='TaskSummary.xlsx';
            $task=usersGenerator($tasks);
            (new FastExcel($task))->download($filename);
            */
        }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('home');
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login/forgetpassword', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

// end of front end routing.

Route::prefix('admin')->group(function () {
    
    
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/detail', 'Admin\AdminController@detail')->name('admin.detail');
    Route::get('/update', 'Admin\AdminController@update')->name('admin.update');
    Route::get('/changepassrq', 'Admin\AdminController@changepassrq')->name('admin.changepassrq');
    Route::get('/changepass', 'Admin\AdminController@changepass')->name('admin.changepass');
    Route::get('/showchart', 'Admin\AdminController@showchart')->name('admin.showchart');    
    
    
    
        //Team
    Route::get('team','Admin\TeamController@index')->name('admin.team');
    Route::post('/team/store','Admin\TeamController@store')->name('team.store');
    Route::get('/team/{team}/edit','Admin\TeamController@edit')->name('team.edit');
    Route::post('/team/update','Admin\TeamController@update')->name('team.update');
    Route::get('/team/delete/{team}','Admin\TeamController@delete')->name('team.delete');
    Route::get('/abort','Admin\TeamController@abort')->name('team.abort');
    Route::get('/team/view/{team}','Admin\TeamController@view')->name('team.view');
    Route::get('/team/getMoreTeams','Admin\TeamController@getMoreTeams')->name('team.getMoreTeams');
    Route::get('/teamsummary','Admin\WorkStatusController@index')->name('admin.workstatus');
    //end of Team

    //Job
    Route::get('job','Admin\JobController@index')->name('admin.job');
    Route::post('/job/store','Admin\JobController@store')->name('job.store');
    Route::get('/job/{job}/edit','Admin\JobController@edit')->name('job.edit');
    Route::post('/job/update','Admin\JobController@update')->name('job.update');
    Route::get('/job/delete/{job}','Admin\JobController@delete')->name('job.delete');
    Route::get('/job/getMorejobs','Admin\JobController@getMorejobs')->name('job.getMorejobs');
    //End of Job

    //Member
    Route::get('member','Admin\MemberController@index')->name('admin.member');
    Route::get('/member/getallteams','Admin\MemberController@getallteams')->name('member.getallteams');
    Route::post('/member/store','Admin\MemberController@store')->name('member.store');
    Route::get('/member/{member}/edit','Admin\MemberController@edit')->name('member.edit');
    Route::post('/member/update','Admin\MemberController@update')->name('member.update');
    Route::get('/member/delete/{member}','Admin\MemberController@delete')->name('member.delete');
    Route::get('/member/view/{member}','Admin\MemberController@view')->name('member.view');
    Route::get('/member/timesheet/{timesheet}','Admin\MemberController@timesheet')->name('member.timesheets');
    Route::get('/abort','Admin\TeamController@abort')->name('team.abort');
    Route::get('/member/getMoreMembers','Admin\MemberController@getMoreMembers')->name('member.getMoreMembers');
    Route::get('/member/timesheet-getMoreTimesheet','Admin\MemberController@getMoreTimesheet')->name('member.timesheet.getMoreTimesheet');
    //End of Member

    // THIS IS OF START OF DATA CIRCLE
    //task
    Route::prefix('datacircle')->group(function () {

        Route::get('task','Admin\Datacircle\TaskController@index')->name('admin.task');
        Route::get('/task/getallmembers','Admin\Datacircle\TaskController@getallmembers')->name('datacircle.task.getallmembers');
        Route::post('/task/store','Admin\Datacircle\TaskController@store')->name('task.store');
        Route::get('/task/{task}/edit','Admin\Datacircle\TaskController@edit')->name('task.edit');
        Route::post('/task/update','Admin\Datacircle\TaskController@update')->name('task.update');
        Route::get('/task/delete/{task}','Admin\Datacircle\TaskController@delete')->name('task.delete');
        Route::get('/task/view/{task}','Admin\Datacircle\TaskController@view')->name('task.view');
        Route::post('/task/search','Admin\Datacircle\TaskController@search')->name('task.search');
        Route::get('/task/getMoreTasks','Admin\Datacircle\TaskController@getMoreTasks')->name('datacircle.task.getMoreTasks');
        Route::get('tasksummary','Admin\Datacircle\TaskSummaryController@index')->name('admin.tasksummary');
        Route::post('/tasksummary/search','Admin\Datacircle\TaskSummaryController@search')->name('tasksummary.search');
        Route::get('/tasksummary/getMoreTasks','Admin\Datacircle\TaskSummaryController@getMoreTasks')->name('datacircle.tasksummary.getMoreTasks');
        Route::get('/tasksummary/download','Admin\Datacircle\TaskSummaryController@download')->name('tasksummary.download');
        //end of Task

        //ReviewPending
        Route::get('reviewpending','Admin\Datacircle\ReviewPendingController@index')->name('admin.reviewpending');
        Route::get('henkreview','Admin\Datacircle\PliegerReviewController@index')->name('admin.pliegerreview');
        Route::get('/pending/{pending}/edit','Admin\Datacircle\ReviewPendingController@edit')->name('pending.edit');
        Route::get('/pending/{pending}/feedback','Admin\Datacircle\ReviewPendingController@feedback')->name('pending.feedback');
        Route::post('/pending/update','Admin\Datacircle\ReviewPendingController@update')->name('pending.update');
        Route::post('/pending/update2','Admin\Datacircle\ReviewPendingController@update2')->name('pending.update2');
        Route::get('/pending/finish/{pending}','Admin\Datacircle\ReviewPendingController@finish')->name('pending.finish');
        Route::get('/pending/finish2/{pending}','Admin\Datacircle\ReviewPendingController@finish2')->name('pending.finish2');
        Route::post('/pending/pliegerreview','Admin\Datacircle\ReviewPendingController@pliegerreview')->name('pending.pliegerreview');
        Route::get('/pending/{view}','Admin\Datacircle\ReviewPendingController@view')->name('pending.view');
        Route::get('/pending/{pending}/issueedit','Admin\Datacircle\ReviewPendingController@issueedit')->name('pending.issueedit');
        Route::post('/pending/issueupdate','Admin\Datacircle\ReviewPendingController@issueupdate')->name('pending.issueupdate');
        Route::get('/reviewpending/getMorePendings','Admin\Datacircle\ReviewPendingController@getMorePendings')->name('reviewpending.getMorePendings');
        Route::get('/reviewpending/getMorePliegerReview1','Admin\Datacircle\PliegerReviewController@getMorePliegerReview1')->name('reviewpending.getMorePliegerReview1');
        Route::get('/reviewpending/getMorePliegerReview2','Admin\Datacircle\PliegerReviewController@getMorePliegerReview2')->name('reviewpending.getMorePliegerReview2');
        //end of reviewpending

        //Review
        Route::get('review','Admin\Datacircle\ReviewController@index')->name('admin.review');
        Route::get('finish','Admin\Datacircle\ReviewController@finish')->name('admin.finish');
        Route::get('/finish/{finish}/edit','Admin\Datacircle\ReviewController@edit')->name('finish.edit');
        Route::post('/finish/update','Admin\Datacircle\ReviewController@update')->name('finish.update');
        Route::get('/finish/upload/{finish}','Admin\Datacircle\ReviewController@upload')->name('finish.upload');
        Route::get('/datacircle/upload','Admin\Datacircle\ReviewController@uploadtask')->name('admin.upload');
        Route::get('/review/getMoreReviews','Admin\Datacircle\ReviewController@getMoreReviews')->name('review.getMoreReviews');
        Route::get('/finish/getMoreFinish','Admin\Datacircle\ReviewController@getMoreFinish')->name('finish.getMoreFinish');
        Route::get('/upload/getMoreUpload','Admin\Datacircle\ReviewController@getMoreUpload')->name('upload.getMoreUpload');
        //End of Review

        //Issue
        Route::get('issue','Admin\Datacircle\IssueController@index')->name('admin.issue');
        Route::get('/issue/reassign/{issue}','Admin\Datacircle\IssueController@issue')->name('issue.reassign');
        Route::get('/issue/getMoreIssue','Admin\Datacircle\IssueController@getMoreIssue')->name('finish.getMoreIssue');
        //End of Issue
    });
    //END OF DATACIRCLE

    // THIS IS OF START OF GIS
    //task
    Route::prefix('gis')->group(function () {
        Route::get('task','Admin\GIS\TaskController@index')->name('GIS.task');
        Route::get('/task/getallmembers','Admin\GIS\TaskController@getallmembers')->name('gis.task.getallmembers');
        Route::post('/task/store','Admin\GIS\TaskController@store')->name('task.store');
        Route::get('/task/{task}/edit','Admin\GIS\TaskController@edit')->name('task.edit');
        Route::post('/task/update','Admin\GIS\TaskController@update')->name('task.update');
        Route::get('/task/delete/{task}','Admin\GIS\TaskController@delete')->name('task.delete');
        Route::get('/task/view/{task}','Admin\GIS\TaskController@view')->name('task.view');
        // Route::get('/abort','Admin\GIS\TeamController@abort')->name('team.abort');
        Route::post('/task/search','Admin\GIS\TaskController@search')->name('task.search');
        Route::get('/task/getMoreTasks','Admin\GIS\TaskController@getMoreTasks')->name('task.getMoreTasks');
        Route::get('tasksummary','Admin\GIS\TaskSummaryController@index')->name('GIS.tasksummary');
        Route::post('/tasksummary/search','Admin\GIS\TaskSummaryController@search')->name('tasksummary.search');
        Route::get('/tasksummary/getMoreTasks','Admin\GIS\TaskSummaryController@getMoreTasks')->name('tasksummary.getMoreTasks');
        Route::get('/tasksummary/download','Admin\GIS\TaskSummaryController@download')->name('tasksummary.download');
        //end of Task

        //ReviewPending
        Route::get('reviewpending','Admin\GIS\ReviewPendingController@index')->name('GIS.reviewpending');
        Route::get('henkreview','Admin\GIS\PliegerReviewController@index')->name('GIS.pliegerreview');
        Route::get('/pending/{pending}/edit','Admin\GIS\ReviewPendingController@edit')->name('pending.edit');
        Route::get('/pending/{pending}/feedback','Admin\GIS\ReviewPendingController@feedback')->name('pending.feedback');
        Route::post('/pending/update','Admin\GIS\ReviewPendingController@update')->name('pending.update');
        Route::post('/pending/update2','Admin\GIS\ReviewPendingController@update2')->name('pending.update2');
        Route::get('/pending/finish/{pending}','Admin\GIS\ReviewPendingController@finish')->name('pending.finish');
        Route::get('/pending/finish2/{pending}','Admin\GIS\ReviewPendingController@finish2')->name('pending.finish2');
        Route::post('/pending/pliegerreview','Admin\GIS\ReviewPendingController@pliegerreview')->name('pending.pliegerreview');
        Route::get('/pending/{view}','Admin\GIS\ReviewPendingController@view')->name('pending.view');
        Route::get('/pending/{pending}/issueedit','Admin\GIS\ReviewPendingController@issueedit')->name('pending.issueedit');
        Route::post('/pending/issueupdate','Admin\GIS\ReviewPendingController@issueupdate')->name('pending.issueupdate');
        Route::get('/reviewpending/getMorePendings','Admin\GIS\ReviewPendingController@getMorePendings')->name('reviewpending.getMorePendings');
        Route::get('/reviewpending/getMorePliegerReview1','Admin\GIS\PliegerReviewController@getMorePliegerReview1')->name('reviewpending.getMorePliegerReview1');
        Route::get('/reviewpending/getMorePliegerReview2','Admin\GIS\PliegerReviewController@getMorePliegerReview2')->name('reviewpending.getMorePliegerReview2');
        //end of reviewpending

        //Review
        Route::get('review','Admin\GIS\ReviewController@index')->name('GIS.review');
        Route::get('finish','Admin\GIS\ReviewController@finish')->name('GIS.finish');
        Route::get('/finish/{finish}/edit','Admin\GIS\ReviewController@edit')->name('finish.edit');
        Route::post('/finish/update','Admin\GIS\ReviewController@update')->name('finish.update');
        Route::get('/finish/upload/{finish}','Admin\GIS\ReviewController@upload')->name('finish.upload');
        Route::get('upload','Admin\GIS\ReviewController@uploadtask')->name('GIS.upload');
        // Route::get('/abort','Admin\GIS\TeamController@abort')->name('team.abort');
        Route::get('/review/getMoreReviews','Admin\GIS\ReviewController@getMoreReviews')->name('review.getMoreReviews');
        Route::get('/finish/getMoreFinish','Admin\GIS\ReviewController@getMoreFinish')->name('finish.getMoreFinish');
        Route::get('/upload/getMoreUpload','Admin\GIS\ReviewController@getMoreUpload')->name('upload.getMoreUpload');
        //End of Review

        //Issue
        Route::get('issue','Admin\GIS\IssueController@index')->name('GIS.issue');
        Route::get('/issue/reassign/{issue}','Admin\GIS\IssueController@issue')->name('issue.reassign');
        // Route::get('/abort','Admin\GIS\TeamController@abort')->name('team.abort');
        Route::get('/issue/getMoreIssue','Admin\GIS\IssueController@getMoreIssue')->name('finish.getMoreIssue');
    });
    //End of Issue
    //END OF GIS

    //Timesheet
    Route::get('timesheet','Admin\TimeSheetController@index')->name('admin.timesheet');
    Route::get('/timesheet/getjobs','Admin\TimeSheetController@getjobs')->name('timesheet.getjobs');
    Route::post('/timesheet/store','Admin\TimeSheetController@store')->name('admin.store');
    Route::get('/timesheet/{timesheet}/edit','Admin\TimeSheetController@edit')->name('admin.edit');
    Route::post('/timesheet/update','Admin\TimeSheetController@update')->name('admin.update');
    Route::get('/timesheet/delete/{timesheet}','Admin\TimeSheetController@delete')->name('admin.delete');
    Route::get('/export', 'Admin\TimeSheetController@export')->name('admin.export');
    Route::get('/download/{id}/{us}/{sd}/{ed}', 'Admin\TimeSheetController@download')->name('admin.download');
    Route::get('/timesheetsummary','Admin\TimeSheetController@timesheet')->name('admin.timesheetsummary');
    Route::post('/timesheetsummary/search','Admin\TimeSheetController@search')->name('timesheetsummary.search');
    Route::get('/timesheetsummary/getMoreTimesheets','Admin\TimeSheetController@getMoreTimesheets')->name('timesheetsummary.getMoreTimesheets');
    //End of Timesheet
});

//Member
Route::prefix('datacircle')->group(function () {
//START OF DATACIRCLE

    Route::get('task','Member\Datacircle\TaskController@index')->name('member.task');
    Route::get('/task/{task}/edit','Member\Datacircle\TaskController@edit')->name('member.edit');
    Route::post('/task/update','Member\Datacircle\TaskController@update')->name('member.update');
    Route::get('/task/done/{task}','Member\Datacircle\TaskController@done')->name('member.done');
    Route::get('/review','Member\Datacircle\TaskController@review')->name('member.review');
    Route::get('/task/reviewed/{task}','Member\Datacircle\TaskController@reviewed')->name('member.reviewed');
    Route::get('/review/{review}/edit','Member\Datacircle\TaskController@issueedit')->name('member.issueedit');
    Route::post('/review/update','Member\Datacircle\TaskController@issueupdate')->name('member.issueupdate');
    Route::get('/task/getMoreTasks','Member\Datacircle\TaskController@getMoreTasks')->name('member.task.getMoreTasks');
    Route::get('review/getMoreReviews','Member\Datacircle\TaskController@getMoreReviews')->name('member.review.getMoreReviews');
});
//END OF DATACIRCLE

//START OF GIS
Route::prefix('gis')->group(function () {

Route::get('/task','Member\GIS\TaskController@index')->name('GIS.member.task');
Route::get('/task/{task}/edit','Member\GIS\TaskController@edit')->name('member.edit');
Route::post('/task/update','Member\GIS\TaskController@update')->name('member.update');
Route::get('/task/done/{task}','Member\GIS\TaskController@done')->name('member.done');
Route::get('/review','Member\GIS\TaskController@review')->name('GIS.member.review');
Route::get('/task/reviewed/{task}','Member\GIS\TaskController@reviewed')->name('member.reviewed');
Route::get('/review/{review}/edit','Member\GIS\TaskController@issueedit')->name('member.issueedit');
Route::post('/review/update','Member\GIS\TaskController@issueupdate')->name('member.issueupdate');
Route::get('/task/getMoreTasks','Member\GIS\TaskController@getMoreTasks')->name('member.task.getMoreTasks');
Route::get('review/getMoreReviews','Member\GIS\TaskController@getMoreReviews')->name('member.review.getMoreReviews');
});
//END OF GIS

Route::get('/dashboard', 'Member\UserController@index')->name('member.dashboard');
Route::get('member/detail', 'Member\UserController@detail')->name('member.detail');
Route::get('member/update', 'Member\UserController@update')->name('member.update');
Route::get('member/changepassrq', 'Member\UserController@changepassrq')->name('member.changepassrq');
Route::get('member/changepass', 'Member\UserController@changepass')->name('member.changepass');


Route::get('RedirectDemoController', 'RedirectDemoController@index')->name('RedirectDemoController');

Route::get('/team/view/{team}','Admin\TeamController@view')->name('team.view');

//TimeSheet
Route::get('timesheet','Member\TimeSheetController@index')->name('member.timesheet');
Route::get('/getjobs','Member\TimeSheetController@getjobs')->name('member.getjobs');
Route::post('/timesheet/store','Member\TimeSheetController@store')->name('timesheet.store');
Route::get('/timesheet/{timesheet}/edit','Member\TimeSheetController@edit')->name('timesheet.edit');
Route::post('/timesheet/update','Member\TimeSheetController@update')->name('timesheet.update');
Route::get('/timesheet/delete/{member}','Member\TimeSheetController@delete')->name('timesheet.delete');

//End of TimeSheet
//Member

//TEAM LEADER
Route::prefix('teamleader')->group(function () {

    Route::get('/dashboard','TeamLeader\UserController@index')->name('teamleader.dashboard');
    Route::get('/detail', 'TeamLeader\UserController@detail')->name('teamleader.detail');
    Route::get('/update', 'TeamLeader\UserController@update')->name('teamleader.update');
    Route::get('/changepassrq', 'TeamLeader\UserController@changepassrq')->name('teamleader.changepassrq');
    Route::get('/changepass', 'TeamLeader\UserController@changepass')->name('teamleader.changepass');

    //START OF DATA CIRCLE
    Route::prefix('datacircle')->group(function () {
    //TASK
    Route::get('/task','TeamLeader\Datacircle\TaskController@index')->name('teamleader.task');
    Route::get('/task/{task}/edit','TeamLeader\Datacircle\TaskController@edit')->name('teamleader.edit');
    Route::post('/task/update','TeamLeader\Datacircle\TaskController@update')->name('teamleader.update');
    Route::get('/task/done/{task}','TeamLeader\Datacircle\TaskController@done')->name('teamleader.done');
    Route::get('/task/getMoreTasks','TeamLeader\Datacircle\TaskController@getMoreTasks')->name('teamleader.task.getMoreTasks');
    //End of Task

    //ReviewPending
    Route::get('reviewpending','TeamLeader\Datacircle\ReviewPendingController@index')->name('teamleader.reviewpending');
    Route::get('/pending/getallmembers','TeamLeader\Datacircle\ReviewPendingController@getallmembers')->name('teamleader.getallmembers');
    Route::get('/pending/{pending}/edit','TeamLeader\Datacircle\ReviewPendingController@edit')->name('teamleader.edit');
    Route::post('/pending/update','TeamLeader\Datacircle\ReviewPendingController@update')->name('teamleader.update');
    Route::get('/pending/finish/{pending}','TeamLeader\Datacircle\ReviewPendingController@finish')->name('teamleader.finish');
    Route::get('/reviews/reviewlist/{view}','TeamLeader\Datacircle\ReviewPendingController@view')->name('teamleader.view1');
    Route::get('/reviewpending/getMorePendings','TeamLeader\Datacircle\ReviewPendingController@getMorePendings')->name('teamleader.reviewpending.getMorePendings');
    //end of reviewpending

    //Review
    Route::get('reviews','TeamLeader\Datacircle\ReviewController@index')->name('teamleader.review');
    Route::get('/reviewpending/getMoreReviews','TeamLeader\Datacircle\ReviewController@getMoreReviews')->name('teamleader.reviewcontroller.getMoreReviews');
    Route::get('/review/{review}/edit','TeamLeader\Datacircle\ReviewController@edit')->name('review.edit');
    Route::post('/review/update','TeamLeader\Datacircle\ReviewController@update')->name('review.update');
    Route::get('/review/done/{review}','TeamLeader\Datacircle\ReviewController@reviewed')->name('teamleader.reviewed');
    //End of Review

     //Assign Task
     Route::get('/assigntask','TeamLeader\Datacircle\AssignTaskController@index')->name('teamleader.assigntask');
     Route::get('/assigntask/getallmembers','TeamLeader\Datacircle\AssignTaskController@getallmembers')->name('datacircle.assigntask.getallmembers');
     Route::post('/assigntask/store','TeamLeader\Datacircle\AssignTaskController@store')->name('assigntask.store');
     Route::get('/assigntask/{assigntask}/edit','TeamLeader\Datacircle\AssignTaskController@edit')->name('assigntask.edit');
     Route::post('/assigntask/update','TeamLeader\Datacircle\AssignTaskController@update')->name('assigntask.update');
     Route::post('/assigntask/search','TeamLeader\Datacircle\AssignTaskController@search')->name('assigntask.search');
     Route::get('/assigntask/getMoreTasks','TeamLeader\Datacircle\AssignTaskController@getMoreTasks')->name('assigntask.getMoreTasks');
     //End of Assign Task
    });
    //END OF DATACIRCLE

    //START OF GIS
    Route::prefix('gis')->group(function () {
        //TASK
        Route::get('/task','TeamLeader\GIS\TaskController@index')->name('GIS.teamleader.task');
        Route::get('/task/{task}/edit','TeamLeader\GIS\TaskController@edit')->name('teamleader.edit');
        Route::post('/task/update','TeamLeader\GIS\TaskController@update')->name('teamleader.update');
        Route::get('/task/done/{task}','TeamLeader\GIS\TaskController@done')->name('teamleader.done');
        Route::get('/task/getMoreTasks','TeamLeader\GIS\TaskController@getMoreTasks')->name('teamleader.task.getMoreTasks');
        //End of Task
    
        //ReviewPending
        Route::get('reviewpending','TeamLeader\GIS\ReviewPendingController@index')->name('GIS.teamleader.reviewpending');
        Route::get('/pending/getallmembers','TeamLeader\GIS\ReviewPendingController@getallmembers')->name('teamleader.getallmembers');
        Route::get('/pending/{pending}/edit','TeamLeader\GIS\ReviewPendingController@edit')->name('teamleader.edit');
        Route::post('/pending/update','TeamLeader\GIS\ReviewPendingController@update')->name('teamleader.update');
        Route::get('/pending/finish/{pending}','TeamLeader\GIS\ReviewPendingController@finish')->name('teamleader.finish');
        Route::get('/reviews/reviewlist/{view}','TeamLeader\GIS\ReviewPendingController@view')->name('teamleader.view1');
        Route::get('/reviewpending/getMorePendings','TeamLeader\GIS\ReviewPendingController@getMorePendings')->name('teamleader.reviewpending.getMorePendings');
        //end of reviewpending
    
        //Review
        Route::get('reviews','TeamLeader\GIS\ReviewController@index')->name('GIS.teamleader.review');
        Route::get('/reviewpending/getMoreReviews','TeamLeader\GIS\ReviewController@getMoreReviews')->name('teamleader.reviewcontroller.getMoreReviews');
        Route::get('/review/{review}/edit','TeamLeader\GIS\ReviewController@edit')->name('review.edit');
        Route::post('/review/update','TeamLeader\GIS\ReviewController@update')->name('review.update');
        Route::get('/review/done/{review}','TeamLeader\GIS\ReviewController@reviewed')->name('teamleader.reviewed');
        //End of Review
    
         //Assign Task
         Route::get('/assigntask','TeamLeader\GIS\AssignTaskController@index')->name('GIS.teamleader.assigntask');
         Route::get('/assigntask/getallmembers','TeamLeader\GIS\AssignTaskController@getallmembers')->name('gis.assigntask.getallmembers');
         Route::post('/assigntask/store','TeamLeader\GIS\AssignTaskController@store')->name('assigntask.store');
         Route::get('/assigntask/{assigntask}/edit','TeamLeader\GIS\AssignTaskController@edit')->name('assigntask.edit');
         Route::post('/assigntask/update','TeamLeader\GIS\AssignTaskController@update')->name('assigntask.update');
         Route::post('/assigntask/search','TeamLeader\GIS\AssignTaskController@search')->name('assigntask.search');
         Route::get('/assigntask/getMoreTasks','TeamLeader\GIS\AssignTaskController@getMoreTasks')->name('assigntask.getMoreTasks');
         //End of Assign Task
        });
        //END OF GIS

 //TimeSheet
    Route::get('timesheet','TeamLeader\TimeSheetController@index')->name('teamleader.timesheet');
    Route::get('/timesheet/getjobs','TeamLeader\TimeSheetController@getjobs')->name('timesheet.getjobs');
    Route::post('/timesheet/store','TeamLeader\TimeSheetController@store')->name('timesheet.store');
    Route::get('/timesheet/{timesheet}/edit','TeamLeader\TimeSheetController@edit')->name('timesheet.edit');
    Route::post('/timesheet/update','TeamLeader\TimeSheetController@update')->name('timesheet.update');
    Route::get('/timesheet/delete/{timesheet}','TeamLeader\TimeSheetController@delete')->name('timesheet.delete');
    //End of TimeSheet

    //Team
    Route::get('/team','TeamLeader\TeamController@index')->name('teamleader.team');
    Route::get('/team/timesheet/{team}','TeamLeader\TeamController@view')->name('teamleader.view');
    //ENd of Team


});

//END OF TEAM LEADER
Route::prefix('hank')->group(function () {
    Route::get('/dashboard','Plieger\UserController@index')->name('plieger.dashboard');
    Route::get('/detail', 'Plieger\UserController@detail')->name('plieger.detail');
    Route::get('/update','Plieger\UserController@update')->name('plieger.update');
    Route::get('/changepassrq', 'Plieger\UserController@changepassrq')->name('plieger.changepassrq');
    Route::get('/changepass', 'Plieger\UserController@changepass')->name('plieger.changepass');
    Route::get('/issue','Plieger\IssueController@index')->name('plieger.issue');
    Route::get('/issue/reassign/{issue}','Plieger\IssueController@issue')->name('plieger.reassign');
    Route::post('/issuefeedback','Plieger\IssueController@issuefeedback')->name('plieger.issuefeedback');
    Route::get('review','Plieger\ReviewController@index')->name('plieger.review');
    Route::post('/pending/issueupdate','Plieger\ReviewController@issueupdate')->name('plieger.issueupdate');
    Route::get('/getMoreReview','Plieger\ReviewController@getMoreReview')->name('plieger.getMoreReview');
    Route::get('/queries/{pending}','Plieger\ReviewController@queries')->name('plieger.queries');
    Route::get('/plieger/getMoreIssue','Plieger\IssueController@getMoreIssue')->name('plieger.getMoreIssue');
    Route::get('/showchart', 'Plieger\UserController@showchart')->name('plieger.showchart'); 
    Route::get('/test', 'Plieger\UserController@test')->name('plieger.test'); 
});
Route::get('/showchart', 'Admin\AdminController@showchart')->name('showchart'); 




















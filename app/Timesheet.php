<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $table='timesheets';
    protected $fillable = [
        'task_name','user_id','date','start_time','end_time','remarks','time_taken','status',
        
    ];

    public function users()
    {
        return $this->belongsTo('App\Admin', 'user_id');
    }
}

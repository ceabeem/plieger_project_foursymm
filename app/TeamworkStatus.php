<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamworkStatus extends Model
{
    protected $table='team_work_status';
    protected $fillable = [
        'team_id','member_id','name','total_assigned_task','team_leader_reviewed','team_supervisor_reviewed','status',
        
    ];

    public function teams()
    {
        return $this->belongsTo('App\Team', 'team_id');
    }
}

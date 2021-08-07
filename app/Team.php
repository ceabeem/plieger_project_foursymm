<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table='teams';
    protected $fillable = [
        'team_name','status',
        
    ];

    public function members()
    {
        return $this->hasMany('App\Member', 'team_id');
    }

    public function workstatus()
    {
        return $this->hasMany('App\TeamworkStatus', 'team_id');
    }
}

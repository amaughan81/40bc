<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $fillable = [
        'name',
        'notes',
        'stime',
        'etime'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function createdBy(User $user) {
        return $this->user_id == $user->id;
    }

    public function progress() {
        return $this->belongsToMany('App\User', 'progress_user',
            'bar_id', 'user_id')->withPivot('finish_time');
    }
}

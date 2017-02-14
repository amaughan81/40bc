<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressUser extends Model
{
    protected $table = "progress_user";
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'bar_id', 'finish_time'
    ];

    public function bar() {
        $this->belongsTo('App\Bar', 'bar_id');
    }

    public function user() {
        $this->hasMany('App\User', 'user_id');
    }
}

<?php
use Carbon\Carbon;

function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');

    if(func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

function finish_time($progress) {
    $user_id = Auth::user()->id;
    foreach($progress as $p) {
        if($p->pivot->user_id == $user_id) {
            return Carbon::parse($p->pivot->finish_time)->format("H:i");
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\ProgressUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function set($bar_id) {

        $json = ['result'=>false,'status'=>null];

        $id = 0;

        $progress = ProgressUser::where('bar_id', '=', $bar_id)->get();
        if(count($progress) > 0) {
            foreach($progress as $p) {

                if($p->user_id == Auth::user()->id) {
                    $id = $p->id;
                }

            }
        }
        if($id > 0) {
            if(ProgressUser::findOrFail($id)->delete()) {
                $json['result'] = true;
                $json['status'] = 'remove';
            }
        }
        else {
            $data = [
                'user_id' => Auth::user()->id,
                'bar_id' =>$bar_id,
                'finish_time' => Carbon::now()
            ];
            if(ProgressUser::create($data)) {
                $json['result'] = true;
                $json['status'] = 'set';
                $json['ftime'] = Carbon::now()->format("H:i");
            }
        }
        return response()->json($json);

    }
}

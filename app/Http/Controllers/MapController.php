<?php

namespace App\Http\Controllers;

use App\Bar;
use App\Http\Requests\BarRequest;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $bars = Bar::all();
        return view('map.index', compact('bars'));
    }

    public function bar(Bar $bar) {
        return view('map.bar', compact('bar'));
    }
}

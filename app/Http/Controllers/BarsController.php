<?php

namespace App\Http\Controllers;

use App\Acl;
use App\Bar;
use App\Http\Requests\BarRequest;
use App\ProgressUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarsController extends Controller
{
    public function __construct()
    {
        Acl::allow('member');
        Acl::allow('editor');
        Acl::allow('admin');

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bars = Bar::all();
        return view('bars.index', compact('bars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarRequest $request)
    {
        $bar = Auth::User()->createBar(
            new Bar($request->all())
        );

        flash()->success('Success!', 'Bar added to the Challenge!');

        return redirect('/bars');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bar $bar)
    {
        return view('bars.edit', compact('bar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BarRequest $request, Bar $bar)
    {
        $bar->update($request->all());
        return redirect('/bars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $json = ['result'=>false];
        if(Bar::findOrFail($id)->delete()) {
            $json['result'] = true;
        }
        return response()->json($json);
    }
}

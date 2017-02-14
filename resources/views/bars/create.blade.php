@extends('layouts.default')

@section('content')
    <h1>Create Bar</h1>
    <form class="form-horizontal" role="form" method="POST" action="/bars">
        @include('bars._form')
        <div class="col-md-12">
            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Bar</button>
            </div>
        </div>
    </form>
@stop
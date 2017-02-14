@extends('layouts.default')

@section('content')
    <h1>Edit Bar</h1>
    <form class="form-horizontal" role="form" method="POST" action="/bars/{{ $bar->id }}">
        {{ method_field('PATCH') }}
        @include('bars._form')
        <div class="col-md-12">
            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Bar</button>
            </div>
        </div>
    </form>
@stop
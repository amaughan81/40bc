@extends('layouts.default')

@section('content')
    <h1>{{ count($bars)}} Bar Challenge</h1>
    @if(isAdmin())
    <div class="col-md-12" style="margin-bottom:14px">
        <div class="row">
        <a href="/bars/create" class="btn btn-primary pull-right">Add Bar</a>
        </div>
    </div>
    @endif
    <table class="table table-striped">
        @foreach($bars as $bar)
        <tr id="bar_{{ $bar['id'] }}">
            <td>{{ $bar['name'] }} </td>
            <td>{{ $bar['stime'] }} - {{ $bar['etime'] }}</td>
            <td class="ftime">@if(count($bar->progress) > 0) {{ finish_time($bar->progress) }} @endif</td>
            <td class="text-right">
                <button class="btn @if(finish_time($bar->progress, $bar['user_id']) != "")btn-success @else btn-default @endif glyphicon glyphicon-ok progress-btn" data-bid="{{ $bar['id'] }}"></button>
                <a href="/map/bar/{{ $bar['id'] }}" class="btn btn-default glyphicon glyphicon-map-marker"></a>
            @if(isAdmin())
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="/bars/{{ $bar['id'] }}/edit">
                                <span class="glyphicon glyphicon-pencil" style="margin-right:10px"></span>
                                Edit
                            </a>
                        </li>
                        <li>
                            <a class="delete-bar-btn" data-bid="{{ $bar['id'] }}">
                                <span class="glyphicon glyphicon-remove" style="margin-right:10px"></span>
                                Delete
                                <form action="/bars/{{ $bar['id'] }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>
                            </a>

                        </li>
                    </ul>
                </div>
            @endif
            </td>
        </tr>
        @endforeach
    </table>

@stop

@section('css')
<link href="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.min.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.delete-bar-btn', function() {
            var bid = $(this).data('bid');
            var formData = $(this).children('form').serialize();

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    dataType: 'json',
                    type: 'post',
                    url: '/bars/'+bid,
                    data: formData,
                    success: function(data) {
                        if(data.result) {
                            $("#bar_"+bid).remove();
                            swal(
                                'Deleted!',
                                'Your bar has been deleted.',
                                'success'
                            );
                        }
                    }
                });

            })

        });

        $(document).on('click', '.progress-btn', function() {
            var btn = $(this);
            var bid = btn.data('bid');
            $.ajax({
                url: '/progress/'+bid,
                dataType: 'json',
                type: 'get',
                success: function(data) {
                    if(data.result) {
                        if(data.status == "set") {
                            btn.removeClass('btn-default');
                            btn.addClass('btn-success');
                            btn.parent().prev().html(data.ftime);
                        } else {
                            btn.removeClass('btn-success');
                            btn.addClass('btn-default');
                            btn.parent().prev().html("");
                        }
                    }
                }
            });
        });
    });
</script>
@stop


    <div class="col-md-6">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="street">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ isset($bar)? $bar->name : old('name') }}" required />
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="description" id="notes" class="form-control">{{ isset($bar)? $bar->description :  old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="stime">Start Time:</label>
            <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" name="stime" id="stime" class="form-control bar-times" value="{{ isset($bar)? $bar->stime :  old('stime') }}" required />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                 </span>
            </div>
        </div>
        <div class="form-group">
            <label for="etime">End Time:</label>
            <div class="input-group clockpicker" data-autoclose="true">
                <input type="text" name="etime" id="etime" class="form-control bar-times" value="{{ isset($bar)? $bar->etime :  old('etime') }}" required />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                 </span>
            </div>
        </div>
    </div>



@section('scripts')
    <script src="/js/moment.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(".clockpicker").clockpicker();
    </script>

@stop
@section('css')
<link href="/css/bootstrap-clockpicker.min.css" rel="stylesheet">
@stop
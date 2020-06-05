@extends('layouts.app', ['page' => __('Time table'), 'pageSlug' => 'timetable'])

@section('content')
<div class="row">
  <div class="card">
    <div class="card-header">
      <h5 class="title">{{ __('Time table') }}</h5>
    </div>
    <form method="post" action="{{ route('timetable.store') }}" autocomplete="off">
      <div class="card-body">
        @csrf
        @method('put')

        @include('alerts.success')
        
        <div class="form-group{{ $errors->has('teacher_subject_id') ? ' has-danger' : '' }}">
          <select class="form-control" name="teacher_subject_id" style="width: 50%;">
            @foreach($teacher_subjects as $item)
            <option class="text-dark" value={{$item->id}}>
              {{App\Classe::find($item->class_id)->class}}
              {{App\Subject::find($item->subject_id)->name}}
              {{App\Personne::find($item->teacher_id)->firstname  }} {{App\Personne::find($item->teacher_id)->lastname  }}
            </option>
            @endforeach
            @include('alerts.feedback', ['field' => 'teacher_subject_id'])
          </select>
        </div>
        <div class="form-group{{ $errors->has('day_no') ? ' has-danger' : '' }}">
          <label>{{ __('Day No') }}</label>
          <input type="date" name="day_no" id="day_no" class="form-control{{ $errors->has('day_no') ? ' is-invalid' : '' }}" placeholder="{{ __('day name') }}" value="">
          @include('alerts.feedback', ['field' => 'day_no'])
        </div>
        <div class="form-group{{ $errors->has('day_name') ? ' has-danger' : '' }}">
          <label>{{ __('Day name') }}</label>
          <input type="text" name="day_name" id="day_name" class="form-control{{ $errors->has('day_name') ? ' is-invalid' : '' }}" placeholder="{{ __('day name') }}" value="">
          @include('alerts.feedback', ['field' => 'day_name'])
        </div>
        <div class="form-group{{ $errors->has('start_time') ? ' has-danger' : '' }}">
          <label>{{ __('Start time') }}</label>
          <input type="text" name="start_time" id="start_time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" placeholder="{{ __('9:00 AM') }}" value="">
          @include('alerts.feedback', ['field' => 'start_time'])
        </div>
        <div class="form-group{{ $errors->has('end_time') ? ' has-danger' : '' }}">
          <label>{{ __('End time') }}</label>
          <input type="text" name="end_time" id="end_time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" placeholder="{{ __('12:00 AM') }}" value="">
          @include('alerts.feedback', ['field' => 'end_time'])
        </div>
        <div class="form-group{{ $errors->has('room_no') ? ' has-danger' : '' }}">
          <label>{{ __('Room no') }}</label>
          <input type="text" name="room_no" id="room_no" class="form-control{{ $errors->has('room_no') ? ' is-invalid' : '' }}" placeholder="{{ __('Room 102') }}" value="">
          @include('alerts.feedback', ['field' => 'room_no'])
        </div>
        <div class="form-group{{ $errors->has('is_active') ? ' has-danger' : '' }}">
          <label>{{ __('is Active') }}</label>
          <input type="text" name="is_active" id="is_active" class="form-control{{ $errors->has('is_active') ? ' is-invalid' : '' }}" placeholder="{{ __('yes or no') }}" value="">
          @include('alerts.feedback', ['field' => 'is_active'])
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
      </div>
    </form>
  </div>
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <h4 class="card-title"> Time table</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="teacher_subjects_table" class="table tablesorter">
            <thead class="text-primary">
              <tr>
                <th> Id</th>
                <th> Teacher subject </th>
                <th> Day No </th>
                <th> Day name </th>
                <th> Start time </th>
                <th> End time </th>
                <th> Room no </th>
                <th> Is Active</th>
                <th> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($timetables as $item)
              <tr class="item{{$item->id}}">
                <td>{{$item->id }}</td>
                <td> 
                  {{App\Classe::find(App\Teacher_subject::find($item->teacher_subject_id)->class_id)->class }}
                  {{App\Subject::find(App\Teacher_subject::find($item->teacher_subject_id)->subject_id)->name }}
                </td>
                <td>{{$item->day_no }}</td>
                <td>{{$item->day_name }}</td>
                <td>{{$item->start_time }}</td>
                <td>{{$item->end_time }}</td>
                <td>{{$item->room_no }}</td>
                <td>{{$item->is_active }}</td>
                <td>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; transform: translate3d(-108px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                      <button class="edit-modal dropdown-item" data-info="{{$item->id }},{{$item->teacher_subject_id }},{{$item->day_no }},{{$item->day_name }},{{$item->start_time }},{{$item->end_time }},{{$item->room_no }},{{$item->is_active }}">Edit</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">

          <form class="form-horizontal" role="form">
            @csrf
            @method('post')
            <div class="form-group">
              <label class="control-label" for="mid">ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control text-muted" id="mid" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="mday_no">Day No</label>
              <div class="col-sm-10">
                <input type="date" class="form-control  text-dark" id="mday_no" name="mday_no">
                @include('alerts.feedback', ['field' => 'day_no'])
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="mday_name">Day name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control  text-dark" id="mday_name" name="mday_namee">
                @include('alerts.feedback', ['field' => 'day_name'])
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="mstart_time">Start time</label>
              <div class="col-sm-10">
                <input type="text" class="form-control  text-dark" id="mstart_time" name="mstart_time">
                @include('alerts.feedback', ['field' => 'start_time'])
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="mend_time">End time</label>
              <div class="col-sm-10">
                <input type="text" class="form-control  text-dark" id="mend_time" name="mend_time">
                @include('alerts.feedback', ['field' => 'end_time'])
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="mroom_no">Room no</label>
              <div class="col-sm-10">
                <input type="text" class="form-control  text-dark" id="mroom_no" name="mroom_no">
                @include('alerts.feedback', ['field' => 'room_no'])
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="mactive">Active:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control text-dark" id="mactive" name="mactive">
                @include('alerts.feedback', ['field' => 'is_active'])
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn actionBtn" data-dismiss="modal">
                <span id="footer_action_button" class='glyphicon'> </span>
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">
                <span class='glyphicon glyphicon-remove'></span> Close
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
<script>
  
  var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  $('#day_no').change(function() {
    var date = $(this).val();
    var a = new Date(date);
    $('#day_name').val(weekday[a.getDay()]);
});
function fillmodalData(details) {
    $('#mid').val(details[0]);
    var now = new Date(details[2]);
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#mday_no').val(today);
    $('#mday_name').val(details[3]);
    $('#mstart_time').val(details[4]);
    $('#mend_time').val(details[5]);
    $('#mroom_no').val(details[6]);
    $('#mactive').val(details[7]);
  }
  $(document).on('click', '.edit-modal', function() {
    $('#footer_action_button').text(" Update");
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete');
    $('.actionBtn').addClass('edit');
    $('.modal-title').text('Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    var stuff = $(this).data('info').split(',');
    fillmodalData(stuff)
    $('#myModal').modal('show');
  });


  $('.modal-footer').on('click', '.edit', function() {
    $.ajax({
      type: 'post',
      url: 'teacher_subject/update',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        '_token': $('input[name=_token]').val(),
        'day_no': $('#mday_no').val(),
        'day_name': $('#mday_name').val(),
        'start_time': $('#mstart_time').val(),
        'end_time': $('#mend_time').val(),
        'room_no': $('#mroom_no').val(),
        'is_active': $('#mactive').val(),
        'id': $('#mid').val()

      },
      success: function(data) {
        location.reload();
      }
    });
  });
</script>
@endsection

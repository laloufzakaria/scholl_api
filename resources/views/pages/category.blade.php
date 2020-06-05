@extends('layouts.app', ['page' => __('Categorie'), 'pageSlug' => 'category'])

@section('content')
<div class="row">
  <div class="card">
    <div class="card-header">
      <h5 class="title">{{ __('Categorie') }}</h5>
    </div>
    <form method="post" action="{{ route('category.store') }}" autocomplete="off">
      <div class="card-body">
        @csrf
        @method('put')

        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
          <label>{{ __('Name') }}</label>
          <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="">
          @include('alerts.feedback', ['field' => 'name'])
        </div>
        <div class="form-group{{ $errors->has('is_active') ? ' has-danger' : '' }}">
          <label>{{ __('is Alive') }}</label>
          <input type="text" name="is_active" id="is_active" class="form-control{{ $errors->has('is_active') ? ' is-invalid' : '' }}" placeholder="{{ __('yes & no') }}" value="">
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
        <h4 class="card-title"> Categories</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="category_table" class="table tablesorter">
            <thead class="text-primary">
              <tr>
                <th>Id</th>
                <th> Name</th>
                <th>Is Active</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($category as $item)
              <tr class="item{{$item->id}}">
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->is_active}}</td>
                <td>
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; transform: translate3d(-108px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                      <button class="edit-modal dropdown-item" data-info="{{$item->id}},{{$item->name}},{{$item->is_active}}">Edit</a>
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

            @include('alerts.success')
            <div class="form-group">
              <label class="control-label col-sm-2" for="mid">ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control text-muted" id="mid" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="mname">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control  text-dark" id="mname" name="mname">
                @include('alerts.feedback', ['field' => 'name'])
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="macive">Active:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control text-dark" id="mactive" name="mactive">
                @include('alerts.feedback', ['field' => 'is_active'])
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn actionBtn" data-dismiss="modal">
                <span id="footer_action_button" class='glyphicon'> </span>
              </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal" >
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
  function fillmodalData(details) {
    $('#mid').val(details[0]);
    $('#mname').val(details[1]);
    $('#mactive').val(details[2]);
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
      url: 'category/update',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        '_token': $('input[name=_token]').val(),
        'name': $('#mname').val(),
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
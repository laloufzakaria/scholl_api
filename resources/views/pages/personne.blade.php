@extends('layouts.app', ['page' => __('Personnes'), 'pageSlug' => 'personne'])

@section('content')

<div class="row">
    <div class="card">
        <div class="card-header">
            <h5 class="title">{{ __('Personne') }}</h5>
        </div>
        <form method="post" action="{{ route('personne.store') }}" autocomplete="off">
            <div class="card-body">
                @csrf
                @method('put')

                @include('alerts.success')
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label>{{ __('First Name') }}</label>
                    <input type="text" name="firstname" id="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" value="">
                    @include('alerts.feedback', ['field' => 'firstname'])
                </div>
                <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                    <label>{{ __('Last Name') }}</label>
                    <input type="text" name="lastname" id="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" value="">
                    @include('alerts.feedback', ['field' => 'lastname'])
                </div>
                <div class="form-group{{ $errors->has('mobileno') ? ' has-danger' : '' }}">
                    <label>{{ __('Mobile no') }}</label>
                    <input type="phone" name="mobileno" id="mobileno" class="form-control{{ $errors->has('mobileno') ? ' is-invalid' : '' }}" placeholder="{{ __('06...') }}" value="">
                    @include('alerts.feedback', ['field' => 'mobileno'])
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label>{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="">
                    @include('alerts.feedback', ['field' => 'email'])
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                    @include('alerts.feedback', ['field' => 'password'])
                </div>
                <div class="form-group{{ $errors->has('dob') ? ' has-danger' : '' }}">
                    <label>{{ __('Date de naissance') }}</label>
                    <input type="date" name="dob" id="dob" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" value="">
                    @include('alerts.feedback', ['field' => 'dob'])
                </div>
                <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                    <label>{{ __('Gender') }}</label>
                    <input type="text" name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" placeholder="{{ __('m or f') }}" value="">
                    @include('alerts.feedback', ['field' => 'gender'])
                </div>
                <div class="form-group{{ $errors->has('class_id') ? ' has-danger' : '' }}">
                <select class="form-control" name="category_id" style="width: 35%;">
                    @foreach($categories as $categorie)
                    <option class="text-dark" value={{$categorie->id}}>{{$categorie->name}}</option>
                    @endforeach
                    @include('alerts.feedback', ['field' => 'category_id'])
                </select>
                </div>
                <div class="form-group{{ $errors->has('class_id') ? ' has-danger' : '' }}">
                <select class="form-control" name="class_id" style="width: 35%;" >
                    @foreach($classes as $classe)
                    <option class="text-dark" value={{$classe->id}}>{{$classe->class}}</option>
                    @endforeach
                    @include('alerts.feedback', ['field' => 'class_id'])
                </select>
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
                <h4 class="card-title"> Personnes</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="personne_table" class="table tablesorter">
                        <thead class="text-primary">
                            <tr>
                                <th> Id</th>
                                <th> First Name</th>
                                <th> Last Name</th>
                                <th> Email</th>
                                <th> Is Active</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personnes as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->firstname}}</td>
                                <td>{{$item->lastname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->is_active}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; transform: translate3d(-108px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <button class="edit-modal dropdown-item" data-info="{{$item->id}},{{$item->firstname}},{{$item->lastname}},{{$item->email}},{{$item->is_active}}">Edit</a>
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
                            <label class="control-label col-sm-2" for="mid">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-muted" id="mid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="mname">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  text-dark" id="mname" name="mname">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="mcode">Lats Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  text-dark" id="mcode" name="mcode">
                                @include('alerts.feedback', ['field' => 'code'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="mtype">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  text-dark" id="mtype" name="mtype">
                                @include('alerts.feedback', ['field' => 'type'])
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
    function fillmodalData(details) {
        $('#mid').val(details[0]);
        $('#mname').val(details[1]);
        $('#mcode').val(details[2]);
        $('#mtype').val(details[3]);
        $('#mactive').val(details[4]);
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
            url: 'personne/update',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_token': $('input[name=_token]').val(),
                'firstname': $('#mname').val(),
                'lastname': $('#mcode').val(),
                'email': $('#mtype').val(),
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
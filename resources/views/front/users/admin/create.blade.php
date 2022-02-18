@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-example">
                            <h2 class="sub-header">@lang('form.create')</h2>
                            <div class="table-responsive">
                                {!! Form::open(['method' => 'POST', 'route' => 'store_admin_user']) !!}
                                <div class="col-md-3 form-group">
                                    {!! Form::label('name', trans('user.name'),['class' => 'control-label']) !!}
                                    {!! Form::text('name', old('name'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('surname', trans('user.surname'),['class' => 'control-label']) !!}
                                    {!! Form::text('surname', old('surname'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('phone', trans('user.phone'),['class' => 'control-label']) !!}
                                    {!! Form::text('phone', old('phone'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('email', trans('user.email'),['class' => 'control-label']) !!}
                                    {!! Form::email('email', old('email'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('role_id', trans('user.role'),['class' => 'control-label']) !!}
                                    {!! Form::select('role_id[]',$roles, old('role_id'), array_merge(['class'
                                    =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('password', trans('user.password'),['class' => 'control-label']) !!}
                                    {!! Form::text('password', '', array_merge(['class'=>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::submit(trans('form.save'),array_merge(['class' => 'btn btn-default'] )) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

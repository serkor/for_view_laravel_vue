@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-example">
                            <h2 class="sub-header">@lang('form.edit') - {{$appeal->name}}</h2>
                            <div class="table-responsive">
                                {!! Form::model($appeal,['method' => 'PUT', 'route' => ['appeals.update',$appeal->id]]) !!}
                                <div class="col-md-3 form-group">
                                    {!! Form::label('name', trans('appeal.name'),['class' => 'control-label'])!!}
                                    {!! Form::text('name', old('name'), array_merge(['class'
                                    =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('email', trans('appeal.email'),['class' => 'control-label']) !!}
                                    {!! Form::email('email', old('email'), array_merge(['class' =>'form-control']))
                                     !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('description', trans('appeal.description'),['class' =>
                                    'control-label'])!!}
                                    {!! Form::textarea('description', old('description'), array_merge(['class'
                                    =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('status_id', trans('appeal.status'),['class' => 'control-label']) !!}
                                    {!! Form::select('status_id', [0 => trans('appeal.new'), 1 => trans('appeal.in_work'), 2 => trans('appeal.canceled')], old('status_id'), array_merge(['class' => 'form-control', 'required' => 'required'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::submit(trans('form.save'),array_merge(['class' => 'btn btn-primary'] )) !!}
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

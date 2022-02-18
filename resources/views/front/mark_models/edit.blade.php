@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h2 class="sub-header">@lang('form.edit') - {{$mark_model->name}}</h2>
                    <div class="card-body">
                        <div class="bs-example">
                            {!! Form::model($mark_model,['method' => 'PUT', 'route' => ['mark-models.update', $mark_model->id]])!!}
                            <div class="col-md-6 form-group">
                                {!! Form::label('name', trans('auto.model.name'),['class' => 'control-label'])!!}
                                {!! Form::text('name', old('name'), array_merge(['class' =>'form-control'])) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                {!! Form::label('mark_id', trans('auto.model.mark_id'),['class' => 'control-label'])!!}
                                <marks-select :marks="{{$marks}}" :mark_model="{{$mark_model}}"></marks-select>
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
@endsection

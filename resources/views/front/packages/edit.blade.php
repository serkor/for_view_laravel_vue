@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h2 class="sub-header">@lang('form.edit') - {{$package->name}}</h2>
                    <div class="card-body">
                        <div class="bs-example">
                            <div class="table-responsive">
                                {!! Form::model($package,['method' => 'PUT', 'route' => ['admin_package_update', $package->id]])!!}
                                <div class="col-md-6 form-group">
                                    {!! Form::label('name', trans('package.name'),['class' => 'control-label'])!!}
                                    {!! Form::text('name', old('name'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-6 form-group">
                                    {!! Form::label('price', trans('package.price'),['class' => 'control-label'])!!}
                                    {!! Form::text('price', old('price'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-6 form-group">
                                    {!! Form::label('limit_offers', trans('package.limit_offers'),['class' => 'control-label'])!!}
                                    {!! Form::text('limit_offers', old('limit_offers'), array_merge(['class' =>'form-control'])) !!}
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

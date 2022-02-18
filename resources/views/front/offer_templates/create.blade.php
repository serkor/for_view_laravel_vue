@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h2 class="sub-header">@lang('form.create')</h2>
                    <div class="card-body">
                        <div class="bs-example">
                            <div class="table-responsive">
                                {!! Form::open(['method' => 'POST', 'route' => 'offer-templates.store']) !!}
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        {!! Form::label('name', trans('offer_template.name'),['class' => 'control-label'])!!}
                                        {!! Form::text('name', old('name'), array_merge(['class' =>'form-control','required']))!!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        {!! Form::label('executor_id', trans('offer_template.executor_id'),['class' => 'control-label'])!!}
                                        {!! Form::select('executor_id', $executors, old('executor_id'), array_merge(['class' => 'form-control'])) !!}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        {!! Form::label('sum_repair', trans('offer_template.sum_repair'),['class' => 'control-label'])!!}
                                        {!! Form::text('sum_repair', old('sum_repair'), array_merge(['class' =>'form-control','required']))!!}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        {!! Form::label('sum_part', trans('offer_template.sum_part'),['class' => 'control-label'])!!}
                                        {!! Form::text('sum_part', old('sum_part'), array_merge(['class' =>'form-control','required']))!!}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        {!! Form::label('number_hours', trans('offer_template.number_hours'),['class' => 'control-label'])!!}
                                        {!! Form::text('number_hours', old('number_hours'), array_merge(['class' =>'form-control','required']))!!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        {!! Form::label('description', trans('offer_template.description'),['class' => 'control-label'])!!}
                                        {!! Form::textarea('description', old('description'), array_merge(['class' =>'form-control','required']))!!}
                                    </div>
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


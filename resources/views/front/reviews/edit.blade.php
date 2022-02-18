@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-example">
                            <h2 class="sub-header">@lang('form.edit') - {{$review->id}}</h2>
                            <div class="table-responsive">
                                {!! Form::model($review,['method' => 'PUT','route' => ['update_admin_review', $review->id]])!!}
                                <div class="col-md-6 form-group">
                                    {!! Form::label('description', trans('review.description_form'),['class' => 'control-label'])!!}
                                    {!! Form::textarea('description', old('description'), array_merge(['class' =>'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('public', trans('review.public'),['class' => 'control-label']) !!}
                                    {!! Form::select('public', [0 => trans('review.off'), 1 => trans('review.on')], old('public'), array_merge(['class'
                                     => 'form-control'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::submit(trans('form.update'),array_merge(['class' => 'btn btn-primary'] )) !!}
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

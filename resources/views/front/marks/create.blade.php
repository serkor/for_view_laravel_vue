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
                                {!! Form::open(['method' => 'POST', 'route' => 'marks.store']) !!}
                                <div class="col-md-6 form-group">
                                    {!! Form::label('name', trans('auto.mark.name'),['class' => 'control-label'])!!}
                                    {!! Form::text('name', old('name'), array_merge(['class' =>'form-control','required']))!!}
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

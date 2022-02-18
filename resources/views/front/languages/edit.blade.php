@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="bs-example">
                            <h2 class="sub-header">@lang('form.edit') - {{$language->locate_code}}</h2>
                            <div class="table-responsive">
                                {!! Form::model($language,['method' => 'PUT','files' => TRUE, 'route' =>
                              ['languages.update',$language->id]]) !!}
                                <div class="col-md-3 form-group">
                                    {!! Form::label('locate_code', trans('language.code'),['class' => 'control-label']) !!}
                                    {!! Form::text('locate_code', $language->locate_code, array_merge(['class' => 'form-control',
                                    'disabled' => 'disabled'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('name', trans('language.name'),['class' => 'control-label']) !!}
                                    {!! Form::text('name', $language->name, array_merge(['class' => 'form-control',
                                    'disabled' => 'disabled'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('script', trans('language.script'),['class' => 'control-label']) !!}
                                    {!! Form::text('script', $language->script, array_merge(['class' => 'form-control',
                                    'disabled' => 'disabled'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('native', trans('language.native'),['class' => 'control-label']) !!}
                                    {!! Form::text('native', $language->native, array_merge(['class' => 'form-control',
                                    'disabled' => 'disabled'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('regional', trans('language.regional'),['class' => 'control-label']) !!}
                                    {!! Form::text('regional', $language->regional, array_merge(['class' => 'form-control',
                                    'disabled' => 'disabled'])) !!}
                                </div>
                                <div class="col-md-3 form-group">
                                    {!! Form::label('default', trans('language.default'),['class' => 'control-label']) !!}
                                    {!! Form::select('default', [0 => trans('form.no'),1 => trans('form.yes')], old
                                    ($language->default),
                                    array_merge(['class'=>'form-control'])) !!}
                                </div>

                                <div class="col-md-6 form-group">
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


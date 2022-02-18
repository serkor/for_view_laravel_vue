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
                                <div class="col-md-12">
                                        {!! Form::open(['method' => 'POST', 'route' => 'store_admin_blog_category']) !!}
                                        <div class="col-md-6 form-group">
                                            {!! Form::label('name', trans('blog_category.name'),['class' => 'control-label'])!!}
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
        </div>
    </div>
@endsection


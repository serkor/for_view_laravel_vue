@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h2 class="sub-header">@lang('form.edit') - {{$category->name}}</h2>
                    <div class="card-body">
                        <div class="bs-example">
                            {!! Form::model($category,['method' => 'PUT','route' => ['update_admin_category', $category->id]])!!}
                            <div class="col-md-6 form-group">
                                {!! Form::label('name', trans('category.name'),['class' => 'control-label'])!!}
                                {!! Form::text('name', old('name'), array_merge(['class' =>'form-control'])) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                {!! Form::label('parent_id', trans('category.parent_id'),['class' => 'control-label'])!!}
                                <category-parent-select
                                    :parent="{{$category}}"
                                    :categories="{{$categories}}">
                                </category-parent-select>
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

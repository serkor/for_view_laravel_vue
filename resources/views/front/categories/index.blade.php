@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('category.title')</div>
                    <div class="card-body">
                        @include('front.categories.filter')
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('create_admin_category')}}"
                                   class="btn btn-secondary">@lang('form.create')</a>
                                <div class="table-responsive">
                                    <hr>
                                    <table class="table table-striped table-hover table-bordered datatable">
                                        <thead>
                                        <tr>
                                            <th>@lang('form.id')</th>
                                            <th>@lang('category.name')</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>
                                                    <a class="btn btn-warning"
                                                       href="{{route('edit_admin_category',$category->id)}}">
                                                        @lang('form.edit')</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

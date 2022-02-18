@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                <h1>@lang('blog_article.title')</h1>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{route('create_admin_blog_article')}}"
                                           class="btn btn-secondary">@lang('form.create')</a>
                                        <div class="table-responsive">
                                            <hr>
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('blog_article.name')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($articles as $article)
                                                    <tr>
                                                        <td>{{$article->id}}</td>
                                                        <td>{{$article->name}}</td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                               href="{{route('edit_admin_blog_article', $article->id)}}">
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
        </div>
    </div>
@endsection

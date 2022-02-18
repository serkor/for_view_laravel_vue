@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    {{$article->name}}
                </p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="hero-body">
            <div class="box_account box">
                <div class="columns">
                    <div class="column is-2">
                        @include('site.blog.blog_sidebar')
                    </div>
                    <div class="column is-10">
                        <div class="columns">
                            <div class="column">
                                @if($article->image ?? [])
                                    <img id="blah" class="card-img-top"
                                         src="{{ asset('storage/blog/'.$article->image) }}" alt="blog_image">
                                @else
                                    <img class="card-img-top"
                                         src="{{ asset('public/images/service_no.png') }}"
                                         alt="blog_image">
                                @endif
                            </div>
                            <div class="column">
                                <p>{{$article->description}}</p>
                                <hr/>
                                <div class="columns">
                                    <div class="column is-8">
                                        <small class="text-muted">
                                            @lang('blog_article.category')
                                            <a href="{{route('blog_category', $article->blog_category->id)}}">
                                                {{$article->blog_category->name}}</a>
                                        </small>
                                    </div>
                                    <div class="column is-4">
                                        <small class="text-muted">{{$article->created_at}}</small>
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


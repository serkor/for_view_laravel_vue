@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    {{$category->name}}
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
                        <div class="columns is-multiline">
                            @foreach($articles as $article)
                                <div class="column is-one-third">
                                    @if($article->image ?? [])
                                        <img id="blah" class="card-img-top image_blog_category"
                                             src="{{ asset('storage/blog/'.$article->image) }}" alt="image_article">
                                    @else
                                        <img class="card-img-top image_blog_category"
                                             src="{{ asset('public/images/service_no.png') }}"
                                             alt="image_article">
                                    @endif
                                    <div class="box">
                                        <p class="title is-3">{{$article->name}}</p>
                                        <p class="subtitle is-6">{{mb_strimwidth($article->description, 0, 200,"...")}}</p>
                                        <hr/>
                                        <div class="columns">
                                            <div class="column is-8">
                                                <small class="text-muted">{{$article->created_at}}</small>
                                            </div>
                                            <div class="column is-4">
                                                <a href="{{route('blog_article', $article->id)}}"
                                                   class="button">
                                                    <span class="mdi mdi-arrow-right mdi-36px"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$articles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.executor.reviews')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="hero-body">
                        <div class="row box_account">
                            <div class="col-md-12">
                                <ul class="list-unstyled">
                                    @foreach($reviews as $review)
                                        <div class="box">
                                            <li class="media">
                                                @if($review->customer->image ?? [])
                                                    <img id="blah" class="mr-3 img-thumbnail logo_user_review"
                                                         src="{{ asset('storage/avatar/'. $review->customer->image) }}" alt="logo">
                                                @else
                                                    <img id="blah" class="mr-3 img-thumbnail logo_user_review"
                                                         src="{{ asset('public/images/user_no.png') }}" alt="logo">
                                                @endif
                                                <div class="media-body">
                                                    <b>{{$review->customer->name.' '.$review->customer->surname}}</b>
                                                    <p>{{$review->description}}</p>
                                                    <br>
                                                    <b-rate v-model="{{$review->rate}}" :disabled="true"></b-rate>
                                                </div>
                                                <div class="media-footer">
                                                    <small>{{$review->created_at}}</small>
                                                </div>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                                {{$reviews->links()}}

                                @if(count($reviews) <= 0)
                                    @lang('info.no_data')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

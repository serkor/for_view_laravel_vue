@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('page.public_profile_executor.title')
                </p>
            </div>
        </div>
    </section>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="hero">
                    <div class="hero-body">
                        <div class="row">
                            @if($executor->show_profile)
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    @if($executor->verified())
                                                        <div class="verified_user">
                                                            <b-icon
                                                                pack="mdi"
                                                                icon="account-check"
                                                                size="is-large"
                                                                type="is-success">
                                                            </b-icon>
                                                        </div>
                                                    @endif
                                                    @if($executor->image ?? [])
                                                        <img class="avatar_executor"
                                                             src="{{ asset('storage/avatar/'.$executor->image) }}"
                                                             alt="avatar">
                                                    @else
                                                        <img class="avatar_executor"
                                                             src="{{ asset('public/images/user_no.png') }}"
                                                             alt="avatar">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="box">
                                                <div class="hero-body">
                                                    <div class="columns">
                                                        <div class="column is-8">
                                                            <h1 class="title">{{$executor->name.' '.$executor->surname}}</h1>
                                                        </div>
                                                        <div class="column is-4 mt-3">
                                                            @if(Auth::user()->isCustomer())
                                                                <executor-favorite-profile
                                                                    :lang="{{$lang}}"
                                                                    :executor="{{$executor}}"
                                                                    :favorites="{{$favorites}}">
                                                                </executor-favorite-profile>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <b-rate
                                                                v-model="{{$executor->rate}}"
                                                                :disabled="true"
                                                                :show-score="true">
                                                            </b-rate>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @if(Auth::user()->isCustomer())
                                                                <executor-review
                                                                    :lang="{{$lang}}"
                                                                    :executor="{{$executor}}"
                                                                    :can="{{check_can_review($executor->id)}}">
                                                                </executor-review>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row box">
                                        <div class="col-md-12 table__wrapper">
                                            <template>
                                                <b-tabs type="is-toggle" expanded>
                                                    <b-tab-item label="@lang('page.public_profile_executor.data')"
                                                                icon="mdi mdi-information-variant">
                                                        <div class="content">
                                                            <table>
                                                                <tbody>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.phone')</td>
                                                                    <td><a>{{$executor->phone}}</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.email')</td>
                                                                    <td><a>{{$executor->email}}</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.city')</td>
                                                                    <td>{{$executor->city->name}}
                                                                        ({{$executor->city->parent->name}})
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.address')</td>
                                                                    <td>{{$executor->address}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.work_hours')</td>
                                                                    <td>
                                                                        @if(json_decode($executor->work_hours)->weekdays ?? '' )
                                                                            @lang('page.public_profile_executor.weekdays'):
                                                                            {{ json_decode($executor->work_hours)->weekdays ?? '' }};
                                                                        @endif
                                                                        @if(json_decode($executor->work_hours)->saturday ?? '' )
                                                                            @lang('page.public_profile_executor.saturday'):
                                                                            {{ json_decode($executor->work_hours)->saturday ?? '' }};
                                                                        @endif

                                                                        @if(json_decode($executor->work_hours)->sunday ?? '' )
                                                                            @lang('page.public_profile_executor.sunday'):
                                                                            {{ json_decode($executor->work_hours)->sunday ?? '' }};
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.year_experience')</td>
                                                                    <td>{{$executor->year_experience}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.category')</td>
                                                                    <td>
                                                                        <section>
                                                                            <b-field>
                                                                                @foreach($executor->categories as $category)
                                                                                    <b-tag
                                                                                        class="m-1">{{$category->name}}</b-tag>
                                                                                @endforeach
                                                                            </b-field>
                                                                        </section>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.type_pay')</td>
                                                                    <td>
                                                                        <section>
                                                                            <b-field>
                                                                                @foreach($executor->payment_types as $payment_type)
                                                                                    <b-tag
                                                                                        class="m-1">{{$payment_type->name}}</b-tag>
                                                                                @endforeach
                                                                            </b-field>
                                                                        </section>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.dop')</td>
                                                                    <td>
                                                                        <section>
                                                                            <b-field>
                                                                                @foreach($executor->additional_services as $additional_service)
                                                                                    <b-tag
                                                                                        class="m-1">{{$additional_service->name}}</b-tag>
                                                                                @endforeach
                                                                            </b-field>
                                                                        </section>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.company_contact')</td>
                                                                    <td>{{$executor->company_contact}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('page.public_profile_executor.date_created')</td>
                                                                    <td>{{$executor->created_at}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="content box">
                                                            <b>@lang('page.public_profile_executor.description')</b>
                                                            <p>{!! $executor->description !!}</p>
                                                        </div>
                                                        @if($executor->show_map)
                                                            <div class="box">
                                                                <b>@lang('page.public_profile_executor.map')</b>
                                                                <div class="mt-5" style="width: 100%">
                                                                    <iframe
                                                                        width="100%"
                                                                        height="250"
                                                                        style="border:0"
                                                                        loading="lazy"
                                                                        allowfullscreen
                                                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyALrCtQBOrZDrwfmb0fgGtp6n77tIk3444&q={{$executor->address}}">
                                                                    </iframe>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </b-tab-item>
                                                    <b-tab-item>
                                                        <template #header>
                                                            <b-icon icon="mdi mdi-comment-multiple-outline"></b-icon>
                                                            <span
                                                                class="mr-3">@lang('page.public_profile_executor.reviews')</span>
                                                            <b-tag rounded>
                                                                <executor-count-review-profile
                                                                    :executor="{{$executor}}">
                                                                </executor-count-review-profile>
                                                            </b-tag>
                                                        </template>
                                                        <executor-list-review-profile
                                                            :lang="{{$lang}}"
                                                            :executor="{{$executor}}">
                                                        </executor-list-review-profile>
                                                    </b-tab-item>
                                                </b-tabs>
                                            </template>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <section class="hero">
                                        <div class="hero-body">
                                            <p class="title">
                                                @lang('page.public_profile_executor.close_profile')
                                            </p>
                                            <p class="subtitle">
                                                @lang('page.public_profile_executor.close_profile_text')
                                            </p>
                                        </div>
                                    </section>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

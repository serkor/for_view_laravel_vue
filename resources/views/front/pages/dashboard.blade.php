@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('dashboard.title')</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <a href="/admin/search-admin-executors?filter%5Bname%5D=&filter%5Bphone%5D=&filter%5Bemail%5D=&filter%5Bverified%5D=0" type="button" class="btn btn-danger">
                                    @lang('executor.expects') <span class="badge badge-light">{{count($expects)}}</span>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{route('appeals.index')}}" type="button" class="btn btn-primary">
                                    @lang('appeal.title') <span class="badge badge-light">{{count($appeals)}}</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('customer_users')}}" type="button" class="btn btn-primary">
                                    @lang('customer.title') <span class="badge badge-light">{{count($customers)}}</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('executor_users')}}" type="button" class="btn btn-primary">
                                    @lang('executor.title') <span class="badge badge-light">{{count($executors)}}</span>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{route('admin_reviews')}}" type="button" class="btn btn-primary">
                                    @lang('review.title') <span class="badge badge-light">{{count($reviews)}}</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('admin_payments')}}" type="button" class="btn btn-primary">
                                    @lang('payment.title') <span class="badge badge-light">{{count($payments)}}</span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{route('bids.index')}}" type="button" class="btn btn-primary">
                                    @lang('bid.title') <span class="badge badge-light">{{count($bids)}}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

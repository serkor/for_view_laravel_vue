@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('review.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <hr>
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('review.executor_id')</th>
                                                    <th>@lang('review.customer_id')</th>
                                                    <th>@lang('review.public')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($reviews as $review)
                                                    <tr>
                                                        <td>{{$review->id}}</td>
                                                        <td>{{$review->executor->name.' '.$review->executor->name}}</td>
                                                        <td>{{$review->customer->name.' '.$review->customer->name}}</td>
                                                        <td>{{$review->public}}</td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                               href="{{route('edit_admin_review',$review->id)}}">
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

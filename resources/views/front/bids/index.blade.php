@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('bid.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                @include('front.bids.filter')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('bid.status')</th>
                                                    <th>@lang('bid.customer_id')</th>
                                                    <th>@lang('bid.executor_id')</th>
                                                    <th>@lang('form.created_at')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bids as $bid)
                                                    <tr>
                                                        <td>{{$bid->id}}</td>
                                                        <td>{{$bid->status->name}}</td>
                                                        <td>{{$bid->customer_id}}</td>
                                                        <td>{{$bid->executor_id}}</td>
                                                        <td>{{$bid->created_at}}</td>
                                                        <td>
                                                            <a class="btn btn-secondary"
                                                               href="{{route('bids.show',$bid->id)}}">
                                                                @lang('form.show')</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{$bids->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('payment.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                @include('front.payments.filter')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('payment.executor_id')</th>
                                                    <th>@lang('payment.payment_id')</th>
                                                    <th>@lang('payment.order_id')</th>
                                                    <th>@lang('payment.order_status')</th>
                                                    <th>@lang('payment.type')</th>
                                                    <th>@lang('payment.sum')</th>
                                                    <th>@lang('payment.start')</th>
                                                    <th>@lang('payment.finish')</th>
                                                    <th>@lang('payment.created_at')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($payments as $payment)
                                                    <tr>
                                                        <td>{{$payment->executor_id}}</td>
                                                        <td>{{$payment->payment_id}}</td>
                                                        <td>{{$payment->order_id}}</td>
                                                        <td>{{$payment->order_status}}</td>
                                                        <td>{{$payment->type}}</td>
                                                        <td>{{$payment->amount}}</td>
                                                        <td>{{$payment->start}}</td>
                                                        <td>{{$payment->finish}}</td>
                                                        <td>{{$payment->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{$payments->links()}}
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

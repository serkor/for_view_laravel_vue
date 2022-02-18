@extends('layouts.site.app')

@section('content')
    <section class="hero is-warning mb-5">
        <div class="hero-body">
            <div class="container">
                <p class="title">
                    @lang('payment.title')
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="hero-body">
                        <div class="notification is-info is-light">
                            @if(check_premium($executor->id))
                                @if($pro_payment)
                                    @lang('payment.is_time_package') {{$pro_payment->finish}}
                                @else
                                    @lang('payment.dont_have_payment_time_package')
                                @endif
                            @else
                                @lang('payment.not_time_package')
                            @endif
                        </div>
                        <div class="table__wrapper">
                            <table class="table is-striped">
                                <thead>
                                <tr>
                                    <th>@lang('payment.id')</th>
                                    <th>@lang('payment.type')</th>
                                    <th>@lang('payment.payment_id')</th>
                                    <th>@lang('payment.sum')</th>
                                    <th>@lang('payment.start')</th>
                                    <th>@lang('payment.finish')</th>
                                    <th>@lang('payment.order_status')</th>
                                    <th>@lang('payment.created_at')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->id}}</td>
                                        <td>{{$payment->type}}</td>
                                        <td>{{$payment->payment_id}}</td>
                                        <td>{{$payment->amount}}</td>
                                        <td>{{$payment->start}}</td>
                                        <td>{{$payment->finish}}</td>
                                        <td>{{$payment->order_status}}</td>
                                        <td>{{$payment->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$payments->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

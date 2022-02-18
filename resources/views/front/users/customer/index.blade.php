@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('customer.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                @include('front.users.customer.filter')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <hr>
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('customer.name')</th>
                                                    <th>@lang('customer.surname')</th>
                                                    <th>@lang('customer.email')</th>
                                                    <th>@lang('customer.phone')</th>
                                                    <th>@lang('customer.role')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($customers as $customer)
                                                    <tr>
                                                        <td>{{$customer->id}}</td>
                                                        <td>{{$customer->name}}</td>
                                                        <td>{{$customer->surname}}</td>
                                                        <td>{{$customer->email}}</td>
                                                        <td>{{$customer->phone}}</td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                               href="{{route('edit_customer_user', $customer->id)}}">
                                                                @lang('form.edit')</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{$customers->links()}}
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

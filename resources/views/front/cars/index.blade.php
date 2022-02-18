@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('car.title')</div>
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
                                                    <th>@lang('car.vin')</th>
                                                    <th>@lang('car.mark')</th>
                                                    <th>@lang('car.mark_model')</th>
                                                    <th>@lang('car.transmission')</th>
                                                    <th>@lang('car.year')</th>
                                                    <th>User ID</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cars as $car)
                                                    <tr>
                                                        <td>{{$car->id}}</td>
                                                        <td>{{$car->vin}}</td>
                                                        <td>{{$car->mark->name}}</td>
                                                        <td>{{$car->mark_model->name}}</td>
                                                        <td>{{$car->transmission->name}}</td>
                                                        <td>{{$car->year->name}}</td>
                                                        <td>{{$car->customer_id}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{$cars->links()}}
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

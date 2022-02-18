@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('package.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('package.name')</th>
                                                    <th>@lang('package.price')</th>
                                                    <th>@lang('package.days')</th>
                                                    <th>@lang('package.limit')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($packages as $package)
                                                    <tr>
                                                        <td>{{$package->id}}</td>
                                                        <td>{{$package->name}}</td>
                                                        <td>{{$package->price}}</td>
                                                        <td>{{$package->days}}</td>
                                                        <td>{{$package->limit_offers}}</td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                               href="{{route('admin_package_edit', $package->id)}}">
                                                                @lang('form.edit')
                                                            </a>
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

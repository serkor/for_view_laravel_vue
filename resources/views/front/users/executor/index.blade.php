@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('executor.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                @include('front.users.executor.filter')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <hr>
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('executor.name')</th>
                                                    <th>@lang('executor.email')</th>
                                                    <th>@lang('executor.phone')</th>
                                                    <th>@lang('executor.package_id')</th>
                                                    <th>@lang('executor.verified')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($executors as $executor)
                                                    <tr>
                                                        <td>{{$executor->id}}</td>
                                                        <td>{{$executor->name}}</td>
                                                        <td>{{$executor->email}}</td>
                                                        <td>{{$executor->phone}}</td>
                                                        <td>{{$executor->package_id}}</td>
                                                        <td>{{$executor->verified}}</td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                               href="{{route('edit_executor_user', $executor->id)}}">
                                                                @lang('form.edit')</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{$executors->links()}}
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

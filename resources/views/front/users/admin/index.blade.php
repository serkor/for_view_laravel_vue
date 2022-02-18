@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('user.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{route('create_admin_user')}}"
                                           class="btn btn-secondary">@lang('form.create')</a>
                                        <div class="table-responsive">
                                            <hr>
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('user.name')</th>
                                                    <th>@lang('user.surname')</th>
                                                    <th>@lang('user.email')</th>
                                                    <th>@lang('user.role')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{$user->id}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->surname}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>
                                                            @foreach($user->roles as $role)
                                                                <p>{{$role->name}}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                               href="{{route('edit_admin_user', $user->id)}}">
                                                                @lang('form.edit')</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{$users->links()}}
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

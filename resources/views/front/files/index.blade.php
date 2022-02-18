@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                <h1>@lang('file.title')</h1>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <hr>
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('file.user')</th>
                                                    <th>@lang('file.name')</th>
                                                    <th>@lang('file.created_at')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($files as $file)
                                                    <tr>
                                                        <td>{{$file->user_id}}</td>
                                                        <td>
                                                            <a target="_blank" href="{{ asset('/storage/files/'.$file->url) }}">
                                                                {{$file->name}}</a>
                                                        </td>
                                                        <td>{{$file->created_at}}</td>
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

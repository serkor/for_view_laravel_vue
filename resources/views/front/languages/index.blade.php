@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('language.title')</div>
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
                                                    <th>@lang('language.code')</th>
                                                    <th>@lang('language.name')</th>
                                                    <th>@lang('language.script')</th>
                                                    <th>@lang('language.native')</th>
                                                    <th>@lang('language.regional')</th>
                                                    <th>@lang('language.default')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($languages as $language)
                                                    <tr>
                                                        <td>{{$language->id}}</td>
                                                        <td>{{$language->locate_code}}</td>
                                                        <td>{{$language->name}}</td>
                                                        <td>{{$language->script}}</td>
                                                        <td>{{$language->native}}</td>
                                                        <td>{{$language->regional}}</td>
                                                        <td>{{$language->default}}</td>
                                                        <td><p><a class="btn btn-warning"
                                                                  href="{{route('languages.edit', $language->id)}}">@lang('form.edit')</a>
                                                            </p></td>
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

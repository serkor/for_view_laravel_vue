@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('auto.model.title')</div>
                    <div class="card-body">
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                @include('front.mark_models.filter')
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{route('mark-models.create')}}"
                                           class="btn btn-secondary">@lang('form.create')</a>
                                        <div class="table-responsive">
                                            <hr>
                                            <table class="table table-striped table-hover table-bordered datatable">
                                                <thead>
                                                <tr>
                                                    <th>@lang('form.id')</th>
                                                    <th>@lang('auto.model.name')</th>
                                                    <th>@lang('auto.model.mark_id')</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($mark_models as $model)
                                                    <tr>
                                                        <td>{{$model->id}}</td>
                                                        <td>{{$model->name}}</td>
                                                        <td>{{$model->mark->name}}</td>
                                                        <td>
                                                            <a class="btn btn-warning"
                                                               href="{{route('mark-models.edit', $model->id)}}">
                                                                @lang('form.edit')</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{$mark_models->links()}}
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

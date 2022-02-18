@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('offer_template.title_admin')</div>
                    <div class="card-body">
                        @include('front.offer_templates.filter')
                        <a href="{{route('offer-templates.create')}}"
                           class="btn btn-secondary">@lang('form.create')</a>
                        <div class="templatemo-content-wrapper">
                            <div class="templatemo-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered datatable">
                                        <thead>
                                        <tr>
                                            <th>@lang('form.id')</th>
                                            <th>@lang('offer_template.name')</th>
                                            <th>@lang('offer_template.executor_id')</th>
                                            <th>@lang('offer_template.sum_repair')</th>
                                            <th>@lang('offer_template.sum_part')</th>
                                            <th>@lang('offer_template.number_hours')</th>
                                            <th>@lang('offer_template.description')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($offer_templates as $template)
                                            <tr>
                                                <td>{{$template->id}}</td>
                                                <td>{{$template->name}}</td>
                                                <td>{{get_name_user($template->executor_id)}}</td>
                                                <td>{{$template->sum_repair}}</td>
                                                <td>{{$template->sum_part}}</td>
                                                <td>{{$template->number_hours}}</td>
                                                <td>{{$template->description}}</td>
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
@endsection

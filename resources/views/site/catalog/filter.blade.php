<h2>@lang('filter.title')</h2>
<hr>
{!! Form::open(['method' => 'get','route' => ['catalog']])!!}
<div class="form-row">
    <div class="col">
        <h6>@lang('filter.name')</h6>
        {!! Form::text('filter[name]', old('name') ,array_merge(['class' => 'form-control']))!!}
    </div>
</div>
<hr>

{{--<h6>@lang('filter.price')</h6>--}}
{{--<div class="form-row">--}}
{{--    <div class="col">--}}
{{--        {!! Form::text('filter[price][ot]', ceil($services->min('price')), array_merge(['class' => 'form-control']))!!}--}}
{{--    </div>--}}
{{--    ---}}
{{--    <div class="col">--}}
{{--        {!! Form::text('filter[price][do]', ceil($services->max('price')), array_merge(['class' => 'form-control']))!!}--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-row">
    <div class="col">
        {!! Form::submit(trans('filter.go'), array_merge(['class' => 'btn btn-secondary stretched-link'] )) !!}
    </div>
    <div class="col">
        <a type="button" href="{!! route('catalog') !!}" class="btn btn-secondary">
            <span class="mdi mdi-window-close"></span></a>
    </div>
</div>
{!! Form::close() !!}


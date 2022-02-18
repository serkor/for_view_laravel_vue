{!! Form::open(['method' => 'get', 'route' => ['search_admin_mark_models']])!!}
<div class="columns mb-5">
    <div class="column">
        {!! Form::text('filter[name]', old('filter[name]'), array_merge(['class' => 'form-control', 'placeholder' => 'Наименование']))!!}
    </div>
    <div class="column">
        {!! Form::submit('Найти', array_merge(['class' => 'button'] )) !!}
        <a type="button" href="{!! route('search_admin_mark_models') !!}" class="btn btn-default">Сброс</a>
    </div>
</div>
{!! Form::close() !!}

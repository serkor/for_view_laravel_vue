{!! Form::open(['method' => 'get', 'route' => ['search_admin_bids']])!!}
<div class="columns mb-5">
    <div class="column">
        {!! Form::text('filter[id]', old('filter[id]'), array_merge(['class' => 'form-control', 'placeholder' => 'ID']))!!}
    </div>
    <div class="column">
        {!! Form::submit('Найти', array_merge(['class' => 'button'] )) !!}
        <a type="button" href="{!! route('search_admin_bids') !!}" class="btn btn-default">Сброс</a>
    </div>
</div>
{!! Form::close() !!}

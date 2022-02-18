{!! Form::open(['method' => 'get', 'route' => ['search_admin_customers']])!!}
<div class="columns mb-5">
    <div class="column">
        {!! Form::text('filter[name]', old('filter[name]'), array_merge(['class' => 'form-control', 'placeholder' => 'Имя']))!!}
    </div>
    <div class="column">
        {!! Form::text('filter[surname]', old('filter[surname]'), array_merge(['class' => 'form-control', 'placeholder' => 'Фамилия']))!!}
    </div>
    <div class="column">
        {!! Form::text('filter[phone]', old('filter[phone]'), array_merge(['class' => 'form-control', 'placeholder' => 'Телефон']))!!}
    </div>
    <div class="column">
        {!! Form::text('filter[email]', old('filter[email]'), array_merge(['class' => 'form-control', 'placeholder' => 'Email']))!!}
    </div>
    <div class="column">
        {!! Form::submit('Найти', array_merge(['class' => 'button'] )) !!}
        <a type="button" href="{!! route('search_admin_customers') !!}" class="btn btn-default">Сброс</a>
    </div>
</div>
{!! Form::close() !!}

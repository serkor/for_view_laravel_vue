{!! Form::open(['method' => 'get', 'route' => ['search_admin_payments']])!!}
<div class="columns mb-5">
    <div class="column">
        {!! Form::text('filter[executor_id]', old('filter[executor_id]'), array_merge(['class' => 'form-control', 'placeholder' => 'User ID']))!!}
    </div>
    <div class="column">
        {!! Form::text('filter[payment_id]', old('filter[payment_id]'), array_merge(['class' => 'form-control', 'placeholder' => 'Платеж ID']))!!}
    </div>
    <div class="column">
        {!! Form::submit('Найти', array_merge(['class' => 'button'] )) !!}
        <a type="button" href="{!! route('search_admin_payments') !!}" class="btn btn-default">Сброс</a>
    </div>
</div>
{!! Form::close() !!}

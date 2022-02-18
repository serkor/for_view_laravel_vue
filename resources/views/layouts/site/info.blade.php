@if (session('status'))
    <template>
        <section class="info-message-event">
            <b-message title="Успешно!" type="is-success" aria-close-label="X">
                {{ session('status') }}
            </b-message>
        </section>
    </template>
@endif
@if ($errors->count() > 0)
    <template>
        <section class="info-message-event">
            <b-message title="Ошибка!" type="is-danger" aria-close-label="X">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </b-message>
        </section>
    </template>
@endif


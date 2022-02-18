@extends('layouts.front.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bs-example">
                            <table class="table is-fullwidth">
                                <thead>
                                <tr>
                                    <th>Заголовок</th>
                                    <th>Данные</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>@lang('form.id')</td>
                                    <td>{{$bid->id}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.status')</td>
                                    <td>
                                        {!! Form::model($bid,['method' => 'PUT', 'route' => ['update_admin_bid_status', $bid->id]]) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::select('status_id', [1 => 'Новый', 2 => 'В работе', 3 => 'Выполнен', 4 => 'Отменен', 5 => 'Закрыт', 6 => 'Спор'], $bid->status_id, array_merge(['class' => 'form-control'])) !!}
                                            </div>
                                            <div class="col-md-6">
                                                {!! Form::submit(trans('form.update'),array_merge(['class' => 'btn btn-primary'] )) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.customer')</td>
                                    <td>{{$bid->customer->name}} {{$bid->customer->surname}}
                                        (ID {{$bid->customer_id}})
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.executor')</td>
                                    <td>{{$bid->executor->name ?? 'Не выбран'}} (ID {{$bid->executor_id ?? '?'}})</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.mark')</td>
                                    <td>{{$bid->car->mark->name}} (ID {{$bid->car_id}})</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.mark_model')</td>
                                    <td>{{$bid->car->mark_model->name}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.transmission')</td>
                                    <td>{{$bid->car->transmission->name}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.year')</td>
                                    <td>{{$bid->car->year->name}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.vin')</td>
                                    <td>{{$bid->car->vin}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.city')</td>
                                    <td>{{$bid->city->name}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.description')</td>
                                    <td>{{$bid->description}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.desired_date')</td>
                                    <td>{{$bid->desired_date}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('bid.type')</td>
                                    <td>{{$bid->type}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <template>
                            <b-tabs>
                                <b-tab-item label="Предложения">
                                    @foreach($bid->offers as $offer)
                                        <div class="box m-5">
                                            <table class="table is-bordered is-fullwidth">
                                                <tbody>
                                                <tr>
                                                    <td>Исполнитель:</td>
                                                    <td>{{$offer->executor->name}} ({{$offer->executor_id}})</td>
                                                </tr>
                                                <tr>
                                                    <td>Выбран:</td>
                                                    <td>{{$offer->select}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Сумма ремонта:</td>
                                                    <td>{{$offer->sum_repair}} грн.</td>
                                                </tr>
                                                <tr>
                                                    <td>Сумма запчастей:</td>
                                                    <td>{{$offer->sum_part}} грн.</td>
                                                </tr>
                                                <tr>
                                                    <td>Сроки выполенения:</td>
                                                    <td>{{$offer->number_hours}} час.</td>
                                                </tr>
                                                <tr>
                                                    <td>Готовы выполнить:</td>
                                                    <td>{{$offer->renovation_date}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Описание:</td>
                                                    <td>{{$offer->description}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Дата создания:</td>
                                                    <td>{{$offer->created_at}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </b-tab-item>

                                <b-tab-item label="Вопросы и Ответы">
                                    @foreach($bid->questions as $question)
                                        <div class="box m-5">
                                            <table class="table is-bordered is-fullwidth">
                                                <tbody>
                                                <tr>
                                                    <td>ID:</td>
                                                    <td>{{$question->id}}</td>
                                                </tr>
                                                @if(!empty($question->executor_id))
                                                    <tr>
                                                        <td>Исполнитель:</td>
                                                        <td>{{$question->executor->name}}
                                                            (ID {{$question->executor_id}})
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if(!empty($question->customer_id))
                                                    <tr>
                                                        <td>Заказчик ID:</td>
                                                        <td>{{$bid->customer->name}} {{$bid->customer->surname}}
                                                            (ID {{$bid->customer_id}})
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>Сообщение:</td>
                                                    <td>{{$question->text}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Дата создания:</td>
                                                    <td>{{$question->created_at}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </b-tab-item>

                                <b-tab-item label="Комментарии">
                                    @foreach($bid->comments as $comment)
                                        <div class="box m-5">
                                            <table class="table is-bordered is-fullwidth">
                                                <tbody>
                                                <tr>
                                                    <td>ID:</td>
                                                    <td>{{$comment->id}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Пользователь:</td>
                                                    <td>{{get_name_user($comment->user_id)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Сообщение:</td>
                                                    <td>{{$comment->text}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Статус:</td>
                                                    <td>{{$comment->status->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Тип:</td>
                                                    <td>{{$comment->type}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Дата создания:</td>
                                                    <td>{{$comment->created_at}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </b-tab-item>

                            </b-tabs>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.shop.index')

@section('content')

    <div class="content">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#balance">Баланс</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#history">История</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active p-3" id="balance">
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 pl-md-3 user-settings-groups">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Тариф</span>
                            </div>
                            <input type="text" class="form-control text-center" value="{{ $current_tariff->title }}" readonly>
                        </div>

{{--                        <div class="input-group mb-3">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text">Баланс</span>--}}
{{--                            </div>--}}
{{--                            <input type="text" class="form-control text-center" value="0 р." readonly>--}}
{{--                        </div>--}}

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Осталось</span>
                            </div>
                            <input type="text" class="form-control text-center" value="{{ $left }}" readonly>
                        </div>

                    </div>
                </div>

                <div class="row p-md-3">
                    <div class="col-md-10 rounded buy-tarif pr-md-3 pl-md-3">
                        <div class="header text-center">
                            <span>Выберите тарифный план</span>
                        </div>

                        <div class="row rounded bg-light text-center pt-2 pb-2 mt-3">
                            <div class="col" style="max-width: 5%;"></div>
                            <div class="col"></div>
                            <div class="col">7 дней</div>
                            <div class="col">30 дней</div>
                            <div class="col">180 дней</div>
                            <div class="col">365 дней</div>
                        </div>

                        @foreach($tariffs as $tariff)
                        <div class="row tariff">
                            <div class="col pt-2" style="max-width: 5%;">
                                <div class="arrow-up"><i class="fas fa-chevron-up"></i></div>
                            </div>
                            <div class="col title pt-2" style="max-width: 20%;">
                                <strong>"{{ $tariff->title }}"</strong><br>
                                до {{ $tariff->limit_mark }} марок автомобилей
                                <div class="example">(например: Toyota, Lexus, BMW)<br>Количество моделей не ограничено</div>
                            </div>
                            <div class="col" style="max-width: 75%;">
                                <div class="row text-center">
                                    <div class="col-12 condition text-left">{{ $tariff->description }}</div>

                                    @foreach(json_decode($tariff->prices, true) as $key=>$price)
                                        <div class="col price">

                                            @if($key < 2)
                                                <div style="color:#696969; text-decoration: line-through;font-size: 20px;text-align: center;margin-top: 20px;">{{ $price['price']+1000 }} р </div>
                                                <div class="amount mt-0">{{ $price['price'] }} р&nbsp;<span title="Информация" data-toggle="popover" data-trigger="hover" data-content="Вам предоставляется скидка 1000 руб. за регистрацию в день приглашения. *акция действует до 16 августа"><i class="fas fa-question-circle" style="color: #f6bf00;font-size:18px;cursor: pointer;"></i></span> </div>
                                            @else

                                                @if(isset($price['discount']))
                                                    <div class="without-sale">
                                                        без скидки<br>
                                                        <span>{{ $price['price'] }} р</span>
                                                    </div>
                                                    <div class="sale">
                                                        скидка {{ number_format((($price['price']-$price['discount'])/$price['price'])*100, 0) }}%<br>
                                                        <span>{{ $price['discount'] }} р</span>
                                                    </div>
                                                    <span class="before">до 1 сентября 2019г.</span>
                                                    @if(isset($price['recommend'])) <img src="{{ asset('images/recomend.png') }}" alt="рекомендуем"> @endif
                                                @else
                                                    <div class="amount">{{ $price['price'] }} р</div>
                                                @endif

                                            @endif

                                            <a href="javascript:;" class="btn btn-primary choose-method-payment" onclick="openModalPayment('{{$tariff->title}}', '{{ $price['discount'] ?? $price['price'] }}', '{{ $key }}', '{{ $tariff->id }}')">Выбрать способ оплаты</a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="tab-pane p-3" id="history">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Дата</th>
                                    <th>Тип оплаты</th>
                                    <th>Тариф</th>
                                    <th>Срок</th>
                                    <th>Сумма</th>
                                    <th>Обновление статуса</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $his)
                                    <tr>
                                        <td>{{ $his->method==='invoice' ? 'АР-' : '' }}{{ $his->id }}</td>
                                        <td>{{ date('d.m.Y', strtotime($his->created_at)) }}</td>
                                        <td>
                                            @switch($his->method)
                                                @case('card')
                                                Карта
                                                @break

                                                @case('invoice')
                                                по реквизитам
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ $his->tariff->title }}</td>
                                        <td>
                                            <?php
                                                $times = ['7 дней', '30 дней', '180 дней', '365 дней'];
                                            ?>
                                            {{  $times[$his->tariff_period] }}
                                        </td>
                                        <td>{{ $his->amount }} р.</td>

                                        <td>
                                            @if($his->status!='wait_payment')
                                                {{ $his->updated_at }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($his->status=='wait_payment')
                                                <i class="far fa-clock" title="Ожидание оплаты"></i>
                                            @elseif($his->status=='success')
                                                <i class="far fa-check-circle text-success" title="Успешно проведена"></i>
                                            @elseif($his->status=='error')
                                                <i class="far  fa-exclamation-triangle" title="Ошибка"></i>
                                            @endif
                                        </td>
                                        <td style="font-size: 18px;">
                                            @if($his->method==='invoice')
                                                <a href="{{ storage_path('app/files/pdf/payment/'.auth()->id().'/invoice_'.$his->id.'.pdf') }}" target="_blank"><i class="far fa-file-pdf"></i></a>
                                            @endif

                                            @if($his->status==='wait_payment')
                                                <a href="javascript:;" title="Удалить" class="text-danger delete-schet"
                                                    onclick="if(confirm('Вы действительно хотите удалить счет №{{ $his->id }}?')) $(this).next().submit(); else return false;"
                                                ><i class="far fa-trash-alt"></i></a>
                                                    <form action="{{ route('shop.balance.invoice.delete', ['id' => $his->id]) }}" method="post" class="d-none">
                                                        @csrf
                                                    </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

            </div>
        </div>

    </div>

    <!-- The Modal -->
    <div class="modal" id="modalPayment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Авторазоборов</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <strong>Вы выбрали:</strong><br>
                    - тариф <span id="tariff"></span> на <span id="time"></span><br>
                    - сумма оплаты <span id="amount"></span> руб.

                    <br><br>
                    Выберите удобный способ оплаты
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <form action="{{route('shop.balance.payment-cart')}}" method="post">
                                @csrf
                                <input type="hidden" name="tariff_id">
                                <input type="hidden" name="time_id">
                                <button class="btn btn-primary" type="submit">Банковской картой</button>
                            </form>

                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('shop.balance.invoice.index') }}" method="get">
                                <input type="hidden" name="tariff_id">
                                <input type="hidden" name="time_id">
                                <button type="submit" class="btn btn-light rounded-pill">Выставить счет для оплаты</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('main_script')

    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });

        $('.tariff:first').addClass('active');
        $('.arrow-up').on('click', function () {
            $(this).parent().parent().toggleClass('active', 200);
        });

        function openModalPayment(tariffTitle, tariffPrice, tariffTimeId, tariffId){
            var times = ['7 дней', '30 дней', '180 дней', '365 дней'];

            $('#modalPayment .modal-body #tariff').text(tariffTitle);
            $('#modalPayment .modal-body #amount').text(tariffPrice);
            $('#modalPayment .modal-body #time').text(times[tariffTimeId]);
            $('#modalPayment .modal-body input[name=tariff_id]').val(tariffId);
            $('#modalPayment .modal-body input[name=time_id]').val(tariffTimeId);

            $('#modalPayment').modal('show');
        }

    </script>
@endsection
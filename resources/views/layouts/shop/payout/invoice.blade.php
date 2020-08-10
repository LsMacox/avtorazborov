@extends('layouts.shop.index')

@section('content')

    <div class="content">
        <h2 class="text-center">Заполните для получения счета на электронную почту</h2>

        <div class="row mt-5">
            <div class="col-md-6">


                <form action="{{ route('shop.balance.invoice.generate-pdf') }}" method="post" class="user-settings-groups">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Название</span>

                            <select name="organization" class="custom-select rounded-0 bg-light h-100">
                                <option value="Общество с ограниченной ответственностью" selected>ООО</option>
                                <option value="Индивидуальный предприниматель">ИП</option>
                                <option value="Открытое акционерное общество">ОАО</option>
                                <option value="Закрытое акционерное общество">ЗАО</option>
                            </select>
                        </div>

                        <input type="text" class="form-control text-center" value="{{ old('name') ?? $user->name }}" name="name">

                        @error('name')
                            <span class="invalid-feedback d-block text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

{{--                    <div class="input-group mb-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text">Город</span>--}}
{{--                        </div>--}}
{{--                        <input type="text" class="form-control text-center" value="{{ old('city') }}" name="city">--}}
{{--                    </div>--}}

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Адрес</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ old('address') ?? $user->address }}"
                               name="address" placeholder="Индекс, город, улица, дом"
                               onfocus="this.placeholder = ''" onblur="this.placeholder = 'Индекс, город, улица, дом'">

                        @error('address')
                        <span class="invalid-feedback d-block text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ old('email') ?? $user->email }}" name="email">

                        @error('email')
                        <span class="invalid-feedback d-block text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Телефон</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ old('phone') ?? $user->phone }}" name="phone" placeholder="+7 (___) ___-__-__">

                        @error('phone')
                        <span class="invalid-feedback d-block text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ОГРН</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ old('ogrn') }}" name="ogrn"  onkeypress="if (event.charCode >= 48 && event.charCode <= 57) return; else event.preventDefault();">

                        @error('ogrn')
                        <span class="invalid-feedback d-block text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ИНН</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ old('inn') }}" name="inn" onkeypress="if (event.charCode >= 48 && event.charCode <= 57) return; else event.preventDefault();">

                        @error('inn')
                        <span class="invalid-feedback d-block text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">КПП</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ old('kpp') }}" name="kpp" onkeypress="if (event.charCode >= 48 && event.charCode <= 57) return; else event.preventDefault();">

                        @error('kpp')
                        <span class="invalid-feedback d-block text-right" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Тариф</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ $title }}" readonly>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Сумма</span>
                        </div>
                        <input type="text" class="form-control text-center" value="{{ $amount }} р." readonly>
                    </div>

                    <input type="hidden" name="tariff_id" value="{{ $tariff_id }}">
                    <input type="hidden" name="time_id" value="{{ $time_id }}">

                    <button type="submit" class="btn btn-primary">Получить счет на почту</button>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('main_script')
    <script src="/cabinet/js/inputmask.js"></script>
    <script type="application/javascript">
        $('input[name=phone]').mask('+7 (000) 000-00-00');
    </script>
@endsection
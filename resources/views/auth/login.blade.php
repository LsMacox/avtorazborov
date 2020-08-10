@extends('auth.index')

@section('content')
  <div class="content-wrapper m-0">
    <div style="z-index: 1000" class="lg_block d-flex justify-content-center align-items-center w-100 mt-5 position-absolute">
        <div class="card text-center">
            <div class="card-header">
                <a href="/" class="close-login-from badge badge-light rounded-circle">
                    <span>×</span>
                </a>
                <p>ЛИЧНЫЙ КАБИНЕТ</p>
                <span class="lg_span_card_header_1">
                    ДЛЯ <span class="underline">ПОЛУЧЕНИЕ ОТВЕТОВ</span> ОТ АВТОРАЗБОРОК И МАГАЗИНОВ
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="phone">{{ __('Номер телефона') }}</label>

                            <input placeholder="+7 (___) ___-__-__" autocomplete="off" type="tel" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ substr(old('login'), 1, 11) }}" required autocomplete="login" autofocus>

                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Пароль') }}</label>

                            <input placeholder="______________________" autocomplete="off" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary">
                        Войти в личный кабинет
                        <i class="fas fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </form>
                <div class="footer d-flex justify-content-between">
                    <a class="reg" href="{{route('register')}}"><span class="underline">Регистрация</span></a>
                    <!--<a class="forgot_pass" href="">Забыли пароль?</a>-->
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

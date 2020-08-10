@extends('auth.index')

@section('content')
<div class="content-wrapper m-0">
    <div style="z-index: 1000" class="lg_block d-flex justify-content-center align-items-center w-100 mt-5 position-absolute">
        <div class="card text-center">
            <div class="card-header">
                <a href="/" class="close-login-from badge badge-light rounded-circle">
                    <span>×</span>
                </a>
                <p>РЕГИСТРАЦИЯ</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                                <label for="name">{{ __('Имя') }}</label>
                                    <input placeholder="Алексей" autocomplete="off" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('E-Mail') }}</label>

                                    <input placeholder="examplemail@mail.ru" autocomplete="off" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                    <label for="name">{{ __('Номер телефона') }}</label>
                                        <input placeholder="+7 (___) ___-__-__"  autocomplete="off" type="tel" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ substr(old('login'), 1, 11) }}" required autocomplete="login" autofocus>

                                        @error('login')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                        <div class="form-group d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-primary">
                               Зарегестрироваться
                               <i class="fas fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </form>
                    <div class="footer d-flex justify-content-between">
                        <a class="reg" href="{{route('login')}}"><span class="underline">Войти</span></a>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

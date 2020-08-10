@extends('layouts.user.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-4">
                    <p class="m-0 text-dark text-center proposal_p">Настройки</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <form action="{{route('user.profile.update')}}" method="post">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 pl-md-3 user-settings-groups">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Имя</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Имя" name="name" value="{{ $user->name ?? '' }}" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Телефон</span>
                        </div>
                        <input type="tel" class="form-control" placeholder="Телефон" name="phone" value="{{ phone_number(auth()->user()->login) }}" required disabled>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">E-mail</span>
                        </div>
                        <input type="email" class="form-control" placeholder="E-mail" name="email" value="{{ $user->email ?? '' }}" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Город</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Город" name="city" value="{{ $user->city ?? '' }}">
                    </div>

                    <div class="checkboxes">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="email_notify" name="email_notify" @if(isset($user->email_notify)) checked @endif >
                            <label class="custom-control-label font-weight-bold mb-3" style="font-size: 14px;" for="email_notify">Получать уведомления о новых сообщениях на почту</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input mb-3" name='policy' id="policy" required @if(\Cookie::get('policy')) checked @endif >
                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="policy">Нажимая на кнопку “Сохранить”, я соглашаюсь на обработку моих персональных данных, передачу их авторазборкам (магазинам) и ознакомлен(а) с политикой конфиденциальности</label>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul style="list-style: none" class="m-0 p-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-primary mt-3">{{ Session::get('success') }}</div>
                    @endif

                    <button class="btn btn-primary mt-3 w-100">Сохранить</button>
                </div>
            </div>
        </form>
    </div>

@endsection
@extends('layouts.admin.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p">Редактирование пользователя</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <form action="{{route('admin.shop.update', $user->user_id ?? $user->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Наименование</span>
                </div>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Адрес</span>
                </div>
                <input type="text" name="address" value="{{$user->address}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Тел. регистрации</span>
                </div>
                <input type="text" value="{{$user->login}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Тел. контактный</span>
                </div>
                <input type="text" name="phone" value="{{$user->phone}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">E-mail</span>
                </div>
                <input type="text" name="email" value="{{$user->email}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Тариф</span>
                </div>
                <input type="text" name="tariff" value="{{$user->tariff->title}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Дата регистрации</span>
                </div>
                <input type="text" name="created_at" value="{{date('d.m.Y H:i', strtotime($user->created_at))}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Окончание тарифа</span>
                </div>
                <input type="text" name="tariff_finish" value="{{date('d.m.Y H:i', strtotime($user->tariff_finish))}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <button type="submit" class="btn btn-success pull-right">Сохранить</button>
        </form>
    </div>

@endsection
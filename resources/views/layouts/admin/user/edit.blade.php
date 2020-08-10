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
        <form action="{{route('admin.user.update', $user->user_id ?? $user->id)}}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="user_id" value="{{ $user->user_id ?? $user->id }}">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Дата:</span>
                </div>
                <input type="text" name="created_at" value="{{$user->created_at}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Имя:</span>
                </div>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Email адрес:</span>
                </div>
                <input type="text" name="email" value="{{$user->email}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Получать оповещения (0 или 1):</span>
                </div>
                <input type="text" name="email_notify" value="{{$user->email_notify}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Город:</span>
                </div>
                <input type="text" name="city" value="{{$user->city}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <button type="submit" class="btn btn-success pull-right">Сохранить</button>
        </form>
    </div>

@endsection
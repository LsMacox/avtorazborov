@extends('layouts.user.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p">Редактирование заявок</p>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mt-5">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="content">
        <form action="{{route('user.proposal.update', $proposal->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Дата</span>
                </div>
                <input type="text" name="created_at" value="{{$proposal->created_at}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Марка авто</span>
                </div>
                <input type="text" name="marka" value="{{$proposal->mark}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Модель авто</span>
                </div>
                <input type="text" name="model" value="{{$proposal->model}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Год выпуска</span>
                </div>
                <input type="text" name="year_of_issue" value="{{$proposal->year_of_issue}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">VIN номер</span>
                </div>
                <input type="text" name="vin" value="{{$proposal->vin}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Номер двигателя</span>
                </div>
                <input type="text" name="engine_number" value="{{$proposal->engine_number}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Требуемые запчасти</span>
                </div>
                <input type="text" name="spares" value="{{$proposal->spares}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Телефон клиента</span>
                </div>
                <input type="text" name="phone" value="{{phone_number(auth()->user()->login)}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Город</span>
                </div>
                <input type="text" name="city" value="{{$proposal->city}}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" disabled> 
            </div>
            <button type="submit" class="btn btn-success pull-right">Сохранить</button>
        </form>
    </div>

@endsection
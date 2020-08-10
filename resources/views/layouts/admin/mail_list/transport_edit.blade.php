@extends('layouts.admin.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p">Редактирование транспорта</p>
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
        <form action="{{route('admin.mail-list.transport.update', $transport)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Дата</span>
                </div>
                <input type="text" value="{{ $transport->created_at }}" class="form-control" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Марка</span>
                </div>
                <input type="text" name="mark" value="{{ $transport->mark }}" class="form-control">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Модель</span>
                </div>
                <input type="text" name="model" value="{{ $transport->model }}" class="form-control">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Год от</span>
                </div>
                <input type="text" name="year_from" value="{{ $transport->year_from }}" class="form-control">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Год до</span>
                </div>
                <input type="text" name="year_before" value="{{ $transport->year_before }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-success pull-right">Сохранить</button>
        </form>
    </div>
@endsection
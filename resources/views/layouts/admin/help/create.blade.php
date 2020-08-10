@extends('layouts.admin.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p"> Создать подсказку </p>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-2">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="table-responsive">

                    <div class="form-group">
                        <label for="name">Роль:</label>
                            <select id="users" class="custom-select">
                            @foreach($routes as $role => $title)
                                <option value="{{ $role }}">{{$title['title']}}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach($routes as $role => $title)
                        <form action="{{ route('admin.help.store') }}" method="post" class="help-form" class="help-form" id="{{$role}}" style="display: none">
                            @csrf
                            <input type="hidden" name="role" value="{{$role}}">
                            <div class="form-group">
                                <label for="name">Страницы {{$title['title']}}:</label>
                                <select name="route" class="custom-select">
                                    @foreach($routes[$role]['routes'] as $route => $title)
                                        <option value="{{ $route }}">{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Текст:</label>
                                <input type="text" class="form-control" name="text">
                            </div>

                            <button class="btn btn-primary" type="submit" id="create">Создать</button>
                        </form>
                    @endforeach

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="list-style: none" class="m-0 p-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

@section('main_script')
    <script type="text/javascript">
        $('document').ready(function () {
            $('#users option[value="user"]').trigger('change');
        });

        $('#users').change(function () {
            $('.help-form').attr('style', 'display:none');
            $('form#' + $(this).val()).attr('style', 'display:block');
        });
    </script>
@endsection


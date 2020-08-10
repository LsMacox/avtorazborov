@extends('layouts.admin.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p"> Подсказки к страницам </p>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-primary m-2">{{ Session::get('message') }}</div>
    @endif
    <div class="content">
        <div class="table-responsive">
            <table class="table table-main table-striped table-hover table-proposal">
                <thead>
                <tr>
                    <th>Страница</th>
                    <th>Сообщение</th>
                    <th class="text-center p-1">
                        <a href="{{ route('admin.help.create') }}" class="btn btn-light" title="Создать подсказку">
                            <i class="fas fa-plus"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @foreach($helps as $help)
                        <tr>
                            <td>{{ $help->route }}</td>
                            <td>{{ $help->text }}</td>
                            <td class="text-center p-1">
                                <a href="{{route('admin.help.edit', $help->id)}}" class="text-secondary mr-1 ml-1"
                                   style="font-size: 22px;" title="Редактировать" onclick="event.stopPropagation();">
                                    <i class="fa fa-edit" style="font-weight: 400"></i>
                                </a>
                                <a href="javascript:;" class="text-secondary  mr-1 ml-1" style="font-size: 22px;"
                                   title="Удалить" onclick="event.stopPropagation(); if
                                   (confirm('Вы дейстивтельно хотите удалить  подсказку?')) { document.getElementById
                                   ('help-destroy').submit()}"
                                   title="Удалить">
                                    <i class="fas fa-trash-alt" style="font-weight: 400"></i>
                                </a>
                                <form action="{{ route('admin.help.destroy', $help->id) }}" method="post" class="d-none"
                                      id="help-destroy">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


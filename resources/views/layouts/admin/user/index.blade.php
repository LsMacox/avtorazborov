@extends('layouts.admin.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p">Пользователи</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-primary mt-3 mb-3">{{ Session::get('message') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-main table-striped table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Дата регистрации</th>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Город</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->created_at ? date('d.m.Y', strtotime($user->created_at)) : '' }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->city ?? '' }}</td>
                            <td>
                                <a href="{{route('admin.user.edit', $user->user_id ?? $user->id)}}" class="text-secondary mr-1
                                ml-1" style="font-size: 22px;" title="Редактировать">
                                    <i class="fa fa-edit" style="font-weight: 400"></i>
                                </a>
                                <a href="javascript:;" class="text-secondary mr-1 ml-1" style="font-size: 22px;"
                                   onclick="if(confirm('Вы дейстивтельно хотите удалить пользователя?')) document.getElementById('delete-user-{{ $user->user_id ?? $user->id }}').submit()" title="Удалить">
                                    <i class="fas fa-trash-alt" style="font-weight: 400"></i>
                                </a>

                                <form action="{{ route('admin.user.destroy', $user->user_id ?? $user->id) }}" method="post" class="d-none" id="delete-user-{{ $user->user_id ?? $user->id }}">
                                    @csrf
                                    @method('DELETE');
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" style="font-size: 25px" colspan="10">Пользователей не найдено</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">{{ $users->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
@extends('layouts.admin.index')

@section('main_style')
    <link rel="stylesheet" href="{{asset('css/layouts/s05_addproposal.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/nice_select.css')}}">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p">Список авторазборок</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="table-responsive">
            <table class="table table-main table-striped table-hover" style="font-size: 12px;">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Тел. регистрации</th>
                    <th scope="col">Тел. контактный</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Тариф</th>
                    <th scope="col">Дата регистрация</th>
                    <th scope="col">Окончание тарифа</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($shops as $key => $shop)
                    <tr>
                        <td>{{ app('request')->input('page')>1 ? ((app('request')->input('page')-1)*10)+($key+1) : $key+1 }}</td>
                        <td>{{ $shop->name }}</td>
                        <td>{{ $shop->city ?? '' }} {{ $shop->address ?? '' }}</td>
                        <td>{{ $shop->login ?? '' }}</td>
                        <td>{{ $shop->phone ?? '' }}</td>
                        <td>{{ $shop->email ?? '' }}</td>
                        <td>{{ $shop->tariff->title ?? '' }}</td>
                        <td>{{ $shop->created_at ? date('d.m.Y', strtotime($shop->created_at)) : '' }}</td>
                        <td>{{ $shop->tariff_finish ? date('d.m.Y H:i', strtotime($shop->tariff_finish)) : '' }}</td>
                        <td class="p-1">
                            <a href="{{route('admin.shop.edit', $shop->user_id ?? $shop->id)}}" class="text-secondary mr-1
                                ml-1" style="font-size: 18px;" title="Редактировать">
                                <i class="fa fa-edit" style="font-weight: 400"></i>
                            </a>
                            <a href="#" class="text-secondary mr-1 ml-1" style="font-size: 18px;"
                               onclick="if(confirm('Вы дейстивтельно хотите удалить авторазборку?')) document.getElementById('delete-user-{{ $shop->user_id ?? $shop->id }}').submit()" title="Удалить">
                                <i class="fas fa-trash-alt" style="font-weight: 400"></i>
                            </a>

                            <form action="{{ route('admin.shop.destroy', $shop->user_id ?? $shop->id) }}" method="post" class="d-none" id="delete-user-{{ $shop->user_id ?? $shop->id }}">
                                @csrf
                                @method('DELETE');
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted text-center" style="font-size: 25px" colspan="10">Авторазборок не найдено</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">{{ $shops->links() }}</td>
                </tr>
                </tfoot>
            </table>
        </div>

    </div>
@endsection
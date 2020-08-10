@extends('layouts.user.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-sm-6">
            <p class="m-0 text-dark text-center proposal_p">Поданные заявки на поиск запчастей</p>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="table-responsive">
        <table class="table table-main table-striped table-hover table-proposal" style="font-size: 14px;">
            <thead>
              <tr>
                <th class="bg-white border-0"></th>
                <th scope="col">№</th>
                <th scope="col">Дата</th>
                <th scope="col">Марка авто</th>
                <th scope="col">Модель авто</th>
                <th scope="col">Г/В</th>
                <th scope="col">VIN(Номер кузова)</th>
                <th scope="col">Номер двигателя</th>
                <th scope="col">Требуемые запчасти</th>
                <th scope="col" class="text-center">Действия</th>
              </tr>
            </thead>
            <tbody>
            @forelse($proposals as $proposal)
              <tr onclick="document.location.href = '{{ route('user.proposal.show', $proposal->id) }}'">
                  <td class="bg-white p-1 text-center">
                    @if(App\Models\Message::unreadMessage() > 0)
                      <i class="fas fa-certificate" style="color: rgb(246, 191, 0); font-size: 30px;"></i>   
                    @endif
                  </td>
                  <td>{{$proposal->id}}</td>
                  <td>{{ date('d.m.Y', strtotime($proposal->created_at)) }}</td>
                  <td>{{$proposal->mark}}</td>
                  <td>{{$proposal->model}}</td>
                  <td>{{$proposal->year_of_issue}}</td>
                  <td>{{$proposal->vin}}</td>
                  <td>{{$proposal->engine_number}}</td>
                  <td>{{$proposal->spares}}</td>
                  <td scope="col" class="text-center align-middle pt-1 pb-1">
                    <a 
                      href="{{route('user.proposal.edit', $proposal->id)}}"
                      class="text-secondary mr-1 ml-1" 
                      style="font-size: 22px;" 
                      title="Редактировать" 
                      onclick="event.stopPropagation();"
                    >
                      <i class="fa fa-edit" style="font-weight: 400"></i>
                    </a>
                    <a href="#" class="text-secondary"
                        style="font-size: 22px;" onclick="event.stopPropagation(); if(confirm('Вы ' +
                                  'дейстивтельно хотите удалить ' +
                                  'заявку?')) {event.preventDefault(); document.getElementById('proposal_del-{{$proposal->id}}').submit();}" 
                        title="Удалить">
                      <i class="fas fa-trash-alt" style="font-weight: 400"></i>
                    </a>
                    <form action="{{ route('user.proposal.destroy', $proposal->id) }}" method="POST" id="proposal_del-{{$proposal->id}}">
                      @csrf
                      @method('DELETE')
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="bg-white"></td>
                  <td class="text-muted text-center" style="font-size: 25px" colspan="9">Скоро здесь появятся заявки</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {!! $proposals->render() !!}

      </div>
    </div>
@endsection

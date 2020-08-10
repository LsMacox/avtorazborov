@extends('layouts.user.index')

@section('main_style')
    <link rel="stylesheet" href="{{asset('css/layouts/show_proposal.css')}}">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-sm-6">
            <p class="m-0 text-dark text-center proposal_p">Заявка {{$proposal->id}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="callback__block">
      <div class="row">
          <div class="col-md-1 col-xs-1 col-lg-1">
              <div class="back">
                  <a href="{{ URL::previous() }}"><i class="fas fa-arrow-circle-left"></i></a>
              </div>
          </div>
          <div class="col-md-3 col-xs-3 col-lg-3 block_fix_your_choice">
            <div class="your_choice">
              <p class="span">Вы выбрали:</p>
              <p>
                {{$proposal->mark}}
              </p>
              <p class="span">модель авто:</p> 
              <p>
                {{$proposal->model}}
              </p>   
            </div>
            <div class="bg_choice"></div>
            <div class="info_choice">
              <p class="g_v">Год выпуска <span>{{$proposal->year_of_issue}}</span></p>
              <p class="vin">VIN(Номер кузова)</p>
              <p class="info_choice_spare">{{$proposal->vin}}</p>
              <p class="number_engine">Номер двигателя</p>
              <p class="info_choice_spare">{{$proposal->engine_number}}</p>
              <p class="spare_parts">Требуемые запчасти:</p>
              <p class="info_choice_spare">{{$proposal->spares}}</p>
            </div>
            <div class="btn_setting_proposal">
                <div class="edit_proposal" onclick="document.location.href = '{{ route('user.proposal.edit', $proposal->id) }}'"><a href="#">Редактировать</a></div>
                
                <div class="del_proposal">
                    <a 
                    href="#"
                    onclick="event.stopPropagation(); if(confirm('Вы ' +
                              'дейстивтельно хотите удалить ' +
                              'заявку?')) {event.preventDefault(); document.getElementById('proposal_del').submit();}" 
                    title="Удалить">
                      Удалить Заявку
                    </a>
                    <form action="{{ route('user.proposal.destroy', $proposal->id) }}" method="POST" id="proposal_del">
                      @csrf
                      @method('DELETE')
                    </form>
                </div>
            </div>
          </div>
          <div class="col-md-8 col-xs-8 col-lg-8 d-flex">
            <div class="communication w-100">
                <div id="app">
                  <user-chat-app :proposal="{{json_encode($proposal)}}" :user="{{auth()->user()}}"></user-chat-app>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

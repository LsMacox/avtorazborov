<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>АВТОРАЗБОРОВ</title>

  <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
  <link rel="stylesheet" href="{{asset('css/lib.css')}}">
  <link rel="stylesheet" href="{{asset('css/index.css')}}">
  <link rel="stylesheet" href="{{asset('css/popups.css')}}">
  <link rel="stylesheet" type="text/css" media="all" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
  @yield('main_style')
  
	<link rel="manifest" href="/manifest.json">
	<script charset="UTF-8" src="//gstatic.com/firebasejs/6.6.0/firebase-app.js"></script>
	<script charset="UTF-8" src="//gstatic.com/firebasejs/6.6.0/firebase-messaging.js"></script>
	<script type="text/javascript" src="/push.js"></script>
</head>
<body class="hold-transition sidebar-mini">

<div id="app">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand bg-white navbar-light">

      <div class="w-100 ml-2">
        <div class="float-left position-relative">
            <p class="service_info">
              <a id="toggleBtn" data-widget="pushmenu" class="mr-1 text-secondary" href="#">
                <i class="fa fa-bars"></i></a>&nbspCервис поиска запчастей по всем авторазборкам и магазинам
            </p>
        </div>
        <div class="float-right d-flex flex-end justify-content-center
        align-items-center" style="margin-top:10px">
          <div class="phone_info d-flex align-items-center">
            <p class="mb-0">
              <span>Вы вошли под номером:</span>
              <br>
            <strong id="user_phone">{{ phone_number(auth()->user()->login) }}</strong>
            </p>
            <a class="logout_btn" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              {{ __('Выход') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../" class="brand-link d-flex logo" id="logo">
        <img src="{{asset('/images/logo.png')}}" alt="Logo">
        <p>АВТОРАЗБОРОВ</p>
      </a>
      @component('components.shop.main_active')@endcomponent

      @if($help = App\Models\Help::where('route', \Route::currentRouteName())->value('text'))
        <div class="help text-muted">
          <i class="far fa-comments" style="font-size: 28px;"></i><br>
          {{ $help }}
        </div>
      @endif

    </aside>
    <div class="content-wrapper">
      @yield('content')
    </div>

    </div>

  @if(!auth()->user()->checkCompletedProfileAboutShop())
    <div class="popup-bg" id="popup-bg">
      @component('components.popups.fill_in_contact_details', ['popup_id' => 999])@endcomponent
    </div>
  @endif
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/laroute.js') }}"></script>
<script type="text/javascript">
  @if(!auth()->user()->checkCompletedProfileAboutShop())
      helpers.popup(999, this)
  @endif
</script>
@yield('main_script')

</body>
</html>

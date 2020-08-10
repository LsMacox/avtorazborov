<nav id="mt_regul" style="margin-top: 20px">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="{{ route('shop.proposal.index') }}" class="nav-link  @if(Request::url() === route('shop.proposal.index'))active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Заявки на запчасти</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('shop.proposal.answers') }}" class="nav-link @if(Request::url() === route('shop.proposal.answers')) active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Ваши ответы</p>
        @if (count(App\Models\Message::where('to', auth()->id())->where('read', 0)->get()) > 0)<span class="new-messages-star" style="float:right"><span class="count">{{count(App\Models\Message::where('to', auth()->id())->where('read', 0)->get())}}</span></span>@endif
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('shop.profile.index') }}" class="nav-link @if(Request::url() === route('shop.profile.index')) active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Об авторазборке/магазине</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('shop.profile.transport-in-stock.index') }}" class="nav-link @if(Request::url() === route('shop.profile.transport-in-stock.index')) active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Авто в наличии</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('shop.profile.alert.index') }}" class="nav-link @if(Request::url() === route('shop.profile.alert.index')) active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Оповещения о заявках</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('shop.balance.index') }}" class="nav-link  @if(Request::url() === route('shop.balance.index')) active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Оплата</p>
      </a>
    </li>
  </ul>
</nav>
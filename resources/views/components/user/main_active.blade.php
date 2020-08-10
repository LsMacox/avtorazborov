<nav id="mt_regul" style="margin-top: 20px">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="{{ route('user.proposal.create') }}" class="nav-link  @if(Request::url() === route('user.proposal.create'))active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Подать заявку на поиск</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('user.proposal.index') }}" class="nav-link @if(Request::url() === route('user.proposal.index')) active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Поданные заявки</p>
        @if (App\Models\Message::unreadMessage() > 0)<span class="new-messages-star" style="float:right"><span class="count">{{ App\Models\Message::unreadMessage() }}</span></span>@endif
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('user.profile.index') }}" class="nav-link @if(Request::url() === route('user.profile.index')) active @endif">
        <i class="fa fa-chevron-right" style="display: none"></i>
        <p>Настройки</p>
      </a>
    </li>
  </ul>
</nav>
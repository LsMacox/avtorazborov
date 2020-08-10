<nav id="mt_regul" style="margin-top: 20px">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.proposal.index') }}" class="nav-link @if(Request::url() === route('admin.proposal.index')) active @endif">
                <i class="fa fa-chevron-right" style="display: none"></i>
                <p>Заявки</p>
            </a>
        </li>
      <li class="nav-item">
          <a href="{{ route('admin.profile.index') }}" class="nav-link @if(Request::url() === route('admin.profile.index')) active @endif">
              <i class="fa fa-chevron-right" style="display: none"></i>
              <p>Настроки админа</p>
          </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.db.cars.index') }}" class="nav-link @if(Request::url() === route('admin.db.cars.index')) active @endif">
          <i class="fa fa-chevron-right" style="display: none"></i>
          <p>
            База авто
          </p>
        </a>
      </li>
      <li class="nav-item">
          <a href="{{ route('admin.help.index') }}" class="nav-link @if(Request::url() === route('admin.help.index')) active @endif">
              <i class="fa fa-chevron-right" style="display: none"></i>
              <p>Подсказки</p>
          </a>
      </li>
      <li class="nav-item">
          <a href="{{ route('admin.user.index') }}" class="nav-link @if(Request::url() === route('admin.user.index')) active @endif">
              <i class="fa fa-chevron-right" style="display: none"></i>
              <p>Список пользователи</p>
          </a>
      </li>
      <li class="nav-item">
          <a href="{{ route('admin.shop.index') }}" class="nav-link @if(Request::url() === route('admin.shop.index')) active @endif">
              <i class="fa fa-chevron-right" style="display: none"></i>
              <p>
                  Список авторазборок
              </p>
          </a>
      </li>
      <li class="nav-item">
          <a href="{{ route('admin.db.location.index') }}" class="nav-link @if(Request::url() === route('admin.db.location.index')) active @endif">
              <i class="fa fa-chevron-right" style="display: none"></i>
              <p>База областей и городов</p>
          </a>
      </li>
      <li class="nav-item">
         <a href="{{ route('admin.db.synonym.transport.index') }}" class="nav-link @if(Request::url() === route('admin.db.synonym.transport.index')) active @endif">
            <i class="fa fa-chevron-right" style="display: none"></i>
            <p>Синонимы</p>
         </a>
      </li>
      <li class="nav-item">
          <a href="{{ route('admin.mail-list.index') }}" class="nav-link @if(Request::url() === route('admin.mail-list.index')) active @endif">
              <i class="fa fa-chevron-right" style="display: none"></i>
              <p>Рассылки</p>
          </a>
      </li>
    </ul>
</nav>
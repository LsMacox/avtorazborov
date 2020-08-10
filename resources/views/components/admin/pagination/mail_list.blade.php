@foreach($shop_profiles as $profile)
    <table class="table table-main table-mail_list" style="margin-left: 9px; max-width: 1151px; font-size: 14px; border: 2px solid #e8e8e8">
            <input type="hidden" name="user_id" value="{{$profile->id}}">
            <thead>
            <tr>
                <th style="max-width: 65px; border-bottom: 2px solid #e8e8e8">№</th>
                <th style="min-width: 270px; border-right: 2px solid #e8e8e8; border-bottom: 2px solid #e8e8e8; font-size: 13px"><strong>Наименование разборки/магазина</strong></th>
                <th style="min-width: 212px; border-right: 2px solid #e8e8e8; border-bottom: 2px solid #e8e8e8">
                    Регион
                    <a href="#" class="pull-right add_region" style="color: #000; font-size: 15px" title="Добавить регион">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </th>
                <th style="min-width: 218px; border-right: 2px solid #e8e8e8; border-bottom: 2px solid #e8e8e8">
                    Интересуют запчасти
                    <a href="#" class="pull-right add_spare" style="color: #000; font-size: 15px" title="Добавить запчасть">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </th>
                <th style="min-width: 410px; border-right: 2px solid #e8e8e8; border-bottom: 2px solid #e8e8e8">
                    Какие авто есть в разборе
                    <a href="#" class="pull-right add_transport" style="color: #000; font-size: 15px" title="Добавить авто">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr style="border-top: 2px solid #e8e8e8;">
                <td>
                    {{$profile->id}}
                </td>
                <td style="border-right: 2px solid #e8e8e8;">
                    <div class="shop_info">
                        <p><strong>{{$profile->shop_setting->name}}</strong></p>
                        <p>e-mail: {{$profile->shop_setting->email}}</p>
                        <p>тел: {{$profile->login}}</p>
                    </div>
                    <div class="state">
                        <input type="radio" name="state_{{$profile->id}}" value="right_away" id="radio_state_right_away_{{$profile->id}}" @if(isset($profile->shop_profile_alert->often_receive_notification) && $profile->shop_profile_alert->often_receive_notification == 'right_away') checked @endif>
                        <label for="radio_state_right_away_{{$profile->id}}">Сразу</label>
                    </div>
                    <div class="state">
                        <input type="radio" name="state_{{$profile->id}}" value="evening" id="radio_state_evening_{{$profile->id}}" @if(isset($profile->shop_profile_alert->often_receive_notification) && $profile->shop_profile_alert->often_receive_notification == 'evening') checked @endif>
                        <label for="radio_state_evening_{{$profile->id}}">Вечером</label>
                    </div>
                    <div class="state" id="checkbox_confirmed">
                        <input type="checkbox" @if(isset($profile->shop_profile_alert->confirmed) && $profile->shop_profile_alert->confirmed) checked @endif disabled>
                        <label for="checkbox_confirmed">Рассылка подтверждена</label>
                    </div>
                </td>
                <td style="border-right: 2px solid #e8e8e8;" class="regions">
                    @foreach($profile->shop_profile_alert_regions as $region)
                        <div class="region d-flex flex-row">
                            <p>{{trim($region->name)}}</p>
                            <a href="{{ route('admin.mail-list.region.destroy', $region) }}" title="удалить"><i class="far fa-trash-alt"></i></a>
                        </div>
                    @endforeach
                </td>
                <td style="border-right: 2px solid #e8e8e8;" class="spares">
                    @foreach($profile->shop_profile_alert_synonyms as $synonym)
                        @if($synonym->select)
                            <div class="spare d-flex flex-row">
                                <p>{{trim($synonym->name)}}</p>
                                <a href="{{ route('admin.mail-list.synonym.destroy', $synonym) }}" title="удалить"><i class="far fa-trash-alt"></i></a>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td style="border-right: 1px solid #e8e8e8;" class="transports">
                    <table>
                        <thead>
                        <tr>
                            <th>Марка</th>
                            <th>Модель</th>
                            <th style="padding-left: 38px;">Год</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profile->shop_transport_in_stocks->where('alert', 1) as $transport)
                            <tr>
                                <td class="marka">{{$transport->mark}}</td>
                                <td class="model">{{$transport->model}}</td>
                                <td class="year" style="padding-left: 38px;">
                                    {{$transport->year_from}}-{{$transport->year_before}}
                                    <a href="{{ route('admin.mail-list.transport.edit', $transport) }}" title="редактировать"><i class="far fa-edit"></i></a>
                                    <a id="delete" href="{{ route('admin.mail-list.transport.destroy', $transport) }}" title="удалить"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    {!! $shop_profiles->links() !!}
@endforeach
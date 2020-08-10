<div>
    <table style="width: 600px; margin: auto;">
        <thead>
            <tr>
                <td width="200px">
                    <img src="{{ url('/images/email-logo.jpg') }}" alt="Авторазборов" width="200px" style="margin-top: 5px">
                </td>
                <td style="font-size: 13px; line-height: 1.3">
                    Сервис поиска запчастей по всем авторазборкам и магазинам
                </td>
                <th style="text-align: right;font-size: 12px;">
                    www.авторазборов.рф<br>
                    8 (991) 437-1001
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <h4 style="font-size: 18px">Заявки на поиск запчастей</h4>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="max-width: 600px; line-height: 1.3; border-spacing: 0; text-align: center; font-size: 14px;">
                        <thead>
                            <tr style="background: #f6bf00;">
                                <td style="padding: 10px 3px;">№</td>
                                <td style="padding: 10px 3px;">Дата</td>
                                <td style="padding: 10px 3px;">Марка</td>
                                <td style="padding: 10px 3px;">Модель</td>
                                <td style="padding: 10px 3px;">Г/В</td>
                                <td style="padding: 10px 3px;">Требуемые запчасти</td>
                                <td style="padding: 10px 3px;">Город</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proposals as $key => $proposal)
                                <tr style="background: @if($key % 2 != 0) #fcf4e3 @endif">
                                    <td style="padding: 10px 5px;">{{ $key+1 }}</td>
                                    <td style="padding: 10px 5px;">{{ date('d.m.Y', strtotime($proposal->created_at)) }}</td>
                                    <td style="padding: 10px 5px;">{{$proposal->mark}}</td>
                                    <td style="padding: 10px 5px;">{{$proposal->model}}</td>
                                    <td style="padding: 10px 5px;">{{$proposal->year_of_issue}}</td>
                                    <td style="text-align: left; padding: 10px 5px;">{{$proposal->spares}}</td>
                                    <td style="padding: 10px 5px;">{{$proposal->city}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background: #f6bf00;">
                                <th colspan="8">
                                    Для просмотра контактных данных клиента, войдите в
                                    <a href="{{ url('/login') }}" style="border: 1px solid #000; border-radius: 50px; padding: 5px 10px; color: #000; text-decoration: none; display: inline-block; margin: 5px;">Личный кабинет</a>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="font-size: 14px">
                    <div style="text-align: center;margin: 15px 0;">Если у вас нет логина и пароля для доступа в личный кабинет, то <b>зарегистрируйтесь бесплатно <a href="{{ url('/register') }}" style="color: #000;">по ссыллке</a></b></div>
                    ----------------------------<br>
                    Антон Сергеевич Теплов<br>
                    Руководитель отдела подкглючения в г. Екатеренбург и Свердловской области
                    <br><br>
                    г. Екатеринбург<br>
                    8 (343) 28-82-082
                </td>
            </tr>
        </tbody>
    </table>
</div>
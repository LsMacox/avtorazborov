<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Счет на оплату</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr td, th {
            border: 1px solid black;
            padding: 3px;
        }

        table.without-border tr td {
            border: none;
        }

        .text-top { vertical-align: top; }
    </style>
</head>
<body>

<p style="text-align: center;">
    Внимание! Оплата данного счета означает согласие с условиями пользовательского соглашения. Уведомление об оплате обязательно. Доступ к личному кабинету предоставляется по факту поступления денег на р/с Поставщика.
</p>

<table>
    <tr>
        <td rowspan="2" colspan="2">
            Байкальский банк Сбербанка России г. Иркутск<br>
            <small>банк получателя</small>
        </td>
        <td><small>БИК</small></td>
        <td style="border-bottom: none;">
            042520607
        </td>
    </tr>
    <tr>
        <td><small>СЧ. №</small></td>
        <td style="border-top: none;">30101810900000000607</td>
    </tr>
    <tr>
        <td>ИНН 3811462315</td>
        <td>КПП 381101001</td>
        <td rowspan="2" class="text-top"><small>СЧ. №</small></td>
        <td rowspan="2" class="text-top">40702810018350024930</td>
    </tr>
    <tr>
        <td colspan="2">
            ООО "Единая Справочная Система"<br>
            <small>Получатель</small>
        </td>
    </tr>
</table>

<h2 style="margin-top: 15px;">Счет на оплату № АР-{{ $id }} от {{ $date }} г.</h2>

<hr>

<table class="without-border" style="margin-top: 15px;">
    <tr>
        <td class="text-top">Поставщик:</td>
        <td>
            Общество с ограниченной ответственностью "Единая Справочная Система", ИНН
            3811462315, КПП 381101001, 664009, г. Иркутск, ул. Ширямова, стр. 10/7, оф 32,
            тел.: +7 (991) 435-1001
        </td>
    </tr>
    <tr>
        <td class="text-top">Покупатель:</td>
        <td>
            {{ $title }}<br>
            ИНН: {{ $inn }} ОГРНИП: {{ $ogrn }}
            АДРЕС РЕГИСТРАЦИИ: {{ $address }}
            БАНК: ТОЧКА ПАО БАНКА "ФК ОТКРЫТИЕ"АДРЕС БАНКА: г. Москва
            БИК: 044525999 КОР. СЧЕТ: 30101810845250000999 РАСЧЕТНЫЙ СЧЕТ:
            40802810012500007788
        </td>
    </tr>
</table>

<table style="margin-top: 15px; text-align: center; margin-bottom: 15px;">
    <tr>
        <th>№</th>
        <th style="text-align: left">Товары (работы, услуги)</th>
        <th>Кол-во</th>
        <th>Ед.</th>
        <th>Цена</th>
        <th>Сумма</th>
    </tr>
    <tr>
        <td>1</td>
        <td style="text-align: left">Оплата тарифа {{ $tariff }}</td>
        <td>1</td>
        <td>шт</td>
        <td>{{ number_format($price, 2, ',', ' ') }}</td>
        <td>{{ number_format($price, 2, ',', ' ') }}</td>
    </tr>
    <tr>
        <td colspan="5" style="border: none!important; text-align: right;">
            <b>Итого:</b><br>
            <b>В том числе НДС:</b><br>
            <b>Всего к оплате:</b>
        </td>
        <td style="border: none!important; text-align: right;">
            {{ number_format($price, 2, ',', ' ') }}<br>
            Без НДС<br>
            {{ number_format($price, 2, ',', ' ') }}
        </td>
    </tr>
</table>

Всего наименований 1, на сумму {{ number_format($price, 2, ',', ' ') }} руб.<br>
{{ $price_str }}

<hr style="margin-top: 15px; margin-bottom: 15px;">

<div style="position: relative;">
    <b>Руководитель </b> _____________________________<u>Семенов Ю.С.</u>__ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Бухгалтер </b> _______<u>Семенов Ю.С.</u>_______
</div>



</body>
</html>
@extends('layouts.shop.index')

@section('main_style')
    <link rel="stylesheet" href="{{ asset('css/layouts/avtorazborka.alerts.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layouts/profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layouts/alert.css') }}" />
@endsection

@section('content')
    <div class="content">
        <section class="enotification">
            <div class="enotification__title">
                <span>Получайте заявки от клиентов первыми, настроив оповещения на электронную  почту</span>
            </div>
            <form class="enotification__steps" id="form_enotification" method="post" action="#">
                <div class="enotification__top">
                    <div class="enotification__step enotification__step1 step-active">
                        <span class="step__title"><i class="far fa-envelope"></i> Шаг 1</span>
                        <span class="enotification__descr">Укажите почту, на которую вы будете получать заявки на поиск запчастей</span>
                        <input type="text" id="email_input" class="enotification__input" placeholder="email" value="">
                    </div>
                    <div class="enotification__step enotification__step2">
                        <span class="step__title"><i class="far fa-clock"></i> Шаг 2</span>
                        <span class="enotification__descr">Укажите, как часто вы хотите получать<br>
						оповещения о новых заявках?</span>
                        <div class="enotification__checks">
                            <label class="enotification__radio">Сразу, как пришла заявка на имеюшиеся марки авто
                                <input type="radio" name="r1" value="right_away">
                                <span class="encheckmark"></span>
                            </label>
                            <label class="enotification__radio">вечером (17-00) все заявки за текущий день
                                <input type="radio" name="r1" value="evening">
                                <span class="encheckmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="enotification__step enotification__step3 step-active">
                    <span class="step__title"><i class="fas fa-map-marker-alt"></i>Шаг 3</span>
                    <span class="enotification__descr">Выберите из каких регионов РФ вы хотите получать заявки</span>
                    <div class="enotification__regions">

                        <div class="enotification__region add-region" onclick="popupRegions(3, this)">
                            <span>Добавить регион</span>
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="enotification__step enotification__step4 step-active">
                    <span class="step__title"><i class="fas fa-cogs"></i>Шаг 4</span>
                    <span class="enotification__descr">Выберите на какие типы запчастей вы хотите получать заявки</span>
                    <div class="enotification__chooses">
                        @foreach($synonyms as $word)
                            <label class="enotification__choose">{{$word->name}}
                                @if ($word->synonym_transport_synonyms->count() != 0)
                                @php
                                    $arr_synonym_names = [];
                                    $synonym_names = '';
                                    $transport_synonym_keys = array_keys($word->synonym_transport_synonyms->toArray());
                                    shuffle($transport_synonym_keys);
                                @endphp
                                @foreach($transport_synonym_keys as $key)
                                    @if (count($arr_synonym_names) < mt_rand(2,3))
                                        @php array_push($arr_synonym_names, $word->synonym_transport_synonyms[$key]->name) @endphp
                                    @endif
                                @endforeach
                                @foreach($arr_synonym_names as $str_synonym)
                                    @php $synonym_names = $synonym_names.$str_synonym.', ' @endphp
                                @endforeach
                                @php
                                    $synonym_names = '( ' . mb_substr($synonym_names, 0, strlen($synonym_names)-2).' и т.д.)';
                                @endphp
                                    <span class="choosedescr">{{$synonym_names}}</span>
                                @endif
                                <input type="checkbox" name="{{$word->name}}">
                                <span class="choosecheck"></span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="enotification__step enotification__step5 step-active">
                    <span class="step__title"><i class="fas fa-cogs"></i>Шаг 5</span>
                    <span class="enotification__descr">Выберите марки и модели автомобилей, на которые у вас имеются запчасти</span>
                    <div class="enotification__select">
                        <div class="catalog_wrapper">
                            <div class="catalog">

                            </div>
                        </div>
                    </div>
                </div>
                <button class="enotification__button" id="enotification__button" onclick="save_alert_fetch_data()">Отправить проверочное письмо <i class="far fa-envelope"></i></button>

            </form>
        </section>

    </div>
    <div class="popup-bg" id="popup-bg">
    @component('components.popups.transport_in_stock', ['popup_id' => 1])@endcomponent
    @component('components.popups.alert', ['popup_id' => 2])@endcomponent
    @component('components.popups.regions', ['popup_id' => 3, 'regions' => $regions])@endcomponent
    </div>
@endsection

@section('main_script')
@php
    $regions = [];
    $synonyms = [];
@endphp
@foreach($alert_regions as $region)
    @php array_push($regions, $region->name); @endphp
@endforeach
@foreach($alert_synonyms as $synonym)
    @php $synonyms[$synonym->name] = $synonym->select @endphp
@endforeach
<script type="text/javascript">
// Notification //
var form_email = '{{ $alert->email ?? $shop_setting->email ?? ''}}',
    form_regions = {!! json_encode($regions) ?? '[]' !!},
    form_receive_proposal = '{{ $alert->often_receive_notification ?? '' }}',
    form_synonyms = @json((object)$synonyms),
    form_transport = {
    'clear' : {
        'car' : [],
    },
    'add' : {
        'car' : [],
    }
    };


$('body').click(function () {
    console.log(form_regions);
});

// Act
add_regions();

if (form_receive_proposal.length != 0) {
    for (let key in form_synonyms){
        if (form_synonyms[key]){
            $('.enotification__step4 .enotification__choose input[name="'+key+'"]').attr('checked', 'checked');
        }
    };
}
$('.enotification__step4 .enotification__choose').click(function () {
    if ($(this).find('input[type="checkbox"]').is(':checked')){
        $(this).find('input[type="checkbox"]').attr('checked', 'checked');
    }else {
        $(this).find('input[type="checkbox"]').removeAttr('checked');
    }
});
$('.enotification__step4 .enotification__choose input[type="checkbox"]').each(function () {
    form_synonyms[$(this).attr('name')] = $(this).is(':checked');
});
$('.enotification__step4 .enotification__choose input[type="checkbox"]').change(function () {
    form_synonyms[$(this).attr('name')] = $(this).is(':checked');
});

$('.popup_alerts .popup_alerts_footer button.success').click(function () {
    axios.get($(this).attr('href'));
    popupAlert(-1);
});

$('#enotification__button').on('click', function(e) {
    e.preventDefault();
});
$('#email_input').val(form_email);
if ($('#email_input').val().length >= 1) {
    if (form_receive_proposal != '')
    {
        $('input[name="r1"][value="'+form_receive_proposal+'"]').attr('checked', 'checked');
    }else
    {
        $('[name="r1"]:first').attr('checked', 'checked');
    }
    form_receive_proposal = $('[name="r1"]').val();
    $(".enotification__step2").addClass("step-active");
}
$('[name="r1"]').on('change', function () {
    form_receive_proposal = $(this).val();
});
$('#email_input').blur(function(){          //whenever you click off an input element
    if($(this).val()) {                      //if it is blank.
        $(".enotification__step2").addClass("step-active");
        form_email = $(this).val();
    }else{
        $(".enotification__step2").removeClass("step-active");
    }
});
$('.popup_cities .popup_db_sub_title').click(function () {
    popupRegions(-1);

    var check = true;

    for (let i = 0; i <= form_regions.length; i++)
    {
        if ($(this).html() == form_regions[i])
        {
            check = false;
            return false;
        }else if($(this).html() !== form_regions[i]){
            $(this).css({'color' : 'black', 'cursor' : 'not-allowed'});
        }
    }

    if (check){
        // Add Input
        var lolo = '<div class="enotification__region"><input  class="reg-inp" type="text" disabled><i class="fas fa-trash-alt region-delete"></i></div>';
        $('.enotification__regions').prepend(lolo);

        // Add text to Input
        var text = $(this).text().trim();
        var payment = parseInt($(this).css('font-size').replace('px', '')) + 2.3 + 'px ' + ' Arial';

        $('.reg-inp').first().val(text);
        $('.reg-inp').first().css({'width': helpers.getTextWidth(text, payment)});

        // Add Input text to Array
        form_regions.push($('.reg-inp').first().val());
    }

    $(".region-delete").on('click', function(e) {
        e.preventDefault();
        for (let i = 0; i <= form_regions.length; i++)
        {
            if ($(this).parent().find('.reg-inp').val() == form_regions[i])
            {
                form_regions.splice(i, 1);
            }
        }
        $(this).parent().fadeOut();
        $(this).parent().remove();
        $('.popup_cities .popup_db_sub_title:contains("'+$(this).parent().find('.reg-inp').val()+'")').css({'color' : '#007bff', 'cursor' : 'pointer'});
    });
});
$(".region-delete").on('click', function(e){
    e.preventDefault();
    for (let i = 0; i <= form_regions.length; i++)
    {
        if ($(this).parent().find('.reg-inp').val() == form_regions[i])
        {
            form_regions.splice(i, 1);
        }
    }
    $(this).parent().fadeOut();
    $(this).parent().remove();
    $('.popup_cities .popup_db_sub_title:contains("'+$(this).parent().find('.reg-inp').val()+'")').css({'color' : '#007bff', 'cursor' : 'pointer'});
});
function add_regions() {
    if (form_regions.length == 0)
    {
        let container_region = $('.popup_cities .popup_db_sub_title:contains("{{Geo::get_value('region')}}")');

        container_region.css({'color' : 'black', 'cursor' : 'not-allowed'});
        var lolo = '<div class="enotification__region"><input  class="reg-inp" type="text" disabled><i class="fas fa-trash-alt region-delete"></i></div>';
        $('.enotification__regions').prepend(lolo);

        var text = container_region.text();
        var payment = parseInt(container_region.css('font-size').replace('px', '')) + 2.3 + 'px ' + ' Arial';

        $('.reg-inp').first().val(text);
        $('.reg-inp').first().css({'width': helpers.getTextWidth(text, payment)});

        form_regions.push('{{Geo::get_value('region')}}');
    }else {
        form_regions.forEach(function (region) {
            let container_region = $('.popup_cities .popup_db_sub_title:contains("' + region + '")');

            container_region.css({'color': 'black', 'cursor': 'not-allowed'});
            var lolo = '<div class="enotification__region"><input  class="reg-inp" type="text" disabled><i class="fas fa-trash-alt region-delete"></i></div>';
            $('.enotification__regions').prepend(lolo);

            var text = container_region.text();
            var payment = parseInt(container_region.css('font-size').replace('px', '')) + 2.3 + 'px ' + ' Arial';

            $('.reg-inp').first().val(text);
            $('.reg-inp').first().css({'width': helpers.getTextWidth(text, payment)});
        });
    }
}
// Notification //


// ACT
$('.catalog, .popular').on('click', 'li', renderModels);
$('.logos').on('click', '.logo-mini', renderModels);
$('#undo_model').on('click', function () {
    helpers.undo_models(form_transport['add']['car']);
});

getCars(laroute.route('shop.profile.alert.transport-in-stock.available'),
    laroute.route('transport.cars.get-marks'),
    'popupModels(1, this, "car")');

//Render Models
async function renderModels () {

    $mark = $(this).text().trim();

    $('#ajaxCatalog .model').html( $mark );

    $('#renderModels').html('');

    await axios.get(laroute.route('transport.cars.get-mark-models', {mark_name_or_mark_id: $mark}))
        .then ((response) => {
            window.$carModels = {};
            var carModels = [];
            var carModelsLetter = [];

            response.data.forEach(function(model) {
                carModels.push(model.title);
                carModelsLetter.push(model.title.charAt(0));
            });

            // Сортируем
            carModels.sort();
            carModelsLetter.sort();
            // Преобразуем
            carModelsLetter = carModelsLetter.map(function (e) { return e.toUpperCase() });
            carModelsLetter = helpers.unique(carModelsLetter);

            carModelsLetter.forEach(function (letter) {
                window.$carModels[letter] = [];

                carModels.forEach(function (car) {
                    if ( letter.indexOf(car.toUpperCase().charAt(0)) !== -1 )
                    {
                        window.$carModels[letter].push(car);
                    }
                });
            });
        });

    models = window.$carModels;

    for (key in models) {
        let block = document.createElement('div');
        let ul = document.createElement('ul');
        let p = document.createElement('p');

        block.classList.add('block');
        p.classList.add('letter');
        p.appendChild(document.createTextNode(key));

        $models = models[key];

        for (keyModel in $models) {
            block.setAttribute("data-model", $models[keyModel]);
            li = document.createElement('li');
            a = document.createElement('a');
            a.appendChild(document.createTextNode($models[keyModel]));
            a.href = '#x';
            a.id = $models[keyModel];
            a.setAttribute("onclick", "form_transport['add']['car'] = helpers.add_select_year(this, form_transport['add']['car'])");
            li.appendChild(a);
            ul.appendChild(li)
        }

        block.appendChild(p);
        block.appendChild(ul);

        $('#renderModels').append(block);
    }


    var result = {};
    var marks_available = [];
    var models_available = [];
    var year_of_issue_from = {};
    var year_of_issue_before = {};
    axios({url: laroute.route('shop.profile.alert.transport-in-stock.available'), method: 'post', data: $mark})
        .then(available => {

            if (available.data.length > 0) {

                for (let i = 0; i < available.data.length; i++) {
                    marks_available.push(available.data[i].mark);
                    models_available.push(available.data[i].model);
                }

                marks_available = helpers.unique(marks_available);


                marks_available.forEach(function(mark){
                    result[mark] = [];
                    year_of_issue_from[mark] = [];
                    year_of_issue_before[mark] = [];
                    available.data.forEach(function (response) {
                        if (mark == response.mark) {
                            result[mark].push(response.model);
                            year_of_issue_from[mark].push(response.year_from);
                            year_of_issue_before[mark].push(response.year_before);
                        }
                    });
                });


                for (key in result) {
                    if ($mark == key) {
                        for (var i = 0; i < result[key].length; i++) {
                            $('#' + result[key][i]).css({
                                'background': 'rgba(246, 191, 0, 0.27)',
                                'padding-right': '10px',
                                'padding-left': '5px',
                                'color': 'rgb(131, 136, 132)'
                            });

                            helpers.add_select_year(document.getElementById(result[key][i]), form_transport['add']['car'], year_of_issue_from[key][i], year_of_issue_before[key][i]);

                        }
                    }
                }
            }
        });
}

//Functions
async function getMarks (url) {
    await axios.get(url)
        .then(function (response) {
            window.$carMarks = [];
            window.$carMarksLetters = [];

            for (let i = 0; i < response.data.length; i++) {
                window.$carMarks.push(response.data[i].title);
                window.$carMarksLetters.push(response.data[i].title.charAt(0));
            }

            // Сортируем
            window.$carMarks.sort();
            window.$carMarksLetters.sort();
            // Преобразуем
            window.$carMarksLetters = window.$carMarksLetters.map(function (e) {
                return e.toUpperCase()
            });
            window.$carMarksLetters = helpers.unique(window.$carMarksLetters);
        });

    let result = {};

    window.$carMarksLetters.forEach(function (letter) {
        result[letter] = [];

        window.$carMarks.forEach(function (car) {
            if ( letter.indexOf(car.toUpperCase().charAt(0)) !== -1 )
            {
                result[letter].push(car);
            }
        });
    });

    return result;
}
async function getCars (urlAvailable, urlMarks, popup) {
    $('.catalog').empty();
    await axios({url: urlAvailable, method: 'post'})
        .then((carsAvailable) => {
            console.log(carsAvailable.data);
            window.$marksAvailable = [];
            let logos = [];

            if (carsAvailable.data.length == 0) return;

            carsAvailable.data.forEach(function(carAvailable) {
                window.$marksAvailable.push(carAvailable.mark);
            });

            for (let i = 0; i < $('.logo-mini p').length; i++) {
                logos.push($('.logo-mini p')[i].innerHTML);
            }

            window.$marksAvailable = helpers.unique(window.$marksAvailable);

            logos.forEach(function (logo) {
                $('.' + logo).parent('.logo-mini').removeClass('logo-mini-after');
            })

            // Выделение популярных машин
            window.$marksAvailable.forEach(function (mark) {
                logos.forEach(function (logo) {
                    if (logo == mark) {
                        $('.' + logo).parent('.logo-mini').addClass('logo-mini-after');
                    }
                })
            });
        });

    getMarks(urlMarks)
        .then((marks) => {
            window.$carMarks = marks;

            for (key in marks) {

                let block = document.createElement('div');
                let p = document.createElement('p');
                let ul = document.createElement('ul');

                block.classList.add('block');
                p.className = 'letter';

                let arr_marks = marks[key];

                arr_marks.forEach(function (mark) {
                    li = document.createElement('li');
                    a = document.createElement('a');

                    a.href = '#';
                    li.setAttribute("data-mark", mark);
                    a.setAttribute("onclick", popup);

                    a.appendChild(document.createTextNode(mark));
                    li.appendChild(a);
                    ul.appendChild(li)
                });

                p.appendChild(document.createTextNode(key));
                block.appendChild(p);
                block.appendChild(ul);
                $('.catalog').append(block);
            }

            // Выделение не популярных машин
            logosMini = [];
            for (let i=0; i < $('.catalog_wrapper li a').length; i++)
            {
                logosMini.push($('.catalog_wrapper li a')[i].text);
            }
            logosMini.forEach(function (logo) {
                window.$marksAvailable.forEach(function (mark) {
                    if (mark == logo) {
                        $("[data-mark='" + mark + "']").find('a').addClass('active_data_marka');
                    }
                });
            });
        });
}

// Popups
function popupModels(nm, e, type_transport) {
    helpers.popup(nm, e)
        .then((data) => {
            let clearTransport = {
                'mark': $(data.e).text().trim()
            };
            form_transport['clear'][type_transport].push(clearTransport);
        })
        .catch(error => {
            form_transport['add'][type_transport] = [];
            form_transport['clear'][type_transport] = [];
        });
}
function popupRegions(nm, e) {
    helpers.popup(nm, e)
    .then(data => {

    })
    .catch(error => {

    });
}
function popupAlert(nm, e, email) {
    $('.popup_alerts .popup_alerts_body').empty();
    $('.popup_alerts .popup_alerts_body').append('' +
        '       <p>Проверочное письмо отправлено на почту\n' +
        '        <strong>'+ email +'</strong>\n' +
        '        </p>\n' +
        '        <p>\n' +
        '        Просим посмотреть почту и потвердить, что\n' +
        '        письмо дошло до вас.</p>');
    $('.popup_alerts .popup_alerts_footer').empty();
    $('.popup_alerts .popup_alerts_footer').append('<button class="did_not_come" onclick="email_not_delivered_fetch_data()">Письмо не пришло</button>\n' +
        '        <button class="success">Проверочное письмо получено</button>');
    helpers.popup(nm, e)
    .then(data => {

    })
    .catch(error => {

    });
}
function popupRegionLimit(nm, e) {
    $('.popup_alerts .popup_alerts_body').empty();
    $('.popup_alerts .popup_alerts_body').append('' +
        '       <p style="font-size: 16px">Что бы получать заявки на поиск запчастей\n' +
        '        <span style="text-decoration: underline">из 5 и более регионов выберите и оплатите один</span>\n' +
        '        из тарифных планов.' +
                '</p>');
    $('.popup_alerts .popup_alerts_footer').empty();
    $('.popup_alerts .popup_alerts_footer').append('<button class="did_not_come" onclick="popupRegionLimit(-1)" style="font-size: 10px">Остаться на тестовом периоде</button>\n' +
        '        <button class="success" onclick="location.href = \'{{ route('shop.balance.index') }}\'">Выбрать тарифный план</button>');
    helpers.popup(nm, e)
        .then(data => {

        })
        .catch(error => {

        });
}

// Fetch data
function save_transport_fetch_data() {
    axios({
        url: '{{route('shop.profile.alert.transport-in-stock.store')}}',
        method: 'post',
        data: form_transport
    })
    .then(response => {
        helpers.popup(-1);
        form_transport['add']['car'] = [];
        form_transport['clear']['car'] = [];
        getCars(laroute.route('shop.profile.alert.transport-in-stock.available'),
            laroute.route('transport.cars.get-marks'),
            'popupModels(1, this, "car")');
    });
}
function save_alert_fetch_data() {
    let is_synonym = false;
    let is_tariff = false;

    for (key in form_synonyms)
    {
        if (form_synonyms[key]) {
            is_synonym = true;
            break;
        }
    }

    if ('{{mb_strtolower($shop_tariff->title)}}' == 'тестовый 15 дней' && form_regions.length > 5 )
    {
        is_tariff = true;
    }

    if (!is_synonym) {
        swal.fire({
            icon: 'error',
            title: 'Ошибка...',
            text: 'Выберите хоть одну запчасть на которую хотите получать оповещение',
        });
    }else if (is_tariff) {
        popupRegionLimit(2, this);
    }
    else {
        axios({
            url: '{{route('shop.profile.alert.store')}}',
            method: 'post',
            data: {
                email: form_email,
                regions: form_regions,
                synonyms: form_synonyms,
                receive_notification: form_receive_proposal
            },
        })
        .then(response => {
            $('.popup_alerts .popup_alerts_footer button.success').attr('href', response.data.url_confirmed);
            $('.popup_alerts .popup_alerts_body p:first > strong').html(response.data.email);
            $('.popup_alerts .popup_alerts_footer .success').attr('onclick', 'confirmed_alert_fetch_data()');
            popupAlert(2, this, response.data.email);
        })
        .catch(error => {
            let errors = '';
            for (key in error.response.data.errors) {
                errors += error.response.data.errors[key] + '\n';
            }
            swal.fire({
                icon: 'error',
                title: 'Ошибка...',
                text: errors,
            });
        });
    }
}
function email_not_delivered_fetch_data() {
    axios({
        url: '{{route('shop.profile.alert.email-not-delivered')}}',
        method: 'post',
    })
    .then(response => {
        console.log(response.data);
        popupAlert(-1);
    });
}
function confirmed_alert_fetch_data() {
    popupRegionLimit(-1);
    axios.get('{{ route('shop.profile.alert.confirmed', auth()->id()) }}');
}

</script>

@endsection
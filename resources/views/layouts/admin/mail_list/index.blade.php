@extends('layouts.admin.index')

@section('main_style')
    <link rel="stylesheet" href="{{asset('css/layouts/mail_list.css')}}">
    <link rel="stylesheet" href="{{ asset('css/layouts/profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/layouts/avtorazborka.alerts.css') }}" />
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-primary m-2">{{ Session::get('success') }}</div>
    @endif
    <div class="content">
        <div class="table-responsive">
            <div class="add_alert">
                <a href="{{ route('admin.mail-list.create') }}">Добавить вручную</a>
            </div>
            <div id="table_data">
                @include('components.admin.pagination.mail_list')
            </div>
        </div>
    </div>
    <div class="popup-bg" id="popup-bg">
        @component('components.popups.transport_in_stock', ['popup_id' => 1])@endcomponent
        @component('components.popups.regions', ['popup_id' => 2, 'regions' => $regions])@endcomponent
        @component('components.popups.synonym', ['popup_id' => 3, 'synonyms' => $synonyms])@endcomponent
        @component('components.popups.transport', ['popup_id' => 4])@endcomponent
    </div>
@endsection
@section('main_script')
<script type="text/javascript">
var form_region,
    form_synonym,
    form_transport_table,
    form_transport = {
        'clear' : {
            'car' : [],
        },
        'add' : {
            'car' : [],
        }
    };

// Act
$('.catalog, .popular').on('click', 'li', renderModels);
$('.logos').on('click', '.logo-mini', renderModels);
$('#undo_model').on('click', function () {
    helpers.undo_models(form_transport['add']['car']);
});

$(document).on('click', '.pagination a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    pagination_fetch_data(page);
});

getCars(laroute.route('transport.cars.get-marks'),
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
async function getCars (urlMarks, popup) {
    $('.catalog').empty();
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

        });
}

$('.table-mail_list input[type="radio"]').change(function () {
    let id = $(this).attr('name').replace('state_', '');
    let val = $(this).val();

    axios.post('{{ route('admin.mail-list.change.often-receive-notification') }}', {
       user_id: id,
       name: val
    });
});

$('.popup_cities .popup_db_sub_title').on('click', function () {
    if (!$(this).hasClass('no-selected')) {
        popupRegions(-1);
        axios.post('{{ route('admin.mail-list.region.store') }}', {
           user_id: $(form_region).parents('.table-mail_list').find('input[name="user_id"]').val(),
           name: $(this).text().trim()
        })
        .then(response => {
            $(form_region).parents('.table-mail_list').find('td.regions').append('<div class="region d-flex flex-row"><p>'+ $(this).text().trim() +'</p><a href="' + laroute.route('admin.mail-list.region.destroy', {region: response.data.id})  + '" title="удалить"><i class="far fa-trash-alt"></i></a></div>');
        });
    }
});
$('.popup_synonym .popup_db_sub_title').on('click', function () {
    if (!$(this).hasClass('no-selected')) {
        popupSynonym(-1);
        axios.post('{{ route('admin.mail-list.synonym.store') }}', {
            user_id: $(form_synonym).parents('.table-mail_list').find('input[name="user_id"]').val(),
            name: $(this).text().trim()
        })
        .then(response => {
            $(form_synonym).parents('.table-mail_list').find('td.spares').append('<div class="spare d-flex flex-row"><p>'+ $(this).text().trim() +'</p><a href="' + laroute.route('admin.mail-list.synonym.destroy', {synonym: response.data.id})  + '" title="удалить"><i class="far fa-trash-alt"></i></a></div>');
        });
    }
});

$('body').on('click', 'td.regions .region a', function(e) {
   e.preventDefault();
   axios.delete($(this).attr('href'))
    .then(response => {
        $(this).parent().css({"opacity": "0"});
        setTimeout(() => {
            $(this).parent().remove();
            mark_selected_regions();
        }, 600);
    });
});
$('body').on('click', 'td.spares .spare a', function(e) {
    e.preventDefault();
    axios.delete($(this).attr('href'))
        .then(response => {
            $(this).parent().css({"opacity": "0"});
            setTimeout(() => {
                $(this).parent().remove();
                mark_selected_spares();
            }, 600);
        });
});

$('body').on('click', '.add_region', function () {
    popupRegions(2, this);
});
$('body').on('click', '.add_spare', function () {
    popupSynonym(3, this);
});
$('body').on('click', '.add_transport', function () {
    popupTransport(4, this);
});

function mark_selected_regions() {
    let container_region_title = $('.popup_cities .popup_db_sub_title');

    container_region_title.css({'color' : '#007bff', 'cursor' : 'pointer'}).removeClass('no-selected');

    container_region_title.each(function(key, region) {
        let container_region = $(form_region).parents('.table-mail_list').find('td.regions .region p:contains("' + $(region).text() + '")');

        if (container_region.length)
        {
            $(region).css({'color' : 'black', 'cursor' : 'not-allowed'}).addClass('no-selected');
        }
    })
}
function mark_selected_spares() {
    let container_synonym_title = $('.popup_synonym .popup_db_sub_title');

    container_synonym_title.css({'color' : '#007bff', 'cursor' : 'pointer'}).removeClass('no-selected');

    container_synonym_title.each(function(key, synonym) {
        let container_synonym = $(form_synonym).parents('.table-mail_list').find('td.spares .spare p:contains("' + $(synonym).text() + '")');

        if (container_synonym.length)
        {
            $(synonym).css({'color' : 'black', 'cursor' : 'not-allowed'}).addClass('no-selected');
        }
    })
}

// Popups
function popupTransport(nm, e) {
    helpers.popup(nm, e)
    .then((data) => {
        form_transport_table = e;
    })
    .catch(error => {

    });
}
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
        form_region = e;
        mark_selected_regions();
    })
    .catch(error => {

    });
}
function popupSynonym(nm, e) {
    helpers.popup(nm, e)
    .then(data => {
        form_synonym = e;
        mark_selected_spares();
    })
    .catch(error => {

    });
}

// Fetch data
function save_transport_fetch_data() {
    axios.post('{{ route('admin.mail-list.transport.store') }}', {
        transport: form_transport,
        user_id: $(form_transport_table).parents('.table-mail_list').find('input[name="user_id"]').val()
    })
    .then(response => {
        console.log(response.data);

        response.data.forEach(function (transport) {
            $(form_transport_table).parents('.table-mail_list').find('td.transports tbody').append('<tr>\n' +
                '                                    <td class="marka">'+ transport.mark +'</td>\n' +
                '                                    <td class="model">'+ transport.model +'</td>\n' +
                '                                    <td class="year" style="padding-left: 38px;">\n' +
                '                                        '+ transport.year_from +'-'+ transport.year_before +'\n' +
                '                                        <a href="'+ laroute.route('admin.mail-list.transport.edit', {transport: transport.id}) + '" title="редактировать"><i class="far fa-edit"></i></a>\n' +
                '                                        <a id="delete" href="'+ laroute.route('admin.mail-list.transport.destroy', {transport: transport.id}) +'" title="удалить"><i class="far fa-trash-alt"></i></a>\n' +
                '                                    </td>\n' +
                '                                </tr>')
        });

    });
    popupModels(-1);
}

function pagination_fetch_data(page) {
    $.ajax({
        url: '{{ route('admin.mail-list.get-paginate') }}?page='+page,
        success: function (data) {
            $('#table_data').html(data);
        }
    })
}

$('body').on('click', '.table-mail_list td.transports table tbody > tr > td.year a#delete', function (e) {
    e.preventDefault();

    axios.delete($(this).attr('href'))
    .then(response => {
        $(this).parent().parent().css({"transition": ".6s ease"});
        $(this).parent().parent().css({"opacity": "0"});
        setTimeout(() => {
            $(this).parent().parent().remove();
        }, 600);
    });
})

</script>
@endsection
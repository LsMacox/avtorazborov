@extends('layouts.shop.index')

@section('main_style')
    <link rel="stylesheet" href="{{asset('css/layouts/profile.css')}}">
@endsection

@section('content')
   
    <section>
        <div class="wrap">
            <h2>Какие авто есть в наличии?</h2>
            <p class="sub tac">ПРОСТО НАЖМИТЕ ИЗООБРАЖЕНИЯ ДЛЯ ВЫБОРА</p>
            <ul class="car_types">
                <li class="active"><i class="fas fa-car"></i> Легковые</li>
                <li>
                    <i class="fas fa-truck" style="transform: rotateY(180deg);"></i> Грузовые
                    <p class="soon">Скоро!</p>
                </li>
                <li>
                    <i class="fas fa-bus-alt"></i> Спецтехника
                    <p class="soon">Скоро!</p>
                </li>
            </ul>
            <!-- /.car_types -->
            <div class="logos">
                @foreach($marks as $mark)
                    <a href="#x" class="logo-mini" onclick="popupModels(1, this, 'car')">
                        <div class="img"><img src="{{ asset($mark->logo) }}"></div>
                        <p class="{{$mark->title}}">{{$mark->title}}</p>
                    </a>
                @endforeach
            </div>
            <!-- logos -->
            <div class="catalog_wrapper">
                <div class="catalog">

                </div><!-- catalog-->
            </div> <!-- catalog_wrapper-->
        </div>
    </section>

    <div class="popup-bg" id="popup-bg">
        @component('components.popups.transport_in_stock', ['popup_id' => 1])@endcomponent
    </div>
@section('main_script')
<script type="text/javascript" defer>

var form_transport = {
    'clear' : {
        'car' : [],
    },
    'add' : {
        'car' : [],
    },
};

// ACT
$('.catalog, .popular').on('click', 'li', renderModels);
$('.logos').on('click', '.logo-mini', renderModels);
$('#undo_model').on('click', function () {
    helpers.undo_models(form_transport['add']['car']);
});

getCars(laroute.route('shop.profile.transport-in-stock.available'),
    laroute.route('transport.cars.get-marks'),
    'popupModels(1, this, "car")');

$(document).click(function () {
    console.log(form_transport);
});

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
    var year_of_issue_from= {};
    var year_of_issue_before = {};

    axios({url: laroute.route('shop.profile.transport-in-stock.available'), method: 'post', data: $mark})
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
            window.$marksAvailable = [];
            let logos = [];

            if (carsAvailable.data.length == 0) return;

            for (let i = 0; i < carsAvailable.data.length; i++) {
                window.$marksAvailable.push(carsAvailable.data[i].mark);
            }

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
function popupModels(nm, e, type_tranport) {
    helpers.popup(nm, e)
    .then((data) => {
        let clearTransport = {
            'mark': $(data.e).text().trim()
        };
        form_transport['clear'][type_tranport].push(clearTransport);
    })
    .catch(error => {
        form_transport['add'][type_tranport] = [];
        form_transport['clear'][type_tranport] = [];
    });
}
function popupRegions(nm, e) {
    helpers.popup(nm, e)
    .then(data => {

    })
    .catch(error => {

    });
}

function save_transport_fetch_data(){
    axios({
        url: '{{route('shop.profile.transport-in-stock.store')}}',
        method: 'post',
        data: form_transport
    })
    .then(response => {
        helpers.popup(-1);
        form_transport['add']['car'] = [];
        form_transport['clear']['car'] = [];
        getCars(laroute.route('shop.profile.transport-in-stock.available'),
            laroute.route('transport.cars.get-marks'),
            'popupModels(1, this, "car")');
    });
}


</script>
@endsection
    
@endsection
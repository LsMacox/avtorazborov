@extends('layouts.user.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-1">
                    <a href="{{ URL::previous() }}" class="text-secondary" style="font-size: 28px;"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
                <div class="col-10">
                    <p class="m-0 text-dark text-center proposal_p">Контакты авторазборки</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-12 col-md-3 p-3">
                <div class="image-cropper mx-auto">
                    @php $avatar = $shop_media->where('designation', 'avatar')->first() @endphp
                    <img @if(isset($avatar))
                         src="{{ asset('storage/images/smalls/100x100/'.$avatar->name) }}" @else
                         src="{{ asset('images/avatar.png') }}" @endif alt="{{ $avatar->name ?? ''}}" width="100%" id="avatar" class="avatar-image">
                </div>
            </div>

            <div class="col-12 col-md-9 p-3">
                <div class="owl-carousel">
                    @php $gallery = $shop_media->where('designation', 'gallery')->first() @endphp
                    @if(isset($gallery))
                        @foreach( $gallery->name as $name)
                            <a data-fancybox="gallery" href="{{ asset('storage/images/originals/' . $name) }}"><img src="{{ asset('storage/images/originals/' . $name) }}"/></a>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-6 p-md-3 user-settings-groups">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Название</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Название" value="{{ $shop_setting->name }}" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Город</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Город" value="{{ $shop_setting->city ?? '' }}" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Адрес</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Адрес" value="{{ $shop_setting->address ?? '' }}" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">E-mail</span>
                    </div>
                    <input type="email" class="form-control" placeholder="E-mail" value="{{ $shop_setting->email ?? '' }}" readonly>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Телефон</span>
                    </div>
                    <input type="text" class="form-control" value="{{ phone_number(auth()->user()->login) }}" disabled>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="line-height: 0.8">Городской<br>телефон</span>
                    </div>
                    <input type="tel" class="form-control" value="{{ $shop_setting->phone }}" readonly>
                </div>
            </div>

            <div class="col-12 col-md-6 p-md-3">
                <div class="row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #f6bf00;">Описание</span>
                            </div>
                            <textarea class="form-control"  readonly style="resize: none;height: 200px;">{{ $shop_setting->description ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="work-time">
                            <div class="header">График работы</div>

                            <div class="body">
                                <div class="row seven-cols">
                                    <div class="col-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Mo" name="days[Mo]" value="Mo" @if(!empty($shop_setting->schedule->working_days) && $shop_setting->schedule->working_days['Mo']) checked @endif>
                                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="Mo">Пн</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Tu" name="days[Tu]" value="Tu" @if(!empty($shop_setting->schedule->working_days) && $shop_setting->schedule->working_days['Tu']) checked @endif>
                                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="Tu">Вт</label>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="We" name="days[We]" value="We" @if(!empty($shop_setting->schedule->working_days) && $shop_setting->schedule->working_days['We']) checked @endif>
                                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="We">Ср</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Th" name="days[Th]" value="Th"  @if(!empty($shop_setting->schedule->working_days) && $shop_setting->schedule->working_days['Th']) checked @endif>
                                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="Th">Чт</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Fr" name="days[Fr]" value="Fr" @if(!empty($shop_setting->schedule->working_days) && $shop_setting->schedule->working_days['Fr']) checked @endif>
                                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="Fr">Пт</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Sa" name="days[Sa]" value="Sa" @if(!empty($shop_setting->schedule->working_days) && $shop_setting->schedule->working_days['Sa']) checked @endif>
                                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="Sa">Сб</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Su" name="days[Su]" value="Su"  @if(!empty($shop_setting->schedule->working_days) && $shop_setting->schedule->working_days['Su']) checked @endif>
                                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="Su">Вс</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="row seven-cols">
                                    <div class="col-5">
                                        <div class="time">
                                            <label for="start-weekdays">с</label>
                                            <input type="text" id="start-weekdays" name="start_weekdays" value="{{ $shop_setting->schedule->times_work['start_weekdays'] ?? old('start_weekdays') }}">
                                            <label for="end-weekdays">до</label>
                                            <input type="text" id="end-weekdays" name="end_weekdays" value="{{ $shop_setting->schedule->times_work['end_weekdays'] ?? old('end_weekdays') }}">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="time">
                                            <label for="start-weekends">с</label>
                                            <input type="text" id="start-weekends" name="start_weekends" value="{{ $shop_setting->schedule->times_work['start_weekends'] ?? old('start_weekends') }}">
                                            <label for="end-weekends">до</label>
                                            <input type="text" id="end-weekends" name="end_weekends" value="{{ $shop_setting->schedule->times_work['end_weekends'] ?? old('end_weekends') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-3">
                <div id="map" style="width: 100%; height: 450px;"></div>
            </div>
        </div>
    </div>

@endsection

@section('main_style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" />
@endsection

@section('main_script')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=5758d8fb-2a02-4b79-8bdd-8baa549004e9" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel({
                margin:10,
                autoHeight: true,
                nav: true,
                responsive : {
                    0: {
                        items: 1,
                        loop: $('.owl-carousel .slide').length > 1 ? true : false,
                    },
                    480: {
                        items: 2,
                        loop: $('.owl-carousel .slide').length > 2 ? true : false,
                    },
                    768: {
                        items: 3,
                        loop: $('.owl-carousel .slide').length > 3 ? true : false,
                    },
                    1200: {
                        items: 4,
                        loop: $('.owl-carousel .slide').length > 4 ? true : false,
                    }
                }
            });


            ymaps.ready(init);

            function init() {
                var myMap = new ymaps.Map('map', {
                    zoom: 9
                });

                // Поиск координат центра Нижнего Новгорода.
                ymaps.geocode('{{ $gallery->city . ', ' . $gallery->address }}', {
                    results: 1
                }).then(function (res) {
                    // Выбираем первый результат геокодирования.
                    var firstGeoObject = res.geoObjects.get(0),
                        coords = firstGeoObject.geometry.getCoordinates(),
                        bounds = firstGeoObject.properties.get('boundedBy');

                    firstGeoObject.options.set('preset', 'islands#darkBlueDotIconWithCaption');
                    firstGeoObject.properties.set('iconCaption', firstGeoObject.getAddressLine());

                    myMap.geoObjects.add(firstGeoObject);
                    myMap.setBounds(bounds, {
                        checkZoomRange: true
                    });
                });

                myMap.behaviors.disable('scrollZoom');
            }

        });


    </script>
@endsection
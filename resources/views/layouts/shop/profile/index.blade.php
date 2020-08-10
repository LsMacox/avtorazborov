@extends('layouts.shop.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-sm-6">
                    <p class="m-0 text-dark text-center proposal_p">Настройки</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <form action="{{route('shop.profile.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-12 col-md-6 p-md-3 order-md-2">
                    <div class="row @error('avatar') is-invalid @enderror">
                        <div class="col-3">
                            <div class="image-cropper mx-auto">
                                @php $avatar = $shop_media->where('designation', 'avatar')->first() @endphp
                                <img @if(isset($avatar))
                                    src="{{ asset('storage/images/smalls/100x100/'.$avatar->name) }}" @else
                                    src="{{ asset('images/avatar.png') }}" @endif alt="{{ $avatar->name ?? ''}}" width="100%" id="avatar" class="avatar-image">
                            </div>
                        </div>
                        <div class="col-9 d-flex align-content-center flex-wrap flex-row">
                            <input type="file" id="choice-ava" class="d-none" accept="image/*" name="avatar">
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('choice-ava').click()">Загрузить логотип или фото</button>
                            <span>jpeg, png 300x300px размер до 1мб </span>

                            @error('avatar')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-12 mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: #f6bf00;">Описание</span>
                                </div>
                                <textarea class="form-control" name="description">{{ $shop_setting->description ?? old('description') }}</textarea>
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

                        <div class="col-12 text-center mt-3">
                            Добавьте несколько фото авторазборки (необязательно)
                        </div>
                        @php $gallery = $shop_media->where('designation', 'gallery')->first() @endphp
                         @for($i=0; $i<6; $i++)
                            <div class="col-12 col-md-4 mt-2">
                                <input type="file" id="choice-ava" class="d-none gallery" accept="image/x-png,image/jpeg" name="gallery-images[]" >
                                <img src="{{ isset($gallery->name['img_'.$i]) ? asset('storage/images/originals/'.$gallery->name['img_'.$i]) : asset('images/empty-photo.png') }}" alt="" width="100%" class="gallery-img">
                            </div>
                        @endfor

                    </div>
                </div>

                <div class="col-12 col-md-6 p-md-3 user-settings-groups order-md-1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Название</span>
                        </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Название" name="name" value="{{ $shop_setting->name ?? old('name') }}" required>
                        
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Город</span>
                        </div>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" placeholder="Город" name="city" value="{{ $shop_setting->city ?? old('city') }}">
                        
                        @error('city')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Адрес</span>
                        </div>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Адрес" name="address" value="{{ $shop_setting->address ?? old('address') }}">
                        
                        @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">E-mail</span>
                        </div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email" value="{{ $shop_setting->email ?? old('email') }}" required>

                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Телефон</span>
                        </div>
                        <input type="tel" class="form-control" placeholder="_ (___) ___-__-__" value="{{ phone_number(auth()->user()->login) }}" disabled>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="line-height: 0.8">Городской<br>телефон</span>
                        </div>
                        <input type="text" id="phone_profile" class="form-control @error('phone') is-invalid @enderror" placeholder="_ (___) ___-__-__" name="phone" value="{{ $shop_setting->phone ?? old('phone') }}">

                        @error('phone')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="checkboxes">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="email_notify" name="email_notify" @if(isset($shop_setting->email_notify) && $shop_setting->email_notify==1) checked @endif @if(old('email_notify')) checked @endif>
                            <label class="custom-control-label font-weight-bold mb-3" style="font-size: 14px;" for="email_notify">Получать уведомления о новых сообщениях на почту</label>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input mb-3" id="policy" name="policy" required @if(\Cookie::get('policy')) checked @endif>
                            <label class="custom-control-label font-weight-bold" style="font-size: 14px;" for="policy">Нажимая на кнопку “Сохранить”, я соглашаюсь на обработку моих персональных данных, передачу их авторазборкам (магазинам) и ознакомлен(а) с политикой конфиденциальности</label>
                        </div>
                    </div>

                    @if(Session::has('success'))
                        <div class="alert alert-primary mt-3">{{ Session::get('success') }}</div>
                    @endif

                    <div class="col-12">
                        @if($errors->any())
                            <div class="alert alert-danger mt-3">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-primary mt-3 w-100">Сохранить</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('main_script')
    <script>
        $(document).ready(function () {
            $('.time input[type=text]').mask('00:00', { placeholder: "00:00" });
            $('#phone_profile').mask('+7 (000) 000-00-00', { placeholder: "+7 (___) __-__-__" });
        });

        function readURL(input, img) {
            if (input.files && input.files[0]) {
                if(input.files[0].size > 1000000){
                    alert('Максимальный размер файла 1мб');
                    return false;
                }

                let reader = new FileReader();

                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#choice-ava').change(function () {
            readURL(this, $('#avatar'));
        });

        $('.gallery-img').on('click', function () {
            $(this).parent().find('input[type=file]').click();
        })

        $('input.gallery').change(function () {
            readURL(this, $(this).parent().find('img'));
        })
    </script>
@endsection
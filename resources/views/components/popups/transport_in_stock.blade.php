<div class="popup popup_cars" id="popup{{$popup_id}}">
    <div class="content">
        <form action="{{route('shop.profile.transport-in-stock.store')}}" method="post" id="main_form">
            @csrf
            <div id="ajaxCatalog">
                <div class="row">
                    <div class="col-md-6 block_1_info">
                        <div class="close" onclick="popupModels(-1, this, 'car')"><i class="fas fa-arrow-circle-right"></i></div>
                        <div class="block_info_mark">
                            <p><strong>Вы выбрали:</strong></p>
                            <p class="model">Toyota</p>
                            <p><strong>Выберите модель авто:</strong></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p_info_mark">
                            <p>Выберите модели и год выпуска
                                автомобилей имеющихся в наличии</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div id="renderModels">
                </div>
                <div class="setting_btn">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="#x" class="btn_site" class="btn_close_setting" id="undo_model"><i class="fas fa-undo" style="margin-right: 5px;margin-left: 4px;margin-top: 1px;"></i>Очистить</a>
                        </div>
                        <div class="col-md-3">
                            <a href="#x" class="btn_site" onclick="popupModels(-1, this, 'car')" class="btn_close_setting"><i class="fas fa-arrow-circle-left"></i>Вернуться</a>
                        </div>
                        <div class="col-md-6">
                            <div class="profile__block">
                                <a onclick="save_transport_fetch_data()" href="#x" class="btn_save btn_site"><i class="fas fa-cogs"></i>Сохранить изменения</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

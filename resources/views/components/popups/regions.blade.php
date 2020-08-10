<div class="popup popup_db popup_cities" id="popup{{$popup_id}}">
    <div class="popup_db_title">
        <p>Выберите из каких регионов РФ вы хотите получать заявки</p>
        <a href="#x" class="close" onclick="popupRegions(-1)">×</a>
    </div>
    <div class="popup_db_content">
        @foreach($regions as $region)
            <div class="popup_db_block">
                <a href="#" class="popup_db_sub_title">{{$region->title}}</a>
            </div>
        @endforeach
    </div>
</div>
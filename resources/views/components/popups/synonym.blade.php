<div class="popup popup_db popup_synonym" id="popup{{$popup_id}}">
    <div class="popup_db_title">
        <p>Выберите интересующую запчасть</p>
        <a href="#x" class="close" onclick="popupRegions(-1)">×</a>
    </div>
    <div class="popup_db_content">
        @foreach($synonyms as $synonym)
            <div class="popup_db_block">
                <a href="#" class="popup_db_sub_title">{{$synonym->name}}</a>
            </div>
        @endforeach
    </div>
</div>
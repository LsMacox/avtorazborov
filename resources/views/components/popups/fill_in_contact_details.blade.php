<div class="popup popup_fill_profile" id="popup{{$popup_id}}">
    <div class="popup_fill_profile_head">
        <img src="{{ asset('images/email-logo.jpg') }}" class="logo" alt="logo">
        <a href="#x" class="close" onclick="helpers.popup(-1)">×</a>
    </div>
    <div class="popup_fill_profile_body">
        <p><strong>Заполните контакные данные</strong> о вашем</p>
        <p>авторазборе или автомагазине, <strong>что бы увидеть</strong></p>
        <p><strong>полные номера телефонов в</strong> заявках на поиск</p>
        <p>запчастей</p>
    </div>
    <div class="popup_fill_profile_footer">
        <a href="{{ route('shop.profile.index') }}">Заполнить контактные данные</a>
    </div>
</div>
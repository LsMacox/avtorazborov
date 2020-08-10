<div class="popup popup_alerts" id="popup{{$popup_id}}">
    <div class="popup_alerts_head">
        <img src="{{ asset('images/email-logo.jpg') }}" class="logo" alt="logo">
        <a href="#x" class="close" onclick="popupAlert(-1)">×</a>
    </div>
    <div class="popup_alerts_body">
        <p>Проверочное письмо отправлено на почту
        <strong></strong>
        </p>
        <p>
        Просим посмотреть почту и потвердить, что
        письмо дошло до вас.</p>
    </div>
    <div class="popup_alerts_footer">
        <button class="did_not_come" onclick="email_not_delivered_fetch_data()">Письмо не пришло</button>
        <button class="success" onclick="confirmed_alert_fetch_data()">Проверочное письмо получено</button>
    </div>
</div>
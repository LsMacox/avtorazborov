<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторазборов.рф</title>
</head>
<body>
<h4>Вы будете перенапрвлены на страницу заявок через <span id="time"></span></h4>
<script>
    var i = 8;

    function time(){
        document.getElementById("time").innerHTML = i;//визуальный счетчик
        i--;//уменьшение счетчика
        if (i < 0) location.href = '{{route('shop.proposal.index')}}';//редирект
    }
    time();
    setInterval(time, 1000);
</script>
</body>
</html>
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## О проекте 
Авторазборов - этот проект нацелен на обратную связь авторазборок/магазинов с пользователями. 
Пользователи кидают заявку в личном кабинете. Далее Авторазборки могут искать интересующие их заявки в ленте. 
Проект разработан на фреймворке laravel + vue.

## Руководители и спонсоры 
- [Антон Теплов](https://vk.com/tony.teplov)
- [Юрий Семенов](https://vk.com/id269416169)
- Неизвестный

## О сайте
Доступы к pusher, sms.ru и т.д писать [Антон Теплов](https://vk.com/tony.teplov)<br>
Файлы в resources/sass не актуальны!<br>
Стили прописывать в public/css<br>
Доступ к laravel-debugbar в app/Http/Middleware/DebuggerLimit.php<br><br>
Логины и пароли от различных ролей:
1) Пользователь - логин: 70000000000 пароль: secret
2) Авторазборка - логин: 71111111111 пароль: secret
3) Администратор - логин: 7999999999 пароль: secret

## Установка
1) Скопируйте проект:
```
git remote add origin https://github.com/LsMacox/avtorazborov.git
git pull
```
2) Создайте .env и отредактируйте
3) Настройте проект:
```
npm install | yarn install
composer install
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan key:generate
php artisan config:cache
php artisan migrate
php artisan db:seed
```
Просьба не работать с основной (master) веткой.
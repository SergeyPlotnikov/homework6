# Binary Studio Academy 2018

## Laravel CRUD

### Цель

Ознакомиться с основами фреймворка Laravel: Routes, Middleware, Controllers.
Научиться писать простое CRUD приложение с помощью фреймворка.

### Установка

```
git clone <link to repositry>
cd <repository_name>
composer install
cp .env.example .env
php artisan key:generate
```

Также рекомендуется использовать Homestead для поднятия приложения.

### О задании

Представьте себе что Вам необходимо написать Backend часть сервиса для работы с электронными валютами. 
Вам необходимо написать CRUD (create, read, update and delete) логику для управления записями с данными о валютах.

### Задание #1

Реализовать класс `Currency`.

Реализовать интерфейс `CurrencyRepositoryInterface`. 

Реализовать API для получения списка всех АКТИВНЫХ (active=true) в системе е-валют. Формат возвращаемых данных: JSON.
Поля данных которые необходимо вернуть для каждой из валют: 'id', 'name', 'short_name', 'actual_course', 
'actual_course_date', 'active'.

* Route: GET /api/currencies

### Задание #2

Реализовать API для получения детальной информации о конкретной е-валюте. Формат возвращаемых данных: JSON.
Поля данных, которые необходимо вернуть в списке валют: 'id', name', 'short_name', 'actual_course', 'actual_course_date', 'active'.

* Route: GET /api/currencies/{id}
* В случае запроса информации о валюте, id которой отсутствует, необходимо вернуть Error HTTP Response с кодом 404.

### Задание #3

Реализовать API для администратора по управлению базой е-валют с помощью Resource Controller. Формат возвращаемых данных: JSON.
Поля данных, которые необходимо вернуть в списке валют: 'id', name', 'short_name', 'actual_course', 'actual_course_date', 'active'.

* Route prefix: /api/admin/currencies
* Действия, которые может совершать администратор: получение списка всех е-валют (включая неактивные),
просмотр информации о определенной е-валюте, добавление, изменение информации, удаление;
* В случае запросов c `/{id}` который отсутствует, необходимо вернуть Error HTTP Response с кодом 404.

### Задание #4

* Реализовать маршрут `/admin/currencies` и отрендерить список всех валют.
* Реализовать middleware `RedirectToCurrenciesMiddleware`, который по маршруту `/admin`, будет перенаправлять пользователя на `/admin/currencies`. 

Проверить себя можно с помощью подготовленых тестов выполнив в консоли команду в корне проекта:

```
./vendor/bin/phpunit
./vendor/bin/phpunit --testsuite task1
```

**Репозиторий форкать нельзя.**
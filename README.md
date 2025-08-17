# REST API приложение для справочника Организаций, Зданий, Деятельности

## Что сделано
- REST API
- Упаковано в Docker
- Настроил  CI
- Написаны тесты
- Документация Swagger
- Поиск с использованием Scout, поисковой движок - Typesense

## Установка
- Клонируем репозиторий `git clone git@github.com:moonpie510/rest_api_luna.git`
- Переходим в папку с проектом и создаем .env на основе .env.example
- Запускаем докер `docker compose up -d --build`
- Заходим в контейнер `docker exec -it luna_php-fpm bash`
- Запускаем `npm i`
- Запускаем `composer install`
- `php artisan storage:link`
- `chmod 777 -R ./storage`
- Генерируем ключ для приложения `php artisan key:generate`
- Запускаем миграции с сидами `php artisan migrate --seed`
- Создайте БД для тестов `php artisan test:create-schema`
- Наполнем индекс для поиска данными `php artisan search:update-index`
- Запускаем `npm run dev`

## Тесты
Написаны future и unit тесты.

Перед запуском тестов необходимо создать тестовую БД `luna_test`.

Команда для создания тестовой БД:
```php
php artisan test:create-schema
```

## Документация API
Проект задокументирован с помощью Swagger. Чтобы увидеть документацию, откройте адрес `/api/documentation`.

Команда для генерации документации:
```php
php artisan l5-swagger:generate
```

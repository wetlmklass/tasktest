1. Создание окружения для приложения:
  команда создает и запускает стэк из docker-compose.yml: ./vendor/bin/sail up

2. раздаем права на папки sudo chmod -R 777 storage/logs storage/framework/cache/data

3. В контейнере приложения (tasktest-laravel.test-1) выполнить:
  Команда загрузки миграций: php artisan migrate
  Загрузка тестовых данных:
  php artisan db:seed --class=UsersSeeder
  php artisan db:seed --class=BalanceSeeder
  php artisan db:seed --class=TransactionSeeder

4. Вызов методов api через curl:
  Метод запроса баланса: curl http://localhost/api/balance/2
  Метод запроса статистики c сортировкой по полю date (по убыванию): curl -X POST http://localhost/api/transactions -H 'Content-Type: application/json' -d '{"from": "1995-03-15 00:00:00", "to": "2000-08-07 00:00:00"}'
  Метод изменения баланса: curl -X POST http://localhost/api/balance -H 'Content-Type: application/json' -d '{"id": "2", "sum": "100"}'

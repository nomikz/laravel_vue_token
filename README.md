# laravel & vue 

Stack: 
Backend: php 7.3+, laravel 8, mysql/pgsql.
Frontend: vue 2+, vuetify (css framework).

Я разделил фротенд от бекенда.

Апи в папке api_laravel. 
Клиент в папке client_vue.

Авторизация через токены и хранится в localstorag 😅😅 

Чтобы это запустить на сервере нужно будет прописать конфиги и для фронта и для бека.

Чтобы запустить локально:

В корне client_vue:
```bash
npm install 
npm run serve
```

Это запустит сервер на localhost:8080 (если порт не занят).  


В корне api_laravel:

- Установить зависимости
```bash
composer install  
```

- Создать для проекта бд 

- создать .env и сгенерировать ключь
```bash
cp .env.example .env
php artisan key:generate  
```
- указать доступы к бд
- запустить миграции 
- запустить миграции 
 ```bash
 php artisan migrate  
 ```

- прогнать сидер для тестовых данных
```bash
 php artisan db:seed  
 ```

- Запустить тестовый сервер
```bash
 php artisan serve
 ```
 
 это запустит сервер на 8000 порту (если порт не занят). 
 !! очень важно чтобы сервер запустился на 8000 порту потому что порт захардкоден на фронтенде
 
 позже когда напишу docker-compose.yml можно будет вынести в .env
 
 Теперь в браузере можно открыть localhost:8080 (frontend server)

Во время сидинга данных мы создали тестового пользователя 
admin@ffins.kz
secretadminpass

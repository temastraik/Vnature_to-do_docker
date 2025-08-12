Общие положения функциональности:
- Веб-приложение для управления задачами.
- Все взаимодействие идет через API.
- Аутентификация не требуется.

Требования перед установкой
- Docker 20.10.0+
- Docker Compose 1.29.0+

Развертывание проекта:
1. Клонировать репозиторий:<br>
"git clone https://github.com/temastraik/Vnature_to-do_docker <br> cd vnature_to-to_project"

2. В каталоге backend создать .env на основе .env.example, отредактировать настройки базы данных по параметрам файла .env.docker из корня папки Vnature_to-do_docker

3. Запустить docker-контейнеры <br>
"docker-compose up -d"

4. Установить и запустить необходимое PHP окружение <br>
"docker-compose exec app composer install <br> docker-compose exec app php artisan migrate <br> docker-compose exec app php artisan key:generate"

5. В терминале установить необходимое JavaScript окружение <br>
"docker-compose exec app npm install"

6. Перейти по следующим адрес:
phpMyAdmin будет доступен по адресу: http://localhost:8080
Приложение будет доступно по адресу: http://localhost:8000
Работа с API будет доступна по адресу: http://localhost:8000/api/tasks

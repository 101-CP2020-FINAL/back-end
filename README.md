# СУ «РОК»: бэкенд & сервисы

В данном репозитории представлены (всё можно посмотреть в docker/docker-compose.yml):
* Back-end приложение с API и бизнес-логикой;
* Эксплуатационная админ.панель;
* Сервис распознования речи;
* БД;
* Сервис нотификаций;
* Вспомогательные сервисы.

## 1. Создайте файл **.env** со следующими переменными
* ENV={Development|Production}
* VOLUME={../app|data-volume} *data-volume для Production*
* APP_PORT={port for application}
* CENTRIFUGO_PORT={port for centrifugo}
* DB_PORT={port for database}
* DB_HOST=db
* DB_USER={user for database}
* DB_PASSWORD={password for database}
* DB_NAME={name for database}

## 2. Запустите контейнер  
* Всё запускать из корневой папки проекта *

Для деплоя
```
docker-compose -f docker/docker-compose.yml up -d --build
docker exec -it cp2020-final-backend-php sh -c "php yii migrate --interactive=0"
```
Для локальной разработки
```
sh run-dev.sh
```

## 3. Пути для просмотра
```
http://localhost:${APP_PORT}/admin - эксплутационная админ.панель
http://localhost:${APP_PORT}/api/client/v1    - API для МП и SPA
http://localhost:${APP_PORT}/api/internal/v1  - API работы с сервисами
```

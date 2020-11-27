FROM yiisoftware/yii2-php:7.4-fpm

COPY app /app

WORKDIR /app
RUN composer install

ARG ENV
ARG DB_NAME
ARG DB_HOST
ARG DB_USER
ARG DB_PASSWORD

RUN php init --no_interactive --env=$ENV --db_host=$DB_HOST --db_name=$DB_NAME --db_user=$DB_USER --db_password=$DB_PASSWORD
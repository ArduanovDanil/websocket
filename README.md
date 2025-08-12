# websocket
## Test app for websocket integration

Выполнить последовательно команды из корня проекта:

```
docker compose run --rm php composer update --prefer-dist
```

```
docker compose run --rm php composer install
```

```
docker compose up -d
```

```
docker compose run --rm php yii migrate   
```

1. Открыть админку для  `Centrifugo` по адресу http://127.0.0.1:9000/, войти с паролем `QNmueHj84DaAJQEqx4ysWQ`
1. Открыть страницу авторизации http://127.0.0.1:8000/site/login  
1. Зайти под  `demo/demo`  
1. Скопировать токен в поле `token` во `views/site/centrifugo.php`
1. Открыть http://127.0.0.1:8000/site/centrifugo - данные о подключении должны сохраниться в таблицу `connections` (подключение к БД `jdbc:postgresql://localhost:5433/yii2`, логин/пароль `postgres/postgres`)
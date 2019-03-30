#scandir-yii2

Данная программа работает так же как и scandir только исполнена на yii2 - фреймворке.

При первом посещении страницы считывает файлы и папки из корня сайта и записывает их в базу данных и далее выводит эти данные в таблицу. При обновлении страницы данные для таблицы берутся уже из бд игнорируя ситуацию в корне сайта. Для обновления данных есть кнопка которая инициирует процесс считывания и записи информации в базу данных.

Перед первым запуском необходимо выполнить данные скрипты в базе данных mysql:

CREATE DATABASE IF NOT EXISTS mydb DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci; USE mydb;

DROP TABLE IF EXISTS dirfiles; CREATE TABLE IF NOT EXISTS dirfiles ( id int(11) NOT NULL AUTO_INCREMENT, filename varchar(255) DEFAULT NULL, filesize varchar(255) NOT NULL, filetype varchar(255) DEFAULT NULL, filetime timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), PRIMARY KEY (id) ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=cp1251;

Далее необходимо поменять настройки подключения к базе данных по пути корень_сайта/config/db.php

После выполнения операций можно открывать страницу.

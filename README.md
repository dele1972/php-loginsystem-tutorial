# php-loginsystem-tutorial
Project generated during external Tutorial, with own modification

Original Tutorial: [How To Create A Login System In PHP For Beginners | Procedural MySQLi | 2018 PHP Tutorial | mmtuts]( https://youtu.be/LC9GaXkdxF8) (10.10.2018)

   - ~~Current Position: https://youtu.be/LC9GaXkdxF8#t=1h43m09s (error handling)~~
   - ~~Current Position: https://youtu.be/LC9GaXkdxF8#t=1h13m25s (login/logout)~~
   - ~~Current Position: https://youtu.be/LC9GaXkdxF8#t=44m21s~~

# Setting up the development environment

## Docker for [nginx](https://unit.nginx.org/) Webserver, [PHP](https://www.php.net/) Server, [MariaDB](https://mariadb.org/) mySQL Server

### Install Docker

1. `sudo apt-get update && sudo apt-get upgrade`

2. `sudo apt install docker docker-compose`

3. `sudo apt autoremove`
   - optional

4. `docker image ls`
   - to check a known failure/bug; if this error occurs `n/docker.sock: connect: permission denied`:

   4.1 `sudo groupadd docker`

   4.2 `sudo usermod -aG docker $USER`
      - add current user to group docker

   4.3 `newgrp docker`

   4.4 `docker image ls`
      - check if the fix works

### Create a `docker-compose` configuration

1. see https://github.com/dele1972/docnt-ngpm

2. change DB Password on `docker/docker-compose.yml`, line 42:

   - `MYSQL_PASSWORD=secret`

3. insert following line to `docker/php-fpm/Dockerfile`, in line 15 (to enable mysqli):

   - `RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli`
   - because this tutorial is using mysqli instead of pdo
   - see pro/con here: https://code.tutsplus.com/tutorials/pdo-vs-mysqli-which-should-you-use--net-24059

3. remove the folder `public`

4. ... make instead a `public` symbolic link to this project directory

   - ln -s ~/dev/php-loginsystem-tutorial ~/dev/docnt-ngpm/docker/public
   - https://stackoverflow.com/a/1951752

## Create DB and Table


```(shell)
docker exec -it docker_mysql_1 bash

mysql --user=root --password=docker

show databases;

create database loginsystemtut default character set utf8 default collate utf8_general_ci;

use loginsystemtut;

create table users ( idUsers int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, uidUsers tinytext NOT NULL, emailUsers tinytext NOT NULL, pwdUsers longtext NOT NULL );
```

### Some command line actions to 'admin'

| command | comment |
| --- | --- |
| `docker exec -it docker_mysql_1 bash` | start **mysql bash** (docker) |
| `mysql --user=root --password=docker` | open **mariaDB client** |
| `show databases;` | **show** all **databases** |
| `use loginsystemtut;` | **select a database** |
| `describe users;` | **show table structure** |
| `SELECT * FROM users;` | **show all entries** of table user|

* https://mariadb.com/kb/en/basic-sql-statements/
* https://www.hostwinds.com/guide/how-to-use-mysql-mariadb-from-command-line/

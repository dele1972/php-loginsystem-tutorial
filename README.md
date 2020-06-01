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

2. insert folloing section before the `mysql/environment`section (should be L`39`):

```
     command:
      - --character-set-server=utf8mb4
      - --collation-server=utf8mb4_unicode_ci
      - --skip-character-set-client-handshake
```

3. change DB Password on `docker/docker-compose.yml`, line 42 (should be after inserting the `command` section L`46`):

   - `MYSQL_PASSWORD=secret`


4. [optional] add a volume for the mysql service to keep db changes persistant by adding following to the `mysql/volumes` section on`docker/docker-compose.yml`, line 52:

   - `- ../data/mysql:/var/lib/mysql`


5. [optional] change entire content of `docker/mysql/data.sql` to create the `users` table on start-up:

```sql
-- Tutorial DB (for MariaDB)
--
-- Host: localhost    Database: loginsystemtut
-- ------------------------------------------------------

USE `loginsystemtut`;

--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `loginsystemtut`.`users` (
  `idUsers` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `uidUsers` TINYTEXT NOT NULL,
  `emailUsers` TINYTEXT NOT NULL,
  `pwdUsers` LONGTEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

6. insert following line to `docker/php-fpm/Dockerfile`, in line 15 (to enable mysqli):

   - `RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli`
   - because this tutorial is using mysqli instead of pdo
   - see pro/con here: https://code.tutsplus.com/tutorials/pdo-vs-mysqli-which-should-you-use--net-24059

3. remove the folder `public`

4. ... make instead a `public` symbolic link to this project directory

   - ln -s ~/dev/php-loginsystem-tutorial ~/dev/docnt-ngpm/docker/public
   - https://stackoverflow.com/a/1951752

## Create DB and Table

(only neccessary if not done by docker)

```shell
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
| `docker system df` | List images and containers |
| `docker ps -aq -f status=exited | xargs -r docker rm` | remove all docker container |
| `docker system prune -a` | remove any stopped containers and all unused images |


* https://mariadb.com/kb/en/basic-sql-statements/
* https://www.hostwinds.com/guide/how-to-use-mysql-mariadb-from-command-line/

<br>

## Register and Login with PHP and MySQL

<br><br>

Rename config.sample.php to config.php and edit it with your relevant data.

<br><br>

The following query will create the database and table:
```sh
CREATE DATABASE usersdb;

USE usersdb;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);
```

<br><br>

Test it on your home server or here -> https://filip-peev.com/simple-app/login.php
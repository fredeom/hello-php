# hello-php
Test page with filters and pagination on data retrieved from mysql database using php PDO

## Тестовое задание на должность стажёр PHP-разработчик

### Создать небольшой проект, используя
* php5
* MySql

### Проект должен включать в себя:
Базу данных mysql содержащую таблицу товаров, у товара есть признаки: артикул, наименование, производитель (бренд), тип, цвет, цена, скидка, дата добавления товара

### Необходимо реализовать отображение списка товаров на странице в табличном виде:
* в шапке списка должны отображаться наименования признаков товара
* список должен быть разбит на страницы (пагинатор). Количество отображаемых на странице записей имеет предустановленное значение 10.
* в списке должны отображаться все признаки товара
* сортировка списка - по умолчанию новые товары (по дате добавления) сверху, помимо этого необходимо реализовать возможность сортировки отдельно по каждому признаку товара, для этого наименования признаков в шапке необходимо сделать активными ссылками
* на странице должна отображаться форма фильтрации, содержащая поля "наименование", "бренд", "тип", "цена от", "цена до", "дата с", "дата по" и кнопку "искать". Необходимо реализовать возможность фильтрации отображаемых на странице записей в соответствии с указанными в форме значениями.

### Помимо этого необходимо реализовать скрипт, заполняющий тестовыми данными созданную таблицу товаров
(напр. л-123|товар1|бренд1|тип1|цвет|1000|0|2017-05-01 ),
#### необходимо создать 1000 товаров.

- - -
# Project progress
## Environment
* Windows XP
* [PHP 5.4.21](https://www.hosoft.ru/download/software/php/5.4.21)
* [Mini MySQL server](http://wiki.uniformserver.com/index.php/Mini_Servers%3A_MySQL_5.0.67_Portable)

### You will likely do following configurations:
* unzip php to e.g. 'c:\php'
* associate .php extension with php interpretator
```
shell> assoc .php=phpfile
shell> ftype phpfile="C:\php\php.exe" -f "%1" -- %~2
```
* add "c:\php" to windows PATH variable
* add ".PHP" to windows PATHEXT variable
* copy php.ini-development to php.ini
* in php.ini uncomment 'extension_dir = "ext"' and 'extension=php_pdo_mysql.dll'
* create 'www' folder and place following files there

## Files
* [db_info.php](db_info.php) - configures project's constants (such as number of rows per page)
* [recreate_test_db.php](recreate_test_db.php) - creates test database with 1000 records
* [index.php](index.php) - creates main page

## Run mini MySql and start php server
* goto path_to_mini_server_11 and double click on mysql_start.bat
  * start sql shell in case of troubleshooting ```mysql -u root --password=root```
* open console in 'www' folder and run ```php -S localhost:8080```
* open browser on 'localhost:8080'

## If you use standard mysql and non root user/password do following
shell> mysql -u root -p
```sql
create user 'testuser'@'localhost' identified by 'testpass';
create database dbtest;
grant all on dbtest.* to 'testuser';
```

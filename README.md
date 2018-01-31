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

## Create user and grant privileges on database
shell> mysql -u root -p
```sql
create user 'testuser'@'localhost' identified by 'testpass';
create database dbtest;
grant all on dbtest.* to 'testuser';
```

## Environment configuration in Ubuntu 14.04
```
shell> sudo add-apt-repository ppa:ondrej/php
shell> sudo apt-get update
shell> sudo apt-get -y install php5.6 php5.6-mbstring php5.6-cli php5.6-xsl php5.6-zip php5.6-common php5.6-curl php5.6-dev php5.6-fpm php5.6-gd php5.6-intl php5.6-json php5.6-mcrypt php5.6-mysql php5.6-odbc php5.6-pgsql php5.6-readline php5.6-xcache php5-xdebug nginx mysql-server
shell> sudo chown -R www-data: data
shell> sudo update-alternatives --set php-config /usr/bin/php-config5.6
shell> sudo update-alternatives --set phpize /usr/bin/phpize5.6
shell> sudo update-alternatives --set phar.phar /usr/bin/phar.phar5.6
shell> sudo update-alternatives --set phar /usr/bin/phar5.6
shell> sudo update-alternatives --set php /usr/bin/php5.6
shell> php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
shell> php composer-setup.php
shell> php -r "unlink('composer-setup.php');"
shell> php composer.phar create-project -sdev zendframework/skeleton-application helloworld
shell> cp composer.phar helloworld
shell> php composer.phar development-enable
shell> php composer.phar require doctrine/doctrine-orm-module
shell> php composer.phar require zendframework/zend-paginator
```

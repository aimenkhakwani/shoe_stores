# Local Shoe Store's

#### _A website to add local shoe stores and brands with a many-to-many relationship using MySQL, September 30, 2016_

#### By _**Aimen Khakwani**_

## Description

This is a dynamic website that demonstrates a MySQL many-to-many relationship.

## MySQL Commands
* mysql.server start
* mysql -uroot -proot
* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE stores (name VARCHAR (255), address VARCHAR (255), id   serial PRIMARY KEY);
* DESCRIBE stores;
* CREATE TABLE brands (name VARCHAR (255), id serial PRIMARY KEY);
* DESCRIBE brands;
* CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);
* DESCRIBE stores_brands;
* (start Apache) $ apachectl start
* (Create shoes_test database on phpmyadmin)

## Setup/Installation Requirements

* Clone the repository
* Using the command line, navigate to the project's root directory
* Install dependencies by running $ composer install
* Start MySQL by running the command $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
* Start Apache by running the command $ apachectl start
* Import the MySQL file from localhost:8080/phpmyadmin/
* Navigate to the /web directory and start a local server with $ php -S localhost:8000
* Open a browser and go to the address http://localhost:8000 to view the application

## Known Bugs

There are no known bugs at this time.

## Support and Contact Details

For questions or comments, please contact me through GitHub.

## Technologies Used

* _PHP_
* _Silex_
* _Twig_
* _Bootstrap_
* _MySQL_

### License

*This website is licensed under the MIT license.*  
Copyright (c) 2016 **_Aimen Khakwani_**

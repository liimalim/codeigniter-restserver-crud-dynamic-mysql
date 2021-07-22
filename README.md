# CodeIgniter RestServer CRUD Dynamic MySQL

Fully RESTful server implementation for CodeIgniter and makes it dynamic to create, read, update, delete for multiple tables using only one library, one configuration file and one controller.

## Requirements

- PHP 5.6 or greater
- CodeIgniter 3.1.11+

## Installation
- Clone this project
```sh
git clone https://github.com/liimalim/codeigniter-restserver-crud-dynamic-mysql.git
```

## Usage

- Create database `ci3_restserver_crud`
- Create table `customer`

```json
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
```
Note: If you add a table to your database, you must add your table name in the `application/controller/Portal.php` on line `15`
***
## API Reference

Here is a API Reference for use this API:

### GET

* `/table_name` will return the list of all customers
Example `http://domain/customer`
* `/table_name/id` will only return information about the customer with id = 1
Example `http://domain/customer/1`

### POST
This method serves to send data and save it to the database.
- URL`/table_name`
Example `http://domain/customer`
- Header
Content-Type: `application/json`
- Body
```
{
    "name":"tes name 2",
    "phone":"628987654300",
    "address":"Jawa Barat"
}
```

### PUT
This method serves to update the data in the database.
- URL`/table_name/id`
Ecample `http://domain/customer/1`
- Header
Content-Type: `application/json`
- Body
```
{
    "name":"tes name 2",
    "phone":"628987654300",
    "address":"Jawa Barat"
}
```

### DELETE
This method serves to delete existing data in the database.
- URL`/table_name/id`
Ecample `http://domain/customer/1`
***
## Donating

You can support the creator of this project through the link below

[![Support via PayPal](https://cdn.rawgit.com/twolfson/paypal-github-button/1.0.0/dist/button.svg)](https://www.paypal.me/liimalim/)
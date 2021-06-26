### PRODUCT CREATE/GET OPERATIONS FOR PRODUCTS WITH REST API

> Create and get operations for products using OOPS & REST API).

## Get started

1. Create a database named `catalog` in MySQL, then import `catalog.sql` file from the root folder.

2. Set database configuration in `config/configuration.php`

```
define('DBHOST', '127.0.0.1');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'catalog');
```

3. API endpoints

###### HOST = localhost/127.0.0.1
###### PROJECT_FOLDER_NAME = products-api

http://HOST/PROJECT_FOLDER_NAME/api/get-products.php?type=all

http://HOST/PROJECT_FOLDER_NAME/api/create.php


4. Import POSTMAN collection `Product - API.postman_collection.json`
# Setup and configurate for cloning project

This is an admin dashboard for management about category and affirmation. 

## Getting Started

These instructions will get you a copy of the project up and running on your web server.

### Prerequisites

*Note: If your server support **One-Click LEMP/LAMP stack installation**, you can continues to do the following steps. If your server **do not** support that, you have to **manually install NGINX, MySQL and PHP-FPM**. The following link will help you to install those applications*

https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04

### Server Configuration

* **Configuring SSH access**

For setting up SSH for connection to your web-server, you can follow the instruction from the following link

https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-16-04

* **Server Requirements**

This project is developed by Laravel 5.8, you need to make sure your server meets the following requirements from Laravel Offical website

https://laravel.com/docs/5.8/installation#server-requirements

* **Composer**

You will need `composer` to install of needed dependencies. If your server do not have `composer`, you can follow installation instruction from the following link

https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos

* **Configuring MySQL**

If you did not configure your MySQL before, you can follow the following link to create a new user with specific permissions to your database.

https://www.digitalocean.com/community/tutorials/how-to-create-a-new-user-and-grant-permissions-in-mysql

* **Configuring Web-server**

The following link will provide an example of NGINX configuration file for configuring your Web-server

https://laravel.com/docs/5.7/deployment#nginx
 
### Installing

* **Cloning the project**

 You can clone the project by using the following command in the Terminal

  `https://github.com/PhongNguyen512/affirmationclone.git`

* **Installing needed components** 

After cloning the project, you have to install all of needed components by using `composer`. You have to `cd` to the folder of the clone project, and run the following code

  `composer install`
  
*NOTE: After this point, you have to be inside the clone project folder to be able to do the following steps.*

* **Configurating .env file** 

Renaming the `.env.example` file to `.env`, and modify the value of 3 properties ( **DB_DATABASE, DB_USERNAME, DB_PASSOWRD** ) to appropriate with your database

* **Creating database table**

At first, you have to manually create a new database, and it must match the value of **DB_DATABASE** you set in `.env` file.

You can run the following code to create needed tables for the database

`php artisan migrate`

* **Initializing user data for login**

Run the following code in the Terminal to insert some User into the new database

``php artisan db:seed --class=UserSeeder``

After it inserted the user to the database, you can login to the `/admin` by using the following information
```
Email | Password . sa@gmail.com | 123456
```
* **Configuring the Directory Permissions**

After the above steps, you need to configure the permission of directories within the **storage** and the **bootstrap/cache**. Those directories should be writable by your Web-server.


## Built With

* [Laravel](https://laravel.com/docs/5.8) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management

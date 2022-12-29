# Task Menegement

A laravel project for managing tasks, it has the crud system (create, update, delete, and list) + other functionalities, such as sorting the tickets using drag and drop.

## Install

1) Run in your terminal:

``` bash
git clone https://github.com/ayoubmoumine/tasks-management
```

2) Set your database information in your .env file (use the .env.example as an example);


3) Run in your backpack-demo folder:
``` bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## After the installation

Once you open the project on your browser, you'll be able to see tha page that contains a list of projects listed inligne, by default you'll find 10 projects created randomly using the magical ####faker, under the first project you can find two tasks randomly created as well 


## Usage

1. You can create the tasks as much as you want, by typing the task name.
2. You can delete any task by clicking on the trash icon on the concerned task.
3. You can edit the task as well by clicking the Edit icon and preform the modifications.
4. You can sort the tasks the way you find it convenient, by simply drag it to the position you want and then drop it.



Note: In order to seed the database please go to the terminal and run ```php artisan db:seed```   
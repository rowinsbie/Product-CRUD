<p align="center"><img src="docs/images/sc.PNG" width="600"></p>


## Junior Dev Tech Exam

It's a simple CRUD web application developed using laravel with REST API integration for my application for Junior Web developer.

## Features
- Add New Product with file uploading
- Display Product information 
- Update product information
- deletion of the product


## Installation
<p>To start the installation, clone this repository to your local machine</p>

<code>git clone https://github.com/rowinsbie/Product-CRUD.git</code>
<p>After cloning the project, go to the project directory by running the command below</p>
<code>cd Product-CRUD/</code>
<p>Once you're already in the project directory, run the commands below</p>
<code>composer install</code>
<br /><code>npm install</code>
<br /><code>npm run dev</code>

## ENV. configuration
<p>create an .env file and copy the contents of .env.example</p>
<p align="center"><img src="docs/images/env.PNG" width="400"></p>
<p>In the .env, change the database configuration</p>
<p align="center"><img src="docs/images/env_db.PNG" width="400"></p>
<p>Generate APP_KEY with the command below</p>
<code>php artisan key:generate</code>

## Database creation
<p>Before you run this command, please make sure you've created a database and the .env is configured.</p>
<code>php artisan migrate</code>

## Launch
<p>To launch the application, run the command below</p>
<code>php artisan serve</code>
<p>go to your browser and paste url below</p>
<code>http://127.0.0.1:8000/</code>
<br /><br />
<br />
<br />
<br />





## Contact
<p>Seiki Rowins Bie - seikirowins.bie.srb@gmail.com</p>
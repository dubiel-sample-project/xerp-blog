# xerp-blog
Simple PHP Blog

PHP 7.4
MYSQL 5.7
NGINX 1.17.8 

## Overview

The blog is based on a MVC architecture with the following namespaces:

* Blog\Controller\
* Blog\Model\
* Blog\View\

The controllers are used to handle requests and retrieve Entities using the Models. 
The data is then passed onto the Views which render the output using partials.

## Installation

The architecture consists of three services (nginx, php and mysql) all managed by Docker. 

1. After checking out the repository, run `docker-compose up -d --build` from the main directory to create the service containers
2. The directory (/docker/mysql/data/) contains a sql file with dummy data which is automatically loaded
3. The root directory contains the index.php and all Blog related classes. All requests are routed through index.php and handled by the Bootstrap class 
4. After installation, the blog should be available at http://localhost:8001/
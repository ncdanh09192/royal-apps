# Laravel Demo README

This demo is built using Laravel, a popular PHP framework. It requires Docker to run the virtual machine environment.

## Installation

Before starting, please make sure you have Docker installed on your machine. You can download it from the official website: https://www.docker.com/products/docker-desktop

After installing Docker, please follow these steps:

1. Clone this repository to your local machine.
2. Navigate to the cloned directory in your terminal.
3. Run the command `./vendor/bin/sail up -d`. This will start the virtual machine.
4. Once the virtual machine is running, run the following commands to set up the necessary dependencies:
   - `./vendor/bin/sail migrate` to run the database migrations.
   - `./vendor/bin/sail composer install` to install PHP dependencies.
   - `./vendor/bin/sail npm install` to install front-end dependencies.
   - `./vendor/bin/sail run dev` to compile front-end assets.
   
After running these commands, you should be able to access the Laravel demo by visiting http://localhost in your web browser.
Please register an account by email and login to try the project

Please note that this demo is for educational purposes only and should not be used in production environments.

# Anikultura

A web application built in the Tailwind, Alpine.js, Laravel, Livewire (TALL) stack.
https://github.com/Radical-Doubting/anikultura-backend/actions/workflows/pr-title-check.yml/badge.svg

## Setup using XAMPP

* First, make sure that you are running the exact versions.
* If you are running a different version of a dependency, update them to our exact versions. Having different dependency versions can create problems for us later.

### Tooling Dependencies

| Dependency    | Version       | Command to Verify    |
| ------------- | ------------- | -----------------    |
| Composer      | 2.0.12        | `composer --version` |
| Node          | 15.14.0       | `node --version`     |
| NPM           | 7.7.6         | `npm --version`      |

### Main Dependencies (XAMPP 8.0.3)

| Dependency    | Version       | Command to Verify |
| ------------- | ------------- | ----------------- |
| PHP           | 8.0.3         | `php --version`   |
| MariaDB       | 10.4.18       | `mysql --version` |

* Clone the repository in your machine.
* Do `composer install`
* Do `npm install`
* Copy your `.env` from `.env.example`. Generate the Laravel app key.
* Done!

## Setup using Docker and Laravel Sail

Reference: https://laravel.com/docs/8.x/sail

* You need to have Ubuntu WSL2 distro. Download it from the Microsoft Store and up your dev folders in Ubuntu.
* Clone the repository in your Ubuntu dev folder.
* Have Docker Desktop running in the background.
* Navigate to the repository folder.
* Execute `docker run --rm \ -u "$(id -u):$(id -g)" \ -v $(pwd):/opt \ -w /opt \ laravelsail/php80-composer:latest \ composer install --ignore-platform-reqs`
* Navigate to the `smfi-crpm-app` folder then run `./vendor/laravel/sail/bin/sail build`
* After the image is built, run `./vendor/laravel/sail/bin/sail up`
* Open `anikultura` (which is in Ubuntu) using VS Code.
* Done

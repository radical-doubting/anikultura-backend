# SMFI Crop Monitoring App

A web application built in the Tailwind, Alpine.js, Laravel, Livewire (TALL) stack.

## Setup using XAMPP

* First, make sure that you are running the exact versions. If not, update them accordingly. 
Having different dependency versions can create problems for us later.

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

## Setup using Docker and Laravel Sail

* You need to have Ubuntu WSL2 distro. Download it from the Microsoft Store and up your dev folders in Ubuntu.
* Clone the repository in your Ubuntu dev folder.
* Have Docker Desktop running in the background.
* Navigate to the `smfi-crpm-app` folder then run `./vendor/laravel/sail/bin/sail build`
* After the image is built, run `./vendor/laravel/sail/bin/sail up`
* Open `smfi-crpm-app` (which is in Ubuntu) using VS Code.
* Done
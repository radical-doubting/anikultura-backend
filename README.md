# SMFI Crop Monitoring App

A web application built in the Tailwind, Alpine.js, Laravel, Livewire (TALL) stack.

## Setup using XAMPP

Tooling dependencies

| Dependency    | Version       |
| ------------- | ------------- |
| Composer      | 2.0.12        |
| Node          | 15.14.0       | 
| NPM           | 7.7.6         |

Main Dependencies

| Dependency    | Version       |
| ------------- | ------------- |
| PHP           | 8.0.3         |
| MariaDB       | 10.4.18       |

## Setup using Laravel Sail

Clone the repository in Ubuntu WSL2.

Have Docker Desktop running in the background,

Navigate to the `smfi-crpm-app` folder then run `./vendor/laravel/sail/bin/sail build`

After the image is built, run `./vendor/laravel/sail/bin/sail up`

Open `smfi-crpm-app` (which is in Ubuntu) using VS Code.
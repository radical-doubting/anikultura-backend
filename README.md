<img align="right" width="164" height="164" src="docs/img/ani-logo.png">

# anikultura-backend

[![Analysis and unit tests](https://github.com/radical-doubting/anikultura-backend/actions/workflows/analyze.yml/badge.svg)](https://github.com/radical-doubting/anikultura-backend/actions/workflows/analyze.yml)
[![Integration tests](https://github.com/radical-doubting/anikultura-backend/actions/workflows/integration.yml/badge.svg)](https://github.com/radical-doubting/anikultura-backend/actions/workflows/integration.yml)

A Laravel back-end for Anikultura. Its management dashboards are powered by Laravel Orchid. It serves a REST API for the farmer dashboard. It exports Prometheus metrics for insights.

## Dependencies

| Dependency | Version   | Command to Verify    |
| ---------- | --------- | -------------------- |
| PHP        | `8.1.6`   | `php --version`      |
| Composer   | `2.3.10`  | `composer --version` |
| Node       | `16.16.0` | `node --version`     |
| NPM        | `8.17.0`  | `npm --version`      |
| MariaDB    | `10.4.24` | `mysql --version`    |

## Setup using XAMPP

The exact PHP and MariaDB versions can be found in [XAMPP 8.1.6](https://www.apachefriends.org/download.html). If you are running a different version of a dependency, update them to the exact versions above. Having different dependency versions can create inconsistent `.lock` files.

### Steps

-   Clone the repository in your machine.
-   Do `composer install`
-   Do `npm install`
-   Copy your `.env` from `.env.example`.
-   Generate the Laravel app key using `php artisan key:generate`
-   Done!

## Setup using Laravel Sail

-   It is recommended that you have the Ubuntu WSL2 distro.
-   Clone the repository in your Ubuntu folder (like `~/dev/`).
-   Have Docker Desktop running in the background.
-   Navigate to the repository folder and execute

    ```
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
    ```

-   Run `./vendor/laravel/sail/bin/sail build`. It will build the Docker composed images.
-   After the images are built, run `./vendor/laravel/sail/bin/sail up` (add `-d` for detached mode).
-   Open `anikultura-backend`, which is in Ubuntu again, using VS Code.
-   A more detailed article is available [here](https://laravel.com/docs/9.x/sail).
-   Done!

## Grafana Cloud Agent

This application uses the [Grafana Cloud Agent](https://grafana.com/docs/grafana-cloud/data-configuration/agent/) to send metrics and logs. See the `Makefile` for more information about the invocation of the agent.

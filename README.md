<img align="right" width="164" height="164" src="docs/img/ani-logo.png">

# anikultura-backend

![laravel ci](https://github.com/Radical-Doubting/anikultura-backend/actions/workflows/laravel-ci.yml/badge.svg)

The Laravel 9 back-end for Anikultura: a crop monitoring system. Administrator dashboards are powered by Laravel Orchid.

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

## Metrics

### Grafana Cloud Agent

Send metrics via the agent.

```bash
PROMETHEUS_PUSH_URL=http://localhost:9090/api/v1/write PROMETHEUS_TARGET_URL=localhost ./agent-linux-amd64 -config.file=agent-config.yml -config.expand-env
```
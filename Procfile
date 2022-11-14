web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:restart && php artisan queue:work --tries=3
agent: ./agent-linux-amd64 -config.file=agent-config.yml -config.expand-env

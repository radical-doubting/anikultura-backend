oadmin:
	php artisan orchid:admin admin admin@admin.com password

resetdb:
	php artisan migrate:fresh --seed

apidocs:
	php artisan l5-swagger:generate

agent:
	PROMETHEUS_PUSH_URL=http://prometheus:9090/api/v1/write \
	PROMETHEUS_TARGET_URL=localhost \
	LOKI_PUSH_URL=http://loki:3100/loki/api/v1/push \
	LOKI_TARGET_URL=localhost \
	./agent-linux-amd64 -config.file=agent-config.yml -config.expand-env

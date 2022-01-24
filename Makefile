oadmin:
	php artisan orchid:admin admin admin@admin.com password

resetdb:
	php artisan migrate:fresh --seed

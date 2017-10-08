start:
	bin/console server:start 0.0.0.0

stop:
	bin/console server:stop
	
install:
	composer install
	make fixtures

fixtures:
	bin/console doctrine:database:drop --force --if-exists
	bin/console doctrine:database:create
	bin/console doctrine:schema:update --force
	bin/console student:fix

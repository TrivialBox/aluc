PHP = php
TEST_RUNNER = ./vendor/bin/phpunit
DB_PASS = 1234

test:
	$(TEST_RUNNER)

update:
	composer install
	composer update

reload_database: delete_db populate_db

delete_db:
	mysqladmin -u root -p$(DB_PASS) -f drop ALUC

populate_db:
	mysql -u root -p$(DB_PASS) -e "create database IF NOT EXISTS ALUC;"
	mysql -u root -p$(DB_PASS) ALUC < database/DDL.sql
	mysql -u root -p$(DB_PASS) ALUC < database/populate.sql

doc:
	vendor/bin/apigen generate --config=apigen.yaml

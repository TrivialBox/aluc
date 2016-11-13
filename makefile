PHP = php
TEST_RUNNER = ./vendor/bin/phpunit

test:
	$(TEST_RUNNER)

update:
	composer install
	composer update

class:
	composer dump-autoload

doc:
	vendor/bin/apigen generate --config=apigen.yaml

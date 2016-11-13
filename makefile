PHP = php
TEST_RUNNER = phpunit

test:
	$(TEST_RUNNER)

update:
	composer install
	composer update

class:
	composer dump-autoload


test: phpunit phpcs

phpunit:
	./vendor/bin/phpunit --configuration tests/phpunit.xml

phpcs:
	./vendor/bin/phpcs --standard=PSR2 --extensions=php src tests

build:
	cd ../asana-api-meta && gulp build-php

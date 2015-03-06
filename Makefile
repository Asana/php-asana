
all: phpunit phpcs

phpunit:
	./vendor/bin/phpunit --configuration tests/phpunit.xml

phpcs:
	./vendor/bin/phpcs --standard=PSR2 --extensions=php src tests

.PHONY: qa lint cs csf phpstan tests coverage

vendor: composer.json composer.lock
	composer install

qa: tests lint phpstan cs

lint: vendor
	vendor/bin/linter app tests

cs: vendor
	vendor/bin/codesniffer app tests

csf: vendor
	vendor/bin/codefixer --standard=ruleset.xml app tests

phpstan: vendor
	vendor/bin/phpstan analyse -l 2 -c phpstan.neon app --memory-limit=-1

tests: vendor
	./vendor/bin/phpunit --coverage-clover build/logs/clover.xml

coverage: vendor tests
	php ./vendor/bin/php-coveralls  --verbose
.PHONY: qa lint cs csf phpstan tests coverage

vendor: composer.json composer.lock
	composer install

qa: tests lint phpstan cs

lint: vendor
	vendor/bin/linter src tests

cs: vendor
	vendor/bin/codesniffer src tests

csf: vendor
	vendor/bin/codefixer --standard=ruleset.xml src tests

phpstan: vendor
	vendor/bin/phpstan analyse -l 2 -c phpstan.neon src --memory-limit=-1

tests: vendor
	./vendor/bin/phpunit --coverage-clover build/logs/clover.xml

coverage: tests
	php ./vendor/bin/php-coveralls --config ./tests/.coveralls.yml  --verbose

.PHONY: qa lint cs csf phpstan tests

qa: tests lint phpstan cs

lint:
	vendor/bin/linter app tests

cs:
	vendor/bin/codesniffer app tests

csf:
	vendor/bin/codefixer --standard=ruleset.xml app tests

phpstan:
	vendor/bin/phpstan analyse -l 2 -c phpstan.neon app --memory-limit=-1

tests:
	./vendor/bin/phpunit --coverage-clover build/logs/clover.xml


coverage: tests
    php ./vendor/bin/php-coveralls  --verbose
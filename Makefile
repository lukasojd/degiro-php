.PHONY: qa lint cs csf phpstan tests

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
	./vendor/bin/phpunit --coverage-clover coverage.xml

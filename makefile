.PHONY: build
build: ## sail build and up project
		./vendor/bin/sail up --build -d
		install
		cleardb
		cleanup

.PHONY: start
start: ## sail up project
		./vendor/bin/sail up -d

.PHONY: stop
stop: ## sail up project
		./vendor/bin/sail stop

.PHONY: install
install: ## initialize composer and project dependencies
		./vendor/bin/sail composer install

.PHONY: update
update: ## initialize composer update
		./vendor/bin/sail composer update

.PHONY: cleanup
cleanup: ## cleanup all caches
		./vendor/bin/sail artisan event:clear
		./vendor/bin/sail artisan cache:clear
		./vendor/bin/sail artisan route:clear
		./vendor/bin/sail artisan config:clear
		./vendor/bin/sail artisan clear-compiled

.PHONY: cleardb
cleardb: ## clear database and run seeders
		./vendor/bin/sail artisan migrate:fresh --seed

.PHONY: style
style: ## executes php analizers
		./vendor/bin/phpstan analyse -c phpstan.neon

.PHONY: cs
cs: ## executes php cs fixer
		PHP_CS_FIXER_IGNORE_ENV=1 ./vendor/bin/php-cs-fixer --no-interaction --diff -v fix

.PHONY: cs-check
cs-check: ## executes php cs fixer in dry run mode
		PHP_CS_FIXER_IGNORE_ENV=1 ./vendor/bin/php-cs-fixer --no-interaction --dry-run --diff -v fix

.PHONY: test
test: ## executes phpunit tests
		./vendor/bin/sail test --do-not-cache-result --colors=always -v --configuration=phpunit.xml --coverage-clover clover.xml --log-junit ./phpunit/junit.xml --testdox

.PHONY: cs-style
cs-style: cs cs-check style test ## executes php cs fixer, executes php cs fixer in dry run mode and executes php analizers

.PHONY: help
help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

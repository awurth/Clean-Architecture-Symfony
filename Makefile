# Executables (local)
DOCKER_COMPOSE = docker compose
DOCKER_COMPOSE_EXEC = $(DOCKER_COMPOSE) exec

# Docker containers
PHP_CONT = $(DOCKER_COMPOSE_EXEC) php
NODE_CONT = $(DOCKER_COMPOSE_EXEC) node

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY  = $(PHP) bin/console
YARN     = $(NODE_CONT) yarn

# Misc
.DEFAULT_GOAL := help
.PHONY: help

## —— 🎵 🐳 The Symfony-docker Makefile 🐳 🎵 ——————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Docker 🐳 ————————————————————————————————————————————————————————————————

.PHONY: start stop build up down clean logs sh install install-prod install-test

start: build up install ## Build and start the containers

stop: ## Stop the containers
	@$(DOCKER_COMPOSE) stop

build: ## Builds the Docker images
	@$(DOCKER_COMPOSE) build --no-cache

up: ## Start the docker hub in detached mode (no logs)
	@$(DOCKER_COMPOSE) up --pull --wait --detach

down: ## Down the containers
	@$(DOCKER_COMPOSE) down --remove-orphans

clean: ## Down the containers with associated volumes
	@$(DOCKER_COMPOSE) down --remove-orphans --volumes

logs: ## Show live logs
	@$(DOCKER_COMPOSE) logs --tail=0 --follow

sh: ## Connect to the PHP FPM container
	@$(PHP_CONT) sh

install: vendor db-update db-fixtures yarn yarn-dev ## Installs the project for dev environment

install-prod: vendor-prod db-update yarn yarn-build ## Installs the project for the production environment

install-test: vendor db-create-test db-update-test yarn yarn-dev ## Installs the project for the test environment

## —— Composer 🧙 ——————————————————————————————————————————————————————————————

.PHONY: vendor vendor-prod vendor-update

vendor: ## Install vendors for the dev environment
	@$(COMPOSER) install

vendor-prod: ## Install vendors according to the current composer.lock file
	@$(COMPOSER) install --optimize-autoloader --prefer-dist --no-dev --no-progress --no-scripts --no-interaction

vendor-update: ## Install vendors for the dev environment
	@$(COMPOSER) update

## —— Symfony 🎵 ———————————————————————————————————————————————————————————————

.PHONY: sf cc dump

sf: ## List all Symfony commands or pass the parameter "c=" to run a given command, example: make sf c=about
	@$(eval c ?=)
	@$(SYMFONY) $(c)

cc: ## Clear the cache
	@$(SYMFONY) cache:clear

dump: ## Start a dump server that collects and displays dumps in a single place
	@$(SYMFONY) server:dump

## —— Database —————————————————————————————————————————————————————————————————

.PHONY: db-create db-create-test db-drop db-drop-test db-sql db-sql-test db-update db-update-test db-fixtures db-validate db-fixtures-test db-validate-test

db-create: ## Creates the configured database
	@$(SYMFONY) doctrine:database:create --if-not-exists

db-create-test: ## Creates the configured database in the test environment
	@$(SYMFONY) -e test doctrine:database:create --if-not-exists

db-drop: ## Drops the configured database
	@$(SYMFONY) doctrine:database:drop --force --if-exists

db-drop-test: ## Drops the configured database in the test environment
	@$(SYMFONY) -e test doctrine:database:drop --force --if-exists

db-sql: ## Dump the SQL needed to update the database schema to match the current mapping metadata
	@$(SYMFONY) doctrine:schema:update --dump-sql --complete

db-sql-test: ## Dump the SQL needed to update the database schema to match the current mapping metadata in the test environment
	@$(SYMFONY) -e test doctrine:schema:update --dump-sql --complete

db-update: ## Execute the SQL needed to update the database schema to match the current mapping metadata
	@$(SYMFONY) doctrine:schema:update --force --complete

db-update-test: ## Execute the SQL needed to update the database schema to match the current mapping metadata in the test environment
	@$(SYMFONY) -e test doctrine:schema:update --force --complete

db-fixtures: ## Load data fixtures
	@$(SYMFONY) doctrine:fixtures:load -n

db-fixtures-test: ## Load data fixtures in the test environment
	@$(SYMFONY) -e test doctrine:fixtures:load -n

db-validate: ## Validate the database schema
	@$(SYMFONY) doctrine:schema:validate

db-validate-test: ## Validate the database schema in the test environment
	@$(SYMFONY) -e test doctrine:schema:validate

## —— Frontend —————————————————————————————————————————————————————————————————

.PHONY: yarn yarn-dev yarn-build yarn-watch yarn-upgrade

yarn: ## Install frontend dependencies
	@$(YARN) install

yarn-dev: ## Build assets for development
	@$(YARN) dev

yarn-build: ## Build assets for production
	@$(YARN) build

yarn-watch: ## Build assets using watch mode
	@$(YARN) watch

yarn-upgrade: ## Upgrade frontend dependencies
	@$(YARN) upgrade

## —— Tests ————————————————————————————————————————————————————————————————————

.PHONY: test phpunit

test: phpunit ## Run tests

phpunit: ## Run PHPUnit
	@$(PHP) bin/phpunit

## —— Quality tools ————————————————————————————————————————————————————————————

.PHONY: cs cs-dry phpcsfixer phpcsfixer-dry twigcsfixer twigcsfixer-dry phpstan rector rector-dry

cs: phpcsfixer twigcsfixer ## Runs CS Fixers

cs-dry: phpcsfixer-dry twigcsfixer-dry ## Runs CS Fixers

phpcsfixer: ## Runs PHP CS Fixer
	@$(PHP) vendor/bin/php-cs-fixer fix

phpcsfixer-dry: ## Runs PHP CS Fixer using dry mode
	@$(PHP) vendor/bin/php-cs-fixer fix --dry-run

twigcsfixer: ## Runs Twig CS Fixer
	@$(PHP) vendor/bin/twig-cs-fixer lint --fix templates

twigcsfixer-dry: ## Runs Twig CS Fixer using dry mode
	@$(PHP) vendor/bin/twig-cs-fixer lint templates

phpstan: ## Runs PHPStan
	@$(PHP) vendor/bin/phpstan

rector: ## Runs Rector
	@$(PHP) vendor/bin/rector process

rector-dry: ## Runs Rector using dry mode
	@$(PHP) vendor/bin/rector process --dry-run

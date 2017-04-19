COMPOSER=docker run -it --rm -u `id -u` -v `pwd`:/app composer/composer:1-alpine
PHP=docker run -it --rm -P -v `pwd`:/src -w /src php:7 php -d date.timezone=Europe/Paris
CONSOLE=$(PHP) bin/console

null:
	@echo "T'as pas mis de commande !"

diff:
	@git show --color-words $(git describe --always) -- . ':(exclude)composer.lock'

install:
	@$(COMPOSER) install

sonata:
	@git checkout sonata-admin
	@make install
	@$(COMPOSER) require sonata-project/admin-bundle sonata-project/doctrine-orm-admin-bundle

easy:
	@git checkout easy-admin
	@make install
	@$(COMPOSER) require javiereguiluz/easyadmin-bundle

migrations:
	@git checkout doctrine-migrations
	@make install
	@$(COMPOSER) require doctrine/doctrine-migrations-bundle

alice:
	@echo "ca glisse"
	@git checkout alice-fixtures
	@make install
	@$(COMPOSER) require --dev hautelook/alice-bundle:^2.0@beta nelmio/alice:^3.0@beta theofidry/alice-data-fixtures:^1.0@beta doctrine/data-fixtures

uploader:
	@git checkout uploader
	@make install
	@$(COMPOSER) require vich/uploader-bundle liip/imagine-bundle
	@$(CONSOLE) doctrine:query:sql "ALTER TABLE symfony_demo_post ADD imageName VARCHAR(255) DEFAULT NULL;"

user:
	@git checkout user
	@make install
	@$(COMPOSER) require friendsofsymfony/user-bundle "~2.0"
	@$(CONSOLE) doctrine:schema:drop --force
	@$(CONSOLE) doctrine:schema:create --force
	@$(CONSOLE) doctrine:fixtures:load -n

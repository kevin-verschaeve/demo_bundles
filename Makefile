CONSOLE=php bin/console

null:
	@echo "T'as pas mis de commande !"

diff:
	@git show --color-words $(git describe --always) -- . ':(exclude)composer.lock'

install:
	@composer install

sonata:
	@git checkout sonata-admin
	@make install
	@composer require sonata-project/admin-bundle sonata-project/doctrine-orm-admin-bundle

easy:
	@git checkout easy-admin
	@make install
	@composer require javiereguiluz/easyadmin-bundle

migrations:
	@git checkout doctrine-migrations
	@make install
	@composer require doctrine/doctrine-migrations-bundle

alice:
	@echo "ca glisse"
	@git checkout alice-fixtures
	@make install
	@composer require --dev hautelook/alice-bundle:^2.0@beta nelmio/alice:^3.0@beta theofidry/alice-data-fixtures:^1.0@beta doctrine/data-fixtures

uploader:
	@git checkout uploader
	@make install
	@composer require vich/uploader-bundle liip/imagine-bundle
	@$(CONSOLE) doctrine:query:sql "ALTER TABLE symfony_demo_post ADD imageName VARCHAR(255) DEFAULT NULL;"

user:
	@git checkout user
	@make install
	@composer require friendsofsymfony/user-bundle "~2.0"
	@$(CONSOLE) doctrine:schema:drop --force
	@$(CONSOLE) doctrine:schema:create --force
	@$(CONSOLE) doctrine:fixtures:load -n

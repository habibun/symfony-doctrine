.PHONY: init
init: # init project
	symfony console doctrine:database:create --if-not-exists
	symfony console doctrine:schema:create

.PHONY: fixture
fixture: # load fixture in database
	symfony console doctrine:fixtures:load --no-interaction

.PHONY: reset
reset: # reset database
	symfony console doctrine:database:drop --force --if-exists
	$(MAKE) init
	$(MAKE) fixture

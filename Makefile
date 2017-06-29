#!/usr/bin/make -f
#

# --------------------------------------------------------------------------
#
# General
#

OS = $(shell uname -s)

ECHO = echo

ifneq (, $(findstring CYGWIN, $(OS)))
	ECHO = /bin/echo -e
endif

NO_COLOR		= \033[0m
ACTION_COLOR	= \033[32;01m
OK_COLOR		= \033[32;01m
ERROR_COLOR		= \033[31;01m
WARN_COLOR		= \033[33;01m

WHERE-AM-I = $(CURDIR)/$(word $(words $(MAKEFILE_LIST)),$(MAKEFILE_LIST))
THIS_MAKEFILE := $(call WHERE-AM-I)

HELPTEXT = $(ECHO) "$(ACTION_COLOR)--->" `egrep "^\# target: $(1) " $(THIS_MAKEFILE) | sed "s/\# target: $(1)[ ]*-[ ]* / /g"` "$(NO_COLOR)"


# ----------------------------------------------------------------------------
#
# Help
#
# target: help                    - Displays help.
.PHONY:  help
help:
	@$(call HELPTEXT,$@)
	@$(ECHO) "Usage:"
	@$(ECHO) " make [target] ..."
	@$(ECHO) "target:"
	@egrep "^# target:" $(THIS_MAKEFILE) | sed 's/# target: / /g'



# ----------------------------------------------------------------------------
#
# Database
#
# target: database                - Run migrations and seed database
.PHONY: database
database: database-roll-migrate database-migrate database-seed


# target: database-roll-migrate   - Rollback Migrations
.PHONY: database-roll-migrate
database-roll-migrate:
	@$(call HELPTEXT,$@)
	vendor/bin/phinx rollback -e development -t 0


# target: database-migrate        - Run Migrations
.PHONY: database-migrate
database-migrate:
	@$(call HELPTEXT,$@)
	vendor/bin/phinx migrate -e development


# target: database-seed           - Seed database
.PHONY: database-seed
database-seed:
	@$(call HELPTEXT,$@)
	vendor/bin/phinx seed:run


# ----------------------------------------------------------------------------
#
# Test
#
# target: test                    - Run tests
.PHONY: test
test: test-phpunit test-phpcs


# target: test-phpunit            - Run PHPUnit according to phpunit.xml.dist.
.PHONY: test-phpunit
test-phpunit:
	@$(call HELPTEXT,$@)
	phpunit


# target: test-phpcs              - Run PHP Code Sniffer according to phpcs.xml.
.PHONY: test-phpcs
test-phpcs:
	@$(call HELPTEXT,$@)
	phpcs --standard=.phpcs.xml


# ----------------------------------------------------------------------------
# 
# Composer 
#
# target: composer-install        - Install composer packages
.PHONY: composer-install
composer-install:
	@$(call HELPTEXT,$@)
	if [ -f composer.json ]; then composer install; fi



# target: composer-update         - Update composer packages
.PHONY: composer-update
composer-update:
	@$(call HELPTEXT,$@)
	if [ -f composer.json ]; composer update; fi
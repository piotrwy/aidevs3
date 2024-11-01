.PHONY: up
.PHONY: down
.PHONY: build
.PHONY: sf
.PHONY: bash

# Start Docker services
up:
	docker-compose up -d

# Stop Docker services
down:
	docker-compose down

# Build Docker services
build:
	docker-compose up -d --build

# Run Symfony commands inside the PHP container
sf:
	docker-compose exec php php bin/console $(filter-out $@,$(MAKECMDGOALS))

# Run bash inside the PHP container
bash:
	docker-compose exec -it php bash

# Prevent make from interpreting the command as a target
%:
	@:

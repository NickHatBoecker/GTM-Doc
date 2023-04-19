#!/bin/bash

source .env

containerName="${COMPOSE_PROJECT_NAME}_$1"

echo "Login into $containerName"
docker exec -it "$containerName" bash

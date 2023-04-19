#!/bin/bash

source .env

echo "Copy docker vendor to transfer directory"
docker exec -it ${COMPOSE_PROJECT_NAME}_php cp -r vendor vendor-copy
echo "Removing local vendor"
rm -rf ../vendor
echo "Renaming vendor-copy to vendor"
mv ../vendor-copy ../vendor
echo "Finished"

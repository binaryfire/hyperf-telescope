#!/bin/bash
if [ ! -f ./.env ]; then
    cp .env.example .env
fi

if [ ! -f ./database/database.sqlite ]; then
    touch ./database/database.sqlite
fi

if [ ! -d ./vendor ]; then
    composer install
fi

export PUID=$(id -u)
export PGID=$(id -g)

docker compose up -d
docker compose exec app php bin/hyperf.php migrate
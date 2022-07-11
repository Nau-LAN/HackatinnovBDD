git pull
git submodule update --remote front
docker-compose pull
docker-compose up -d --remove-orphans --build

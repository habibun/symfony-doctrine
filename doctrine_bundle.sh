php bin/console make:docker:database
docker-compose up -d
docker-compose
docker-compose ps
mysql -u root --password=password --host=127.0.0.1 --port=32773
docker-compose exec database mysql -u root --password=password
docker-compose stop
docker-compose down
docker-compose ps

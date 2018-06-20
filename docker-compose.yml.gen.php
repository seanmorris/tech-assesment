<?php
$dbName         = "tech_assessment";
$dbUsername     = "tech_assessment";
$dbHost         = "database";
$dbPort         = 3306;
$dbUserPassword = bin2hex(random_bytes(32));
$dbRootPassword = bin2hex(random_bytes(32));
?>version: '3.3'

services:
  tech-assessment:
    build:
      context: ./
      dockerfile: app.dockerfile
    restart: always
    ports:
      - "9000:80"
    depends_on:
      - database
    environment:
      MYSQL_USER: "<?=$dbUsername?>"
      MYSQL_HOST: "<?=$dbHost?>"
      MYSQL_PORT: <?=(int)$dbPort?> 
      MYSQL_DATABASE: "<?=$dbName?>"
      MYSQL_PASSWORD: "<?=$dbUserPassword?>"

  seeder:
    build:
      context: ./
      dockerfile: seeder.dockerfile
    restart: always
    depends_on:
      - database
    environment:
      MYSQL_USER: "<?=$dbUsername?>"
      MYSQL_HOST: "<?=$dbHost?>"
      MYSQL_PORT: <?=(int)$dbPort?> 
      MYSQL_DATABASE: "<?=$dbName?>"
      MYSQL_PASSWORD: "<?=$dbUserPassword?>"

  database:
    image: mysql:5.7
    restart: always
    ports:
      - "9001:<?=(int)$dbPort?>"
    volumes:
      - schema:/var/lib/mysql
    environment:
      MYSQL_USER: "<?=$dbUsername?>"
      MYSQL_HOST: "<?=$dbHost?>"
      MYSQL_PORT: <?=(int)$dbPort?> 
      MYSQL_DATABASE: "<?=$dbName?>"
      MYSQL_PASSWORD: "<?=$dbUserPassword?>"
      MYSQL_ROOT_PASSWORD: "<?=$dbRootPassword?>"

volumes:
  schema:
    driver: "local"

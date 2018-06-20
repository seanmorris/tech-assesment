<?php
$dbName         = "tech_assessment";
$dbUsername     = "tech_assessment";
$dbHost         = "database";
$dbPort         = 3306;
$dbUserPassword = bin2hex(random_bytes(32));
$dbRootPassword = bin2hex(random_bytes(32));

$script         = array_shift($argv);
$buildEnv       = array_shift($argv);
$buildLocal     = FALSE;
if($buildEnv == 'local')
{
  $buildLocal = TRUE;
}
?>version: '3.3'

services:
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

  tech-assessment:
<?php if(!$buildLocal): ?>
    image: docker.io/seanmorris/tech-assessment-app
<?php else: ?>
    build:
      context: ./
      dockerfile: app.dockerfile
<?php endif; ?>
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
<?php if(!$buildLocal): ?>
    image: docker.io/seanmorris/tech-assessment-seeder
<?php else: ?>
    build:
      context: ./
      dockerfile: seeder.dockerfile
<?php endif; ?>
    restart: always
    depends_on:
      - database
    environment:
      MYSQL_USER: "<?=$dbUsername?>"
      MYSQL_HOST: "<?=$dbHost?>"
      MYSQL_PORT: <?=(int)$dbPort?> 
      MYSQL_DATABASE: "<?=$dbName?>"
      MYSQL_PASSWORD: "<?=$dbUserPassword?>"

volumes:
  schema:
    driver: "local"

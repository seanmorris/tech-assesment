# Tech Assessment

```v0.01 humble beginnings```

## Quickstart:

You can start up the project quickly with [docker](https://docs.docker.com/install/) & [docker compose](https://docs.docker.com/compose/).

Once those are installed, these commands should have it up and running.

```bash
git clone git@github.com:seanmorris/tech-assesment.git
pushd tech-assesment
php docker-compose.yml.gen.php > docker-compose.yml
docker-compose up
popd
```

Once you've done that, visit the following link:

[http://localhost:9000/](http://localhost:9000/)

If you lose your DB password (i.e. by regenerating your docker-compose.yml), you can remove the DB volume:

```bash
docker container rm tech-assesment_database_1
docker volume rm tech-assesment_schema
```

You can also build the containers locally by passing the "local" parameter to the docker-compose.yml generator:

```bash
php docker-compose.yml.gen.php local > docker-compose.yml
```

This fits into the above script like so:

```bash
git clone git@github.com:seanmorris/tech-assesment.git
pushd tech-assesment
php docker-compose.yml.gen.php local > docker-compose.yml
docker-compose up
popd
```

## What's Done:

* Routes
* Basic HTML & CSS
* Basic Docker Containerization
* Article & Event Seeding
* MySQL password randomly generated before build
* Image modeling & relationship seeder
* Responsive, animated menu
* Tracking & TrackingSummary models & schema
* Tracking endpoints
* Tracking JS

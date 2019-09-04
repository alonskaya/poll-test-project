## Poll service test project

The project is very raw and needs to be improved. 
For example, preventing users name collision, DI.

### Requirements

[composer.json](composer.json)

### Usage
Install dependencies:
```
composer install
```
Modify docker-compose.yml file depending on your needs, and then run:
```
docker-compose up
```

By default, the application will be available at http://localhost:8999/.

Create poll and then press the start button. 

![Poll Builder Example](docs/poll_builder.png?raw=true "Poll builder example")

Browser redirects to poll home page. Send the link to those who want to participate.

![Poll Acting Example](docs/poll_acting.png?raw=true "Poll acting example")

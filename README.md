# Lumen API Dockerized

### Set up

- Clone project from the GitHub repository
```bash
git clone https://github.com/slimprepdevops/lumen-docker.git
```

### Build and run the project with docker
- Ensure you have Docker running on the background. Then run the command below 
on the root directory of the project
```bash
docker-compose up -d
```

### Database migration and seed
- Run the docker command below to migrate and seed the database
```bash
docker exec lumen php artisan migrate:fresh --seed
```

- The project should be running on port `8085`, So all endpoints can be accessed 
via the base URL below;
```bash
localhost:8085/api/v1/
```

### API Documentation 
[https://documenter.getpostman.com/view/2811984/UzBnsSca](https://documenter.getpostman.com/view/2811984/UzBnsSca)

### Postman Collection
[https://www.getpostman.com/collections/b3bace025d87b09d03d0](https://www.getpostman.com/collections/b3bace025d87b09d03d0)

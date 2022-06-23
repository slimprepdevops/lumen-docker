# Node Statistics

### Set up

- Clone project from the GitHub repository
```bash
git clone git@github.com:kevchikezie/node-statistics.git
```

- Create a .env file from .env.example
```bash
cp .env.example .env
```

- Generate Laravel application key
```bash
php artisan key:generate
```

- Generate the application's JWT secret key
```bash
php artisan jwt:secret
```

### Build and run the project with docker
- Ensure you have Docker running on the background. Then run the command below 
on the root directory of the project
```bash
docker-compose build && docker-compose up -d
```

### Database migration and seed
- Run the docker command below to migrate and seed the database
```bash
docker exec node-statistics php artisan migrate:fresh --seed
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

## MY THOUGHTS
The first step I took after receiving the test briefing was to understand what 
is expected of me and list them out in the order I should approach it. Below is 
my step-by-step list as outlined while brainstorming on my appraoch.

### My Task Breakdown
- Install Lumen
- Structure database and outline table and its columns
- Write migration for tables
- Write table models and relationships if any
- Create factory and seed class for nodes in order to seed the nodes table
- Implement routes and controller methods for create, read, update and delete
- Validate inputs when creating and updating a record
- Handle general 404 and 403 route errors
- Refactor controller method to make use of a service class. 
- API documentation
- README.md
-  Implement authentication
- Configure application to run with docker

### Why I added a service layer 
I used a service class to help separate concerns. This means all the business 
logics were moved to the service class so that the controllers will remain slim 
and will have nothing to do with those business logics. 

All the controller needs to do is call any of the methods in the service class 
in order to perform an operation. So, the controller will hence act as a 
controller, that is, it should just receive request and return a response. 

This will also help in reusability. If a different controller want to make use 
of the same service class but wants to return a web page as its response, this 
will be made easy because we don't need to rewrite the business logic to do this; 
all we need to do is reuse the service class.

Note that I can still refactor the service layer by abstracting all the database 
methods and create yet another layer - the data layer or repository layer - 
which will contain all database related logics.

### Scalability
Since the application is dockerized, we can easily scale by creating different 
instance of the application and manage them using Kubernetes.

### Pruning the database every 24 hours
I could not implement this feature but my thought on this feature is to 
create a job (cron job) that will be triggered every 24 hours, probably by 
midnight. This job will run a database query in our application that will prune 
data from the `nodes` table and leave only hourly dataset on the table. The 
only challenge I encountered here is structuring the database query to do the 
pruning.


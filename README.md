## Technical Test

For the test, it was requested to develop an API in Laravel that would handle the registration of sellers, sales (calculating a commission of 8.5%), and at the end of each day, send an email (simulation of sending via mailtrap) with the total sales of that day.

In addition to this implementation, create a platform for interactions with the API, which can be developed in PHP or Vue (I chose to use Vue).

Some architecture patterns, object calisthenics, automated tests using PHP Unit, creation of Gitlab CI configuration, among other issues can be seen in the project.

## Project Initialization

### Step by Step

Clone the project by executing:

```sh
git clone https://github.com/leoblanski/test_sales_mailer.git
```

Access the project

```sh
cd test_sales_mailer
```

Create the .env file (All necessary configurations are already in the env.example)
```sh
cp .env.example .env
```

Start the project containers
```sh
docker-compose up -d
```

Access the container
```sh
docker-compose exec app bash
```

Install project dependencies
```sh
composer install
```

Generate the Laravel project key
```sh
php artisan key:generate
```

Run the project migrations
```sh
php artisan migrate
```

To enable email sending, you need to start the Worker for Jobs, to do this, execute:
```sh
php artisan queue:work
```

Additionally, the SMTP configuration information provided in the application documentation should be copied and updated in the .env.

Access the project
[http://localhost:8989](http://localhost:8989)

### Application Documentation

https://docs.google.com/document/d/1G7D3xyyCzXqqgg77kC7nQNunPG2h7Gy1TiNOSiEhXU8/edit?usp=sharing

### API Documentation

https://documenter.getpostman.com/view/7943547/VUjMoRBd

### Postman API Workspace for Visualization

https://app.getpostman.com/join-team?invite_code=180e2ac552a25f5a160a0d95ccde0e17&target_code=5a91afc273634080cd9e8b87f08873f5

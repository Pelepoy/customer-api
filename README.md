# 📦 Customer API and Importer with Laravel & Doctrine
## Documentation

A robust API and importing feature for customer data from [randomuser.me](https://randomuser.me) with Australian nationality filtering.

## Run Locally

### Quick Installation

```bash
  git clone https://github.com/Pelepoy/customer-api.git
  cd customer-api
  composer install
  cp .env.example .env
```
### Database Setup
```bash
  mysql -u root -p
  CREATE DATABASE `customers-db`
  -------------------------------
  DB_CONNECTION=mysql
  DB_DATABASE=customers_db
  DB_USERNAME=root
  DB_PASSWORD=your_password

  php artisan doctrine:schema:create
```
### Run the project
```bash
 php artisan serve
```

### Importer
```bash
  Configuration .env
  RANDOM_USER_API_URL=https://randomuser.me/api
  REQUIRED_NATIONALITY=AU
  DEFAULT_RESULTS=100

  php artisan customers:import (default value 100 results, AU nationality)

  php artisan customers:import --count=100 --nationality=AU
```

### API Reference

```http
@GET /api/customers
```
```http
  Sample Result
{
    "data": [
        {
            "full_name": "Benjamin Rodriquez",
            "email": "benjamin.rodriquez@example.com",
            "country": "Australia"
        },
          {
            "full_name": "Levi Shelton",
            "email": "levi.shelton@example.com",
            "country": "Australia"
        },
    ]
}
```

#### Get customer details
```http
@GET /api/customers/{customerId}
```
```http
 Sample Result
{
    "data": {
        "full_name": "Benjamin Rodriquez",
        "email": "benjamin.rodriquez@example.com",
        "username": "ticklishwolf201",
        "gender": "male",
        "country": "Australia",
        "city": "Launceston",
        "phone": "04-1014-8364"
    }
}
```

### Testing
```bash
//Run all tests
php artisan test

//Test subsets
php artisan test --testsuit=Unit // Test service
php artisan test --testsuit=Feature // API tests
```

## Key Features
- Import customers from a 3rd party data provider and save to the database.
- Display a list of customers from the database.
- Select and display details of a single customer from the database.
- Secure Data Import from randomuser.me
- Doctrine ORM with strict entity definitions
- Reusable Services for API and CLI imports
- 100% Test Coverage with mocked dependencies

## Implementation Details
✅ Strict Requirements Met:

- Doctrine ORM with minimal customers table
- Config-driven parameters
- MD5 password hashing
- Reusable import service
- Complete test coverage
- Proper error handling
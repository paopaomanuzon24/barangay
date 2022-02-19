# Barangay Management System

The Barangay Management Information System (BMIS) facilitates identification of barangay needs vital for nutrition and development planning, project implementation, monitoring and evaluation, and promote capacity development of Barangay Development Councils (BDCs) in e-governance.

## Installation

Windows:

```sh
to be editted
```

OS & Linux:

```sh
to be editted
```

## Development setup

Follow these steps to install the system for development purposes:

1. Make a clone or copy of the repository.

2. Run this command to the terminal of the cloned or forked repository:
	```sh
	composer install
	```

3. Install the npm libraries:
	```sh
	npm install
	```
	
4. Make a ``.env`` file using the ``.env.example`` and change your local configuration for DB, APP_URL, and DOMAIN.

5. Create a database with the name you specified in ``.env`` file and use ``utf8mb4_unicode_ci`` collation.collation.

6. Run the optimize command:
	```sh
	php artisan optimize
	```

7. Generate app key:
	```sh
	php artisan key:generate
	```

8. Run the migrations:
	```sh
	php artisan migrate
	```

9. Run the default tables' data:
	```sh
	php artisan db:seed --class=DatabaseSeeder
	```

10. Create the encryption keys:
	```sh
	php artisan passport:install
	```

11. Compile the project views:
	```sh
	npm run dev
	```

12. Run the laravel project:
	```sh
	php artisan serve
	```
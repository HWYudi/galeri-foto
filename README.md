# Laravel Project

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP (>= 7.3)
- Composer
- Node.js and npm
- MySQL or another database system supported by Laravel

## Installation

Follow these steps to set up and run the project:

1. Clone the repository:

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install JavaScript dependencies:
   ```
   npm install
   ```

4.export database to phpmyadmin
    

5.If The App Show Error No application encryption key has been specified. Then Generate an application key:
   ```
   php artisan key:generate
   ```

## Running the Application

1. Start the Laravel development server:
   ```
   php artisan serve
   ```

2. In a separate terminal, compile and watch for asset changes:
   ```
   npm run dev
   ```

3. Open your browser and visit `http://localhost:8000` to view the application.

## Additional Information

For more details about Laravel, check out the following resources:

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [Laracasts](https://laracasts.com)

## Contributing

Please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct) when contributing to this project.

## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

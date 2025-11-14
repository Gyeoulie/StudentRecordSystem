# Student Record System

A Laravel-based student record management system with admin dashboard for creating, viewing, and managing student records.

## Prerequisites

- PHP 8.1+
- Composer
- Node.js & npm
- MySQL/MariaDB

## Installation Steps

1. **Install PHP dependencies**
   ```
    composer install
   ```

2. **Install Node dependencies**
   ```
   npm install
   ```

3. **Setup environment file**
   ```
   cp .env.example .env
   ```

4. **Generate application key**
   ```
   php artisan key:generate
   ```

5. **Configure database in `.env`**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=student_record_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run database migrations**
   ```
   php artisan migrate
   ```

7. **Seed the database with test data**
   ```
   php artisan db:seed
   ```

8. **Create storage symlink**
   ```
   php artisan storage:link
   ```

9. **Build frontend assets**
    ```
    npm run dev
    ```

10. **Start the development server**
    ```
    php artisan serve
    ```

The application will be available at `http://localhost:8000`

## Test Account

Use the following credentials to login:

- **Email:** `admin@mail.com`
- **Password:** `admin`

## Development

To watch for frontend changes during development:
```
npm run dev
```

For production build:
```
npm run build
```

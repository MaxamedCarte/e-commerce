## E-Commerce (Laravel + MySQL)

Beginner-friendly e-commerce example with clean MVC structure, session-based cart, and basic admin product management.

### Requirements
- PHP 8.2+
- Composer
- MySQL (phpMyAdmin via XAMPP)

### Sample .env database configuration
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

### Setup
1. Copy .env.example to .env and update database settings.
2. Generate key: php artisan key:generate
3. Run migrations: php artisan migrate
4. Create storage symlink (for product images): php artisan storage:link
5. Start the app: php artisan serve

### Features
- Product listing and details
- Session-based cart (add/update/remove)
- Checkout and order persistence
- Basic admin panel for product CRUD
- Auth (login/register)

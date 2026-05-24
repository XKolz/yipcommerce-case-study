# YipCommerce Case Study

YipCommerce Case Study is a compact Laravel 12 e-commerce application built for a PHP Full Stack Developer job application at YipOnline. It demonstrates product browsing, cart and checkout, authenticated customer orders, and an admin dashboard for product and order management.

## Features

- Public homepage, product listing, product search, and product detail pages
- Session-based shopping cart with stock-aware quantity limits
- Authenticated checkout with order and order item creation
- Customer order history and order detail pages
- Custom registration, login, logout, password hashing, and auth middleware
- Role-based admin access with a `role` column on users
- Admin dashboard with product/order metrics and revenue summary
- Admin product create/edit/inactive workflow with optional image upload
- Admin order status and payment status updates
- Mobile-responsive Blade/Tailwind UI
- Smarty integration for the `/about` page
- Basic feature tests for product, cart, checkout, and admin access flows

## Tech Stack

- PHP 8.4+
- Laravel 12
- SQLite by default for easy local testing
- Eloquent ORM
- Blade and Tailwind CSS
- Smarty 5 for one integrated template page
- PHPUnit feature tests

## Requirements

- PHP 8.4 or newer
- Composer
- Node.js and npm
- SQLite extension for PHP

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run dev
php artisan serve
```

The app will be available at `http://127.0.0.1:8000`.

For a production-style asset build:

```bash
npm run build
```

## Environment Setup

The project uses SQLite by default:

```env
DB_CONNECTION=sqlite
```

Laravel's project scaffold creates `database/database.sqlite`. If the file is missing, create it before running migrations.

## Demo Credentials

Admin:

- Email: `admin@yipdemo.com`
- Password: `password`

User:

- Email: `user@yipdemo.com`
- Password: `password`

## Main Routes

- `GET /` - Homepage
- `GET /products` - Product listing and search
- `GET /products/{slug}` - Product detail
- `GET /cart` - Shopping cart
- `POST /cart/add/{product}` - Add product to cart
- `PATCH /cart/update/{product}` - Update cart quantity
- `DELETE /cart/remove/{product}` - Remove cart item
- `GET /checkout` - Checkout form
- `POST /checkout` - Place order
- `GET /orders` - Customer order history
- `GET /orders/{order}` - Customer order detail
- `GET /admin/dashboard` - Admin overview
- `GET /admin/products` - Admin products
- `GET /admin/orders` - Admin orders
- `GET /about` - Smarty-rendered about page

## Security Considerations

- Passwords are hashed through Laravel's hashed cast and `Hash::make` in seeders
- CSRF protection is applied to all state-changing forms
- Auth middleware protects checkout and customer order pages
- Admin middleware restricts `/admin` routes to users with `role = admin`
- Customers cannot view another customer's order
- Form Request classes validate product, checkout, order status, and payment status input
- Eloquent and the query builder are used instead of raw SQL
- Cart quantities are validated against current product stock
- Blade escapes output by default; the Smarty template uses escape modifiers for dynamic values

## Architecture Notes

- Controllers stay thin and delegate cart/order rules to `CartService` and `OrderService`
- Products, orders, and order items use Eloquent relationships for clear MVC data flow
- The cart is session-based to keep the case study simple and fast to run locally
- Order creation runs inside a database transaction and reduces stock during checkout
- Admin and storefront controllers are separated under `App\Http\Controllers\Admin` and `App\Http\Controllers`
- Smarty is wrapped by `App\Services\SmartyRenderer`, keeping template engine setup outside controllers

## Testing

Run the test suite:

```bash
php artisan test
```

Covered flows:

- User can view products
- User can add product to cart
- Authenticated user can checkout
- Admin can view orders
- Non-admin cannot access admin dashboard

## Screenshots

Screenshots can be added here before submission:

- Homepage
- Product listing
- Cart
- Checkout
- Admin dashboard
- Admin order detail

## Future Improvements

- Add payment gateway integration
- Add email order confirmations
- Add product categories and filters
- Add database-backed carts for cross-device sessions
- Add policies for finer-grained authorization
- Add inventory history and low-stock alerts
- Add full browser tests with Laravel Dusk or Playwright

## Deployment Notes

- Set production `.env` values for `APP_ENV`, `APP_KEY`, `APP_URL`, database, mail, cache, queue, and filesystem
- Run `composer install --no-dev --optimize-autoloader`
- Run `npm ci && npm run build`
- Run `php artisan migrate --force`
- Run `php artisan storage:link`
- Run `php artisan config:cache route:cache view:cache`
- Use a queue worker if async jobs are added later

## Render Deployment

This repository includes a `Dockerfile`, `render.yaml`, and Render start script for deploying the Laravel app as a free Render Web Service with PostgreSQL.

1. Push this repository to GitHub.
2. Generate an app key locally:

```bash
php artisan key:generate --show
```

3. In Render, create a new Blueprint from this repository. Render will read `render.yaml` and create:

- A free Docker web service
- A free Render Postgres database

4. When Render prompts for `APP_KEY`, paste the generated key from step 2.
5. After the first deploy, update `APP_URL` in Render if the service URL is different from `https://yipcommerce-case-study.onrender.com`.

Render free web services sleep after inactivity, so the first request after a pause may be slow. Render free Postgres databases also expire after 30 days; use an external free Postgres provider such as Supabase for a longer-lived demo database. Product image uploads use local storage and are not durable on Render's free web service.

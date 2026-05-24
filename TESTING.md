# Testing

Run automated tests:

```bash
php artisan test
```

Manual smoke test:

1. Run `php artisan migrate:fresh --seed`.
2. Start Vite with `npm run dev`.
3. Start Laravel with `php artisan serve`.
4. Visit `/products`, search for a product, and open a product detail page.
5. Add a product to cart, update quantity, and remove an item.
6. Log in as `user@yipdemo.com` with password `password`.
7. Checkout with Cash on Delivery.
8. Visit `/orders` and open the placed order.
9. Log in as `admin@yipdemo.com` with password `password`.
10. Visit `/admin/dashboard`, update an order status, and edit a product.

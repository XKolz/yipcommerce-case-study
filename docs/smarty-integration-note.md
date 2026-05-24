# Smarty Integration Note

This project implements the practical Smarty option at `/about`.

The integration is intentionally small:

- `App\Services\SmartyRenderer` configures Smarty template, compile, and cache paths.
- `resources/smarty/about.tpl` contains the Smarty template.
- `HomeController@about` passes view-model data into Smarty.
- `resources/views/smarty/about.blade.php` places the rendered Smarty fragment inside the normal app layout.

In a Laravel-inspired custom framework, this renderer would sit beside the view layer. Controllers would remain responsible for request orchestration, services/models would handle business data, and Smarty would receive already-prepared view data.

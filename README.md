## Tutorial

From [here](https://youtube.com/playlist?list=PLFHz2csJcgk_M6tg-f589Myy-lbLyACKi&si=1bw1MgG9Mpk2sjSA).

### Installation

```bash
composer require filament/filament:"^3.2" -W
 ```
 
```bash
php artisan filament:install --panels
```
 
```bash
php artisan make:filament-user
```
 
```bash
php artisan vendor:publish --tag=filament-config
```

### Models
 
```bash
php artisan make:model Category -m
```
 
```bash
php artisan make:model Brand -m
```
 
```bash
php artisan make:model Product -m
```
 
```bash
php artisan make:model Customer -m
```
 
```bash
php artisan make:model Order -m
```
 
```bash
php artisan make:model OrderItem -m
```
 
```bash
php artisan make:migration create_category_product_table
```
 
```bash
php artisan make:migration delete_total_price_from_orders_table --table=orders
```
 
### Resources

```bash
php artisan storage:link
```

```bash
php artisan make:filament-resource Product
```

```bash
php artisan make:filament-resource Brand
```

```bash
php artisan make:filament-resource Customer
```

```bash
php artisan make:filament-resource Order
```

```bash
php artisan make:filament-resource Category
```

### Relation managers

```bash
php artisan make:filament-relation-manager BrandResource products name
```

```bash
php artisan make:filament-relation-manager CategoryResource products name
```

### Widgets

```bash
php artisan make:filament-widget StatsOverview --stats-overview
```

```bash
php artisan make:filament-widget ProductsChart --chart
```

```bash
php artisan make:filament-widget OrdersChart --chart
```

```bash
php artisan make:filament-widget LatestOrders --table
```

### License

Licensed under the [MIT license](https://opensource.org/licenses/MIT).

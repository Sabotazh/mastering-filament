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
 
### Resources

```bash
php artisan storage:link
```

```bash
php artisan make:filament-resource Product
```

### License

Licensed under the [MIT license](https://opensource.org/licenses/MIT).

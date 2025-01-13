php artisan make:model UserAddress -m
php artisan make:model Category -m
php artisan make:model Jewelry -m
php artisan make:model JewelryPhoto -m
php artisan make:model JewelrySize -m
php artisan make:model Bank -m
php artisan make:model Cart -m
php artisan make:model JewelryTransaction -m

php artisan make:filament-resource Category
php artisan make:filament-resource Jewelry
php artisan make:filament-resource JewelryPhoto
php artisan make:filament-resource JewelrySize
php artisan make:filament-resource Bank
php artisan make:filament-resource Cart
php artisan make:filament-resource JewelryTransaction
php artisan make:filament-resource User

php artisan make:controller FrontController
php artisan make:controller CartController

create user:
php artisan make:filament-user

update resource:
php artisan filament:cache-components

clear:
php artisan cache:clear
php artisan config:clear
php artisan view:clear

path login:
vendor\filament\filament\src\Http\Middleware\Authenticate.php

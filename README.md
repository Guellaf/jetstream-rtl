<p align="center"><img src="https://laravel.com/assets/img/components/logo-jetstream.svg">RTL version</p>

<p align="center">
    <a href="https://github.com/laravel/jetstream/actions">
        <img src="https://github.com/laravel/jetstream/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/jetstream">
        <img src="https://poser.pugx.org/laravel/jetstream/d/total.svg" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/jetstream">
        <img src="https://poser.pugx.org/laravel/jetstream/v/stable.svg" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/jetstream">
        <img src="https://poser.pugx.org/laravel/jetstream/license.svg" alt="License">
    </a>
</p>

Persian RTL Version of Laravel Jetstream

##Installation
###First Step
Install tailwindcss-rtl package:

```shell
# Yarn 
yarn add tailwindcss-rtl --dev
 
# NPM 
npm install tailwindcss-rtl --save-dev
```
###Next Steps
First Install new Laravel
then
Install jetstream rtl via composer :

```shell
composer require alifattahi/jetstream-rtl
```
then

```shell
php artisan jetstream:install livewire
#or
php artisan jetstream:install inertia
```
In addition, you may use the --teams switch to enable team support:

```shell
php artisan jetstream:install inertia --teams
```

finally :

```shell
npm install && npm run dev

php artisan migrate
```
## Official Documentation

Documentation for Jetstream can be found on the [Jetstream website](https://jetstream.laravel.com).

## Contributing

Thank you for considering contributing to Jetstream! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

Please review [our security policy](https://github.com/laravel/jetstream/security/policy) on how to report security vulnerabilities.

## License

Laravel Jetstream is open-sourced software licensed under the [MIT license](LICENSE.md).

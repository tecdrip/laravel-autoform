# Laravel AutoForm

Automatically create beautiful forms from Laravel models

# Installing Guide

### Require AutoForm

```bash
composer require tecdrip/laravel-autoform
```

### Publish the config file for AutoForm

```bash
php artisan vendor:publish --provider Tecdrip\LaravelAutoForm\AutoFormServiceProvider
```

### Clear Config

You may need to clear your config cache if AutoForm config file changes are not updating

```bash
php artisan config:clear
```

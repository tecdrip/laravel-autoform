# AutoForm

Automatically create beautiful forms from Laravel models

# Installing Guide

### Require Maverick

```bash
composer require tecdrip/maverick
```

### Publish the config file for Maverick

```bash
php artisan vendor:publish --provider Tecdrip\Maverick\MaverickServiceProvider
```

### Clear Config

You may need to clear your config cache if Maverick config file changes are not updating

```bash
php artisan config:clear
```

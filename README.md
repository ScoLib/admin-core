# ScoAdmin

[![StyleCI](https://styleci.io/repos/72430639/shield?branch=master)](https://styleci.io/repos/72430639)
[![Latest Stable Version](https://poser.pugx.org/scolib/admin/v/stable)](https://packagist.org/packages/scolib/admin)
[![Total Downloads](https://poser.pugx.org/scolib/admin/downloads)](https://packagist.org/packages/scolib/admin)
[![Latest Unstable Version](https://poser.pugx.org/scolib/admin/v/unstable)](https://packagist.org/packages/scolib/admin)
[![License](https://poser.pugx.org/scolib/admin/license)](https://packagist.org/packages/scolib/admin)


```php
php artisan vendor:publish --provider="Sco\Admin\Providers\AdminServiceProvider"
php artisan migrate
php artisan db:seed --class=AdminTableSeeder
```

auth.php

```php
    // 增加guard
    'guards' => [
        ......
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],
    
    // 增加 providers
    'providers' => [
        ......

        'admin' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
    ],
```
如果guard名字不是“admin”，则config/scoadmin.php中的guard也需要修改

User Model引入EntrustUserTrait
```php
use Sco\Admin\Traits\AdminUserTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User
{
    use EntrustUserTrait, AdminUserTrait;
}
```

Open your config/app.php and add the following to the providers array:
```php
Zizaco\Entrust\EntrustServiceProvider::class,
```

In the same config/app.php and add the following to the aliases array:

```php
'Entrust' => Zizaco\Entrust\EntrustFacade::class,

```



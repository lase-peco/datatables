<img src="https://banners.beyondco.de/Datatables.png?theme=light&packageManager=composer+require&packageName=lase-peco%2Fdatatables&pattern=architect&style=style_1&description=Built+with+Livewire%2C+made+easy+to+use&md=1&fontSize=150px&images=table"/>

# Datatables on steroids 💥

The ``lase-peco/datatables`` adds robust and easy to customize datatables build with the Laravel Livewire library.

## Note 
We are still working on this package to bring new features.

## Requirements
- PHP 8.0+
- [Laravel 8.x](https://laravel.com/docs/8.x)
- [Livewire 2.x](https://laravel-livewire.com/)
- [Tailwindcss 3.x](https://tailwindcss.com/)

## Installation

You can install the package via composer:

```php 
composer require lase-peco/datatables
```

## Features

All generated datatables has the following features:

- Column sorting.
- Pagination.
- Include specific columns. (optional)
- Exclude Specific columns. (optional)

... and many new features on the way!

## Use

Just add in your "View" the following:

```php 
<livewire:datatable model="App\Models\User"/>
```

Define in the model attribute the Eloquent Model, for which you like to generate the datatable.

### The <font color="green">include</font> attribute

You can specify which columns to include in the table and in which order by using the ```include``` attribute. Just provide the needed columns seperated with a comma.

```php 
<livewire:datatable model="App\Models\User" include="name,email,created_at,id"/>
```

This will give you a table with the provided columns in the provided order.

### The <font color="green">exclude</font> attribute

You can specify which columns to exclude from the table by using the ```exclude``` attribute. Just provide the unwanted columns seperated with a comma.

```php 
<livewire:datatable model="App\Models\User" exclude="name,id"/>
```
This will give you a table with all columns form the provided eloquent model except the excluded ones.



### Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email a.dabak@lase-peco.com instead of using the issue tracker.

## Credits

- [Ahmed Dabak](https://github.com/lase-peco)
- [All Contributors](CONTRIBUTING.md)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

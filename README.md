# Backpack Dropzone field

Add Dropzone support for [Laravel Backpack](https://laravel-backpack.readme.io/docs).

## Requirements
- [Laravel Backpack](https://laravel-backpack.readme.io/docs)
	- [Installation](https://backpackforlaravel.com/docs/4.0/installation "Installation")
	- [Getting Started](https://backpackforlaravel.com/docs/4.0/introduction "Getting Started")
- [Spatie Laravel Medialibrary](https://spatie.be/docs/laravel-medialibrary/v9/introduction)
	- [Installation & setup](https://spatie.be/docs/laravel-medialibrary/v9/installation-setup "Installation & setup")
	- [Basic usage - Preparing your model](https://spatie.be/docs/laravel-medialibrary/v9/basic-usage/preparing-your-model "Basic usage - Preparing your model")

## Limitations
Currently, you can only manage media while editing an entry.

## Install

### Via Composer

``` bash
composer require julienmru/laravel-backpack-dropzone-field:3.0.0
```

Publish assets:
``` bash
php artisan julienmru:backpackdropzonefield:install
```

## Usage

### EntityCrudController

For simplicity add the `HandleAjaxMedia` trait to all EntityCrudController.

```php
<?php

...

use JulienMru\BackpackDropzoneField\Traits\HandleAjaxMedia;

...

class EntityCrudController extends CrudController
{
	...
    use HandleAjaxMedia;

	...
}

```

### Routes

In your routes file, you have to add additionals routes.

 ```php
 <?php

...

Route::crud('entity', 'EntityCrudController')
Route::post('entity/{id}/media', 'EntityCrudController@uploadMedia');
Route::delete('entity/{id}/media/{mediaId}', 'EntityCrudController@deleteMedia');
Route::post('entity/{id}/media/reorder', 'EntityCrudController@reorderMedia');

...
 ```

### Field


```
[
	...
	'type' => 'dropzone_media',
	'collection' => 'photos', // Media collection where files are added to
	'thumb_collection' => 'thumbs', // Media collection where thumb are displayed from. If not set, 'collection' is used by default
	'options' => [
		... // Dropzone options
	]
	...
]
```

Example:

```
<?php

...
$this->crud->operation(['update'], function() {
	$this->crud->addField([
		'label' => 'Photos',
		'type' => 'dropzone_media',
		'name' => 'photos',
		'collection' => 'photos',
		'thumb_collection' => 'thumbs',
		'options' => [
			'thumbnailHeight' => 120,
			'thumbnailWidth' => 120,
			'maxFilesize' => 10,
			'addRemoveLinks' => true,
			'createImageThumbnails' => true,
		],
	]);
});

...
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email mail@julien.expert instead of using the issue tracker.

## Credits

- [Adrian Sacchi][link-author]
- [Julien Tessier][https://github.com/julienmru]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/gaspertrix
[link-contributors]: ../../contributors

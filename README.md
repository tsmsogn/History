# History

[![Build Status](https://travis-ci.org/tsmsogn/History.svg?branch=master)](https://travis-ci.org/tsmsogn/History)

## Installtion

Put your app plugin directory as `History`.

### Enable plugin

Update schema:

```shell
./Console/cake schema update -p History
```

In 2.0 you need to enable the plugin your app/Config/bootstrap.php file:

```php
<?php
CakePlugin::load('History', array('bootstrap' => false, 'routes' => true));
?>
```

Enable admin routing in app/Config/core.php file:

```php
<?php
Configure::write('Routing.prefixes', array('admin'));
?>
```

Add LogBehavior like bellow with model you want to log:

```php
<?php
class AppModel extends Model {

    public $actsAs = array('History.Log');

}
?>
```

## License

The MIT License (MIT)
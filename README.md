# History

## Instralltion

Update schema

```
$ ./Console/cake schema update -p History
```

Load plugin

```
CakePlugin::load('History', array('bootstrap' => false, 'routes' => false));
```

Add actsAs like bellow with model you want to log 

```
class AppModel extends Model {

    public $actsAs = array('History.Log');

}
```

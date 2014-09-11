# History

[![Build Status](https://travis-ci.org/tsmsogn/History.svg?branch=master)](https://travis-ci.org/tsmsogn/History)

## Installtion

```
$ git submodule add https://github.com/tsmsogn/History.git Plugin/History
```

## Usage

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

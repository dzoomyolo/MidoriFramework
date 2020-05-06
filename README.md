# MidoriFramework


Simple web site framework with API support
# Features!

  - Support for declaring API methods
  - Easy routing


### Installation

PHP v7+ Version required .

Clone repository for yourself.

```sh
$ clone https://github.com/dzoomyolo/MidoriFramework.git
```

To create a page, use the folder *routes*,
and then, to declare the path to the page, use:
```php
$path ="/api/:";//API ALREADY DECLARED, : - means use a link like /api/foo/bar
```
Methods API are in the *methods* folder.

On the page with api you should use:
```php
header("Content-Type: application/json");
use lib\classes\APIClass;
$path ="/api/:";
$api = new APIClass($path);
```

MidoriFramework supports the declaration of methods:
```php
$this->declareMethod("test","GET",function(){
    $this->answer = array("dd"=>"ddd");
    //$this->answer - This variable is used to respond to requests.
})
```




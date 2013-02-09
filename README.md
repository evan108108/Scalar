# Starship/Scalar

Provides Scalar Objects in PHP* thus helping improve PHP's inconstant API. The best part is that you can use any of PHP's built in string functions!
  
*Currently Scalar only supports strings but future versions will support numbers, arrays and objects.  
*This library requires PHP 5.3 or greater.  


## Install

The recommended way to install react/scalar is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "starship/scalar": "dev-master"
    }
}
```

## Examples

###Simple String Opperations

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\Str('This is a great string!');

echo $my_string; //Outputs: 'This is a great string!'
echo $my_string->strlen(); //Outputs: 23
echo $my_string->strpos('great'); //Outputs: 10
echo $my_string; //Outputs: 'This is a great string!'

```

By default Scalar maps you're string to the first param of the PHP function your executing. This as you know is not sufficient, luckily Scalar provides two methods for resolving this. The first is by using a token and the second is using a class called MethodMapper. Lets take a looka at the token replacement method:

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\String('This is a great string!');

echo $my_string; //Outputs: 'This is a great string!'

//We use the token '___' which will be replaced by the value of $my_string ('This is a great string!')
echo $my_string->str_replace('great', 'good', '___'); //Outputs: 'This is a good string!'

```

Using the token replacement can be a little less then ideal. Thats where MethodMapper comes in. MethodMapper allows you to create mappings for the PHP functions you use a lot. Lets take a quick look at the MethodMapper class and then see an example of it works.

```php
namespace Starship\Scalar;

class MethodMapper
{
	public static $method_map = array(
		"str_replace" => array('haystack'=>3)
	);	
}
```

In the above example we see that the MethodMapper class consists of a single static variable $method_map. $method_map is a simple associative array. Each item in $method_map is keyed with the PHP method name and contains an associative array that tells Scalar the position of the haystack (your string value). You can see that str_replace is mapped so that the haystack will be passed to the third paramater making the example below possible and eliminating the need for the token:

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\Str('This is a great string!');

echo $my_string; //Outputs: 'This is a great string!'
echo $my_string->str_replace('great', 'super great'); //Outputs: 'This is a super great string!'

```

### Output Channing
Scalar allows you to chain or pipe the output of one or more methods into the next. To do this all you have to do is add the invoke "()" to your var:

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\Str('This is a great string!');

echo $my_string; //Outputs: 'This is a great string!'
echo $my_string()->str_replace('great', 'super great')->strlen(); //Outputs: 29
echo $my_string()->str_replace('great', 'super great')->substr(0,10)->strlen(); //Outputs 10;


# Starship/Scalar

Provides Scalar Objects in PHP* thus helping improve PHP's inconstant API. The best part is that you can use any of PHP's built in string / array functions!
  
*Currently Scalar supports strings and arrays but future versions will support numbers and objects.  
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

###Simple String Operations  
You may use any php string method. Here are a few examples:

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\String('This is a great string!');

echo $my_string; //Outputs: 'This is a great string!'
echo $my_string->strlen(); //Outputs: 23
echo $my_string->strpos('great'); //Outputs: 10
echo $my_string; //Outputs: 'This is a great string!'

```

###Simple Array Operations  

You may use any php array method. Here are a few examples:

```php
require __DIR__.'/vendor/autoload.php';

$my_array = new Starship\Scalar\sArray(array(1,2,3,4));

echo $my_array; //Outputs: '[1,2,3,4]'
echo $my_array[0]; //Outputs: 1
echo $my_array[1]; //Outputs: 2
echo $my_array->count(); //Outputs: 4
echo $my_array->implode('_'); //Outputs: '1_2_3_4'
$new_array = $my_array->array_unshift(10);
echo $new_array; //Outputs: '[10,1,2,3,4]'
echo $new_array[0] //Outputs: 10

```


By default Scalar maps you're string/array to the first param of the PHP function your executing. This as you know is not sufficient, luckily Scalar provides two methods for resolving this. The first is by using a token and the second is using a class called MethodMapper. Lets take a looka at the token replacement method:

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\String('This is a great string!');
$my_array = new Starship\Scalar\sArray(array(1,2,3,4));

echo $my_string; //Outputs: 'This is a great string!'

//We use the token '___' which will be replaced by the value of $my_string ('This is a great string!')

echo $my_string->str_replace('great', 'good', '___'); //Outputs: 'This is a good string!'

echo $my_array->implode('|', '___'); //Outputs: '1|2|3|4'

```

Using the token replacement can be a little less then ideal. Thats where MethodMapper comes in. MethodMapper allows you to create mappings for the PHP functions you use a lot. Lets take a quick look at the MethodMapper class and then see an example of it works.

```php
namespace Starship\Scalar;

class MethodMapper
{
	public static $method_map = array(
		"str_replace" => array('haystack'=>3),
		"explode" => array('haystack'=>2),
		"implode" => array('haystack'=>2),
	);	
}
```

In the above example we see that the MethodMapper class consists of a single static variable $method_map. $method_map is a simple associative array. Each item in $method_map is keyed with the PHP method name and contains an associative array that tells Scalar the position of the haystack (your string/array value). You can see that str_replace is mapped so that the haystack will be passed to the third paramater making the example below possible and eliminating the need for the token:

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\String('This is a great string!');

echo $my_string; //Outputs: 'This is a great string!'
echo $my_string->str_replace('great', 'super great'); //Outputs: 'This is a super great string!'

```

### Output Channing
Scalar allows you to chain or pipe the output of one or more methods into the next. To do this all you have to do is add the invoke "()" to your var:

```php
require __DIR__.'/vendor/autoload.php';

$my_string = new Starship\Scalar\String('This is a great string!');

echo $my_string; //Outputs: 'This is a great string!'
echo $my_string()->str_replace('great', 'super great')->strlen(); //Outputs: 29
echo $my_string()->str_replace('great', 'super great')->substr(0,10)->strlen(); //Outputs 10;
echo $my_string()->explode('great')->count(); //Outputs: 2
echo $my_string()->explode('great')->implode('wow'); //Outputs: 'This is a wow string!'

$my_array = new Starship\Scalar\sArray(array(1,2,3,4));

echo $my_array()->implode('')->strlen(); //Outputs: 4
echo $my_array()->implode('')->strlen()->rand(10); //Outputs: random number between 4 and 10


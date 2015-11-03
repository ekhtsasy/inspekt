# THIS INFORMATION IS DEPRECATED. VISIT [DocsAndSupport](DocsAndSupport.md) FOR UP-TO-DATE DOCUMENTATION #

## Introduction ##

Inspekt provides tools for filtering scalar or array data in two ways:

  * **_Cage_ objects** that encapsulate an array and provide accessor methods that force filtering and/or validation
    * Special helper methods allow you to set up cages on the input superglobals with one method call
  * **Static filters and validators** for arbitrary scalar or array data

The guiding principle for Inspekt is to make it easier to create secure PHP applications.  As such, ease of use is valued over flexibility, and verbosity is avoided when possible

## Cage Objects ##

**Cage objects** are objects that encapsulate an array of data and block access to it except through the object's defined methods.  With Inspekt, you can lock _any_ array in a cage object.

```
// Example: wrap an arbitrary array in a cage
$d = array();
$d['input'] = '<img id="475">yes</img>';
$d[] = array('foo', 'bar<br />', 'yes<P>', 1776);
$d['x']['woot'] = array('booyah'=>'meet at the bar at 7:30 pm',
						'ultimate'=>'<strong>hi there!</strong>',
						);

// create our cage object
$d_cage = Inspekt_Cage::Factory($d);

// return the value of 'input', stripped of html tags
$input = $d_cage->noTags('input');

// get a portion of the array, with all non-alphanumeric chars stripped from values
$x = $d_cage->getAlnum('x');

/*
displays:
array (
  'woot' => 
  array (
    'booyah' => 'meetatthebaratpm',
    'ultimate' => 'stronghitherestrong',
  ),
)
*/
var_export($x);

```


### Array Path Query ###

Inspekt uses a special kind of formatting to make it easier to grab an arbitrary key from a deep multidimensional array.  Assuming we are using the `$d` array cage from previous example, we could do something like this:

```
// Example: Array path query

$booyah = $d_cage->getAlnum('/x/woot/booyah');

// outputs "meetatthebaratpm"
echo $booyah;

```

Notes on array path querying:

  * The forward slash "/" is the separator, so you can't access keys where you're using that character
  * Any numeric keys are converted to integers, so you can't access keys that are numeric strings
  * All queries must include the full path from the root of the array
  * Leading and trailing slashes are ignored.  These are all equivalent:
```
    '/x/woot/booyah/'
    '/x/woot/booyah'
    'x/woot/booyah/'
    'x/woot/booyah'
```



### User Input Cages ###

Inspekt has several static methods that allow you to quickly create cages for user input.  These are:

```
Inspekt::makeGetCage();
Inspekt::makPostCage();
Inspekt::makeCookieCage();
Inspekt::makeSessionCage();
Inspekt::makeServerCage();
Inspekt::makeFilesCage();
```

Each of these methods will return an Inspekt\_Cage object that contains the data from the superglobal that it is named after.  It also deletes the data in the superglobal, so that it _must_ be accessed via the cage object's methods.

```
// Example: creating a cage for $_POST
require_once "Inspekt.php";

$cage_POST = Inspekt::makePostCage();
$userid = $cage_POST->getInt('userid');

if ( !isset($_POST['userid']) ) {
    echo 'Cannot access input via $_POST -- use the cage object';
}
```


All of the `make*Cage()` methods utilize a [singleton pattern](http://en.wikipedia.org/wiki/Singleton_pattern).  This means the developer does not have to pass the cage object to and from functions, or use the `global` keyword, to access it outside the global scope.

```
function foo() {
    $cage_foo = Inspekt::makeServerCage();
    return $cage_foo;
}

// All of these return the *same object*
$cage1 = Inspekt::makeServerCage();
$cage2 = foo();
$cage3 = Inspekt::makeServerCage();

// outputs bool(true)
var_dump($cage1 === $cage2 && $cage2 === $cage3);
```


## Static Methods ##


{coming soon}











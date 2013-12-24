#ThisDayIn
ThisDayIn is a project which aims in presenting information about this day in [history|music|etc...] facts in an easy and structured way.

## Installation
This project is in Composer format, so you just need to run `php composer.phar install`, and all dependencies will be installed:

##Example
It is very simple to use this class. You just need to include the autoload, instantiate the class and call its public method `get_events`.
```php
require 'vendor/autoload.php';
$dim = new ThisDayIn\Music();
$events = $dim->getEvents();
```

If you instantiate the class withouth parameters, it will consider the current day, although it can also receive the day and month for which to get the events:
```php
require 'vendor/autoload.php';
$dim = new ThisDayIn\Music(30, "December");
$events = $dim->getEvents();
```

## Extending
The project has an abstract class ThisDayIn as basis and the class Music which extends the abstract class. The purpose of the project to allow the inclusion of other extensions, such as 'ThisDayInHistory', etc...

#ThisDayIn
ThisDayIn is a project which aims in presenting information about this day in [history|music|etc...] facts in an easy and structured way.

## Installation
This project is in Composer format, so you just need to run, and all dependencies will be installed:
`php composer.phar install`

##Example
It is very simple to use this class. You just need to include the autoload, and instantiate the class by passing as parameter the parser you want to be used.
```php
require 'vendor/autoload.php';
$dim = new ThisDayIn\Music( "\HTML_Parser_HTML5" );
$events = $dim->getEvents();
```

## Extending
The project has an abstract class ThisDayIn as basis and the class Music which extends the abstract class. The purpose of the project to allow the inclusion of other extensions, such as 'ThisDayInHistory', etc...

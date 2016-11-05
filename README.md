# php-di-container

# Note: Work in Progress! Not Completed yet!

PHP DI Container resolves dependencies for php application using Dependency Injection.
And it provides a simple container for all depnedencies as well. It can take dependencies
as argument to other classes and resolve them efficiently. Good thing about container is 
you can specify dependencies in many formats:
#PHP
#JSON
#YAML
#INI

PHP DI Container is capable of reading configuration from above four formats and load
them as services to the container using lazy loading using [PHP Simple Config](https://github.com/mcustiel/php-simple-config)
While using [PHP Simple Config](https://github.com/mcustiel/php-simple-config) can use
cache for our configuration as well to boost the performance. Please go through details
about [PHP Simple Config](https://github.com/mcustiel/php-simple-config).

Future plan is to allow simple php container without any config file for small applications.

Note: Currently its only support PHP version 5.5 and above

Build & Code Details:
[![Build Status](https://travis-ci.org/gr8abbasi/php-di-container.svg?branch=master)](https://travis-ci.org/gr8abbasi/php-di-container)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gr8abbasi/php-di-container/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gr8abbasi/php-di-container/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/gr8abbasi/php-di-container/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gr8abbasi/php-di-container/?branch=master)

Package Details:

# Install using Composer

Add following dependency to your `composer.json`

```javascript
{
  require: {
     // Add this line to your `composer require` as shown below
     "gr8abbasi/php-di-container":"dev-master"
  }
}
```
Create a configuration file in the desired formate and use desired reader
by default service loader will use php config file reader

```php
use Mcustiel\Config\Drivers\Reader\php\Reader as PhpReader;
use Mcustiel\Config\Drivers\Reader\ini\Reader as IniReader;
use Mcustiel\Config\Drivers\Reader\json\Reader as JsonReader;
use Mcustiel\Config\Drivers\Reader\yaml\Reader as YamlReader;
```
PHP configuration file looks like something below and you can see it contains
others classes as dependencies as well.

# PHP Example:

```php
<?php

return [
    'class-a'         => [
        'class'       => 'Tests\\DummyServices\\ClassA',
    ],
    'class-b'         => [
        'class'       => 'Tests\\DummyServices\\ClassB',
        'arguments'   => [
            'class-a'
        ]
    ],
    'class-c'         => [
        'class'       => 'Tests\\DummyServices\\ClassC',
        'arguments'   => [
            'class-b'
        ]
    ],
];
```

```php
$loader = new ServiceLoader();

$services = $loader->loadServices(
    __DIR__ . "/Fixtures/phpServicesConfig.php",
    new PhpReader()
    );

$container = new Container($services);

// To get services from container
$service = $container->get('foo');

```

# JSON Example:

```json

{
    "services": [
        {
            "id": "class-a",
            "class": "Tests\\DummyServices\\ClassA"
        },
        {
            "id": "class-b",
            "class": "Tests\\DummyServices\\ClassB",
            "arguments": [
                {
                    "id": "class-a"
                }
            ]
        },
        {
            "id": "class-c",
            "class": "Tests\\DummyServices\\ClassC",
            "arguments": [
                {
                    "id": "class-a",
                    "id": "class-b"
                }
            ]
        }
    ]
}

```

```php

$services = $loader->loadServices(
    __DIR__ . "/Fixtures/jsonServicesConfig.json",
    new JsonReader()
    );

```

# YAML Example:

```yml

SERVICES:
  class-a:
    class: Tests\\DummyServices\\ClassA
  class-b:
    class: Tests\\DummyServices\\ClassB
    arguments:
      class: class-a
  class-c:
    class: Tests\\DummyServices\\ClassC
    arguments:
      class: class-a
      class: class-b

```

```php

$services = $loader->loadServices(
    __DIR__ . "/Fixtures/yamlServicesConfig.yml",
    new YamlReader()
    );

```

# INI Example:

```ini

[SERVICES]
class-a.class = Tests\\DummyServices\\ClassA
class-b.class = Tests\\DummyServices\\ClassB
class-b.arguments = class-a
class-c.class = Tests\\DummyServices\\ClassC
class-c.arguments = class-a
class-c.arguments = class-b

```

```php

$services = $loader->loadServices(
    __DIR__ . "/Fixtures/iniServicesConfig.ini",
    new IniReader()
    );

```

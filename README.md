The Big Brains Company - Doctrine DBAL Pgsql Types
==================================================

[![Build Status](https://travis-ci.org/TheBigBrainsCompany/doctrine-dbal-pgsql-types.png?branch=master)](https://travis-ci.org/TheBigBrainsCompany/doctrine-dbal-pgsql-types)


This library adds or override some Doctrine DBAL types. Some types fixes issues with some database engines.

Quick Start
-----------

### Registering Types in Doctrine DBAL

<?php

use Doctrine\DBAL\Types\Type;

Type::addType('tbbc_pgsql_binary_safe_array', "Tbbc\\Doctrine\\DBAL\\Pgsql\\Types\\BinarySafeArrayType");
Type::addType('tbbc_pgsql_binary_safe_object', "Tbbc\\Doctrine\\DBAL\\Pgsql\\Types\\BinarySafeObjectType");


### Registering Types in a Symfony2 application

# config.yml
doctrine:
    dbal:
        types:
            tbbc_pgsql_binary_safe_array: "Tbbc\\Doctrine\\DBAL\\Pgsql\\Types\\BinarySafeArrayType"
            tbbc_pgsql_binary_safe_object: "Tbbc\\Doctrine\\DBAL\\Pgsql\\Types\\BinarySafeObjectType"

### Mapping

```XML
<entity name="My\Entity" table="my_entity">
    <field name="myObject" type="tbbc_pgsql_binary_safe_object" />
    <field name="myArray" type="tbbc_pgsql_binary_safe_array" />
</entity>
```


Installation
------------

Using [Composer](http://getcomposer.org/), just run:

```bash
$ composer require tbbc/doctrine-dbal-pgsql-types
```

Or add it manually to your `composer.json` file:

```JSON
{
  "require": {
    "tbbc/doctrine-dbal-pgsql-types": "dev-master"
  }
}
```

And run `composer update`.


Run the test
------------

First make sure you have installed all the dependencies, run:

```bash
$ composer install --dev
```

then, run the test from within the root directory:

```bash
$ vendor/bin/phpunit
```

Contributing
------------

1. Take a look at the [list of issues](http://github.com/TheBigBrainsCompany/doctrine-dbal-pgsql-types/issues).
2. Fork
3. Write a test (for either new feature or bug)
4. Make a PR


Authors
-------

* Benjamin Dulau - benjamin@thebigbrainscompany.com


License
-------

`The Big Brains Company - Doctrine DBAL Types` is licensed under the MIT License - see the LICENSE file for details
# vulndb-php

PHP SDK to access the [vulnerability database](https://github.com/vulndb/data)

[![Build](https://travis-ci.org/vulndb/vulndb-php.svg?branch=master)](http://travis-ci.org/vulndb/vulndb-php)
[![License](https://poser.pugx.org/vulndb/vulndb-php/license.svg)](https://packagist.org/packages/vulndb/vulndb-php)

## Standalone Installation of SDK

1. `git clone https://github.com/vulndb/vulndb-php.git`
2. Download composer: `curl -s https://getcomposer.org/installer | php`
3. Install dependencies: `php composer.phar install`

## Composer Installation of SDK

1. Download composer: `curl -s https://getcomposer.org/installer | php`
2. Add to your dependencies:  `php composer.phar require vulndb/php-sdk dev-master`
3. Update the dependencies

## Updating the Vulnerability Database

This package embeds the [vulnerability database](https://github.com/vulndb/data).
To install/update the database, run:

```
bin/vulndb update
```

    Note: requires `git`

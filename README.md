# vulndb-php

PHP SDK to access the [vulnerability database](https://github.com/vulndb/data)

## Standalone Installation of SDK

1. `git clone` _this_ repository.
2. Download composer: `curl -s https://getcomposer.org/installer | php`
3. Install dependencies: `php composer.phar install`

## Composer Installation of SDK

1. Download composer: `curl -s https://getcomposer.org/installer | php`
2. Add to your dependencies:  `php composer.phar require vulndb/php-sdk dev-master`
3. Update the dependencies

## Updating the Vulnerability Database

This package does not embed the [vulnerability database](https://github.com/vulndb/data).
To install/update the database, run:

```
bin/vulndb update
```

    Note: requires `git`

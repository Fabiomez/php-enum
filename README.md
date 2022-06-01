# Project PHP Enum

A simple Enum PHP project.

## Why?

Despite when I wrote this little project PHP8 already exists with its own native Enum.
I decided to because I had some free time and some projects still using lower PHP versions.
Then I decided to write this with all features that I missed in other PHP Enum libraries.

My version of Enum ensure that all instances of the same *class constant* will always be the same instance.
So, does not matter how many times we try to retrieve the enum instance, it will always have the same memory address.

## How to install

Require via composer

```
composer require Fabiomez/php-enum
```

Or add to your composer.json require session

```
{
...
  "require": {
    ...
    "Fabiomez/php-enum": "1.0.0"
    ...
  },
...
}
```

## How to use

### Declaring

First declare a class that extents from `fabiome\Enum\Enum`

```php
use Fabiomez\Enum\Enum;

/**
 * @method static self OK
 * @method static self BAD_REQUEST
 */
class HttpCode extends Enum
{
    const OK = 200;
    const BAD_REQUEST = 400;
}
```

* DocBlocks is just for IDE auto complete

### Retrieving

There are three ways to retrieve Enum instance

#### Using from static method

```php
$httpCode = HttpCode::from(HttpCode::OK);
```

#### Using tryFrom static method

```php
$httpCode = HttpCode::tryFrom(HttpCode::OK);
```

* The big difference is, while `from` will throw an `InvalidArgumentException` if a constant with the given value does
not exist into the declared class, `tryFrom` will just return `null`;

#### Using static magic methods

Any declared constant can be called as a static method to retrieve an Enum instance with the constant value.

```php
$httpCode = HttpCode::OK();
```

This is the big reason for DocBlocks `@method` declarations.

### Getting the value

```php
$httpCode = HttpCode::OK();
echo $httpCode->get(); //print int 200
echo (string) $httpCode; //print string 200
```

### Comparing

#### By value

```php
HttpCode::OK()->get() == HttpCode::OK; //true
HttpCode::OK()->get() === HttpCode::OK; //true
HttpCode::OK()->eq(HttpCode::OK); //true
```

#### By memory addressing

```php
HttpCode::OK() === HttpCode::OK(); //true
HttpCode::OK()->is(HttpCode::OK()); //true
```
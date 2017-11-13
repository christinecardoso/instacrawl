![InstaCrawl](http://i.imgur.com/OIBKnUe.png "InstaCrawl")

[![Latest Version](https://img.shields.io/github/release/DWTechnologies/InstaCrawl.svg?maxAge=2592000&style=flat-square)]()
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist](https://img.shields.io/packagist/dt/dw/instacrawl.svg?maxAge=2592000&style=flat-square)]()

# InstaCrawl
_The package for those who hate Instagram's official API! (Or for those who just can't get a hold of an access token...)_

### Note
Thanks to the fact that this package is dependent on Instagram not changing their page source for user profiles, it may break at any time.

### Prerequisites
To use this package you need to have cURL enabled and your Laravel project needs to be version 5 or up.

### Installation
First require the package
```bash
composer require "dw/instacrawl:v0.10.0-alpha"
```

Then add the service provider
```php
DW\InstaCrawl\ServiceProvider::class,
```

And the facade
```php
'InstaCrawl' => DW\InstaCrawl\Facade::class,
```

### Config

The configuration defines where the JSON data begins and ends on the crawled Instagram data. Also defines which keys contains the needed data for functions, ex: _followed_by_. If this package stops working, check the page source of a random Instagram user's profile and look for JSON and see if it differs.

To change the configuration, just run
```bash
php artisan vendor:publish --provider="DW\InstaCrawl\ServiceProvider" --tag=config
```

### Usage
All functions returns a string, do whatever you want with it.

##### Get follower count
```php
/**
* Takes a username and retrieves the amount of followers for said user.
*
* returns string
*/
InstaCrawl::getAmountOfFollowers('blondinbella');
```

##### Get follow count
```php
/**
* Takes a username and retrieves the amount of people said user follows.
*
* returns string
*/
InstaCrawl::getAmountOfFollows('blondinbella');
```

##### Get post count
```php
/**
* Takes a username and retrieves the amount of posts from said user.
*
* returns string
*/
InstaCrawl::getAmountOfPosts('blondinbella');
```

##### Get biography
```php
/**
* Takes a username and retrieves said user's biography.
*
* returns string
*/
InstaCrawl::getBiography('blondinbella');
```

##### Get full name
```php
/**
* Takes a username and retrieves the full name specified by said user.
*
* returns string
*/
InstaCrawl::getFullName('blondinbella');
```

##### Get id
```php
/**
* Takes a username and retrieves said user's id.
*
* returns string
*/
InstaCrawl::getId('blondinbella');
```

##### Get username from url
```php
/**
* Takes an url for a user's profile and extracts the username.
*
* returns string
*/
InstaCrawl::getUsernameFromUrl('https://www.instagram.com/blondinbella/');
```

##### Get recent media
```php
/**
* Takes a username and retrieves said user's most recent media.
*
* returns array
*/
InstaCrawl::getRecentMedia('blondinbella');
```
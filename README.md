# Send and Forget

This package supplies a solution to send an HTTP request without waiting for its response.

By default the package uses Guzzle's functionality. However, this can be replaced by respecting the [RequestParser interface](./src/RequestParser.php).

## Installation

#### CLI

```
$ composer require rg/send-and-forget:dev-master 
```

#### composer.json

```
"require": {
    "rg/send-and-forget": "dev-master"
}
```


## Usage

#### CLI

```
$ php -S localhost:9999 . &
```

#### Example
``` 
<?php
require_once 'vendor/autoload.php';

$client = new \rg\saf\Client();
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://localhost:9999/');
$client->sendAndForget($request);
```


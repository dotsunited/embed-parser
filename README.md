Embed Parser
============

Simple utility to parse URLs in HTML or text content which are placed on its own
line to turn them into embeds.

Installation
------------

Install the latest version with [Composer](https://getcomposer.org).

```bash
composer require dotsunited/embed-parser
```

Check the [Packagist page](https://packagist.org/packages/dotsunited/embed-parser)
for all available versions.

Usage
-----

There is single `parse` function provided which parses the given content and
invokes a handler callback for each URL found.

```php
$transformedContent = DotsUnited\EmbedParser\parse($content, function ($url) {
    $embedHtml = tranformUrlToEmbedHtml($url);
    
    return $embedHtml;
});
```

License
-------

Copyright (c) 2017 Dots United GmbH.
Released under the [MIT](LICENSE) license.

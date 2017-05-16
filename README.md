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

The URL must be on its own line or surrounded only by `<p>` tags with no other
text content to be parsed.

### Text

```text
Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
sed diam nonumy eirmod tempor invidunt ut labore et dolore
magna aliquyam erat, sed diam voluptua.

https://youtube.com/watch?v=QcIy9NiNbmo

At vero eos et accusam et justo duo dolores et ea rebum.
```

### HTML

```text
<p>
    Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
    sed diam nonumy eirmod tempor invidunt ut labore et dolore
    magna aliquyam erat, sed diam voluptua.
</p>

<p>
    https://youtube.com/watch?v=QcIy9NiNbmo
</p>

<p>
    At vero eos et accusam et justo duo dolores et ea rebum.
</p>
```

License
-------

Copyright (c) 2017 Dots United GmbH.
Released under the [MIT](LICENSE) license.

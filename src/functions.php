<?php

namespace DotsUnited\EmbedParser;

function parse($content, callable $handler)
{
    $callback = function ($matches) use ($handler) {
        return $matches[1] . $handler($matches[2]) . $matches[3];
    };

    $content = preg_replace_callback(
        '|^(\s*)(https?://[^\s<>"]+)(\s*)$|im',
        $callback,
        $content
    );

    $content = preg_replace_callback(
        '|(<p(?: [^>]*)?>\s*)(https?://[^\s<>"]+)(\s*<\/p>)|i',
        $callback,
        $content
    );

    return $content;
}

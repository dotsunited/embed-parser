<?php

namespace DotsUnited\EmbedParser;

function parse($content, callable $handler)
{
    $content = preg_replace_callback(
        '|(<p(?: [^>]*)?>.*)(https?://[^\s<>"]+)(.*<\/p>)|is',
        function ($matches) use ($handler) {
            // Check if there are only empty tags before the URL
            $before = trim(
                strip_tags(
                    html_entity_decode(
                        $matches[1],
                        ENT_COMPAT,
                        'UTF-8'
                    )
                )
            );

            if ('' !== $before) {
                return $matches[0];
            }

            // Check if there are only empty tags after the URL
            $after  = trim(
                strip_tags(
                    html_entity_decode(
                        $matches[3],
                        ENT_COMPAT,
                        'UTF-8'
                    )
                )
            );

            if ('' !== $after) {
                return $matches[0];
            }

            return $matches[1] . $handler($matches[2]) . $matches[3];
        },
        $content
    );

    $content = preg_replace_callback(
        '|^(\s*)(https?://[^\s<>"]+)(\s*)$|im',
        function ($matches) use ($handler) {
            return $matches[1] . $handler($matches[2]) . $matches[3];
        },
        $content
    );

    return $content;
}

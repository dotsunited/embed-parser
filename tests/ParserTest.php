<?php

namespace DotsUnited\EmbedParser;

use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @dataProvider provideCorrectContent
     */
    public function testParseCorrect($content, $url)
    {
        $handler = $this
            ->getMockBuilder(CallableStub::class)
            ->getMock();

        $handler
            ->expects($this->once())
            ->method('__invoke')
            ->with($url)
            ->willReturnCallback(function ($url) {
                return '<parsed>' . $url . '</parsed>';
            });

        $parsed = parse(
            sprintf($content, $url),
            $handler
        );

        $this->assertEquals(
            sprintf($content, '<parsed>' . $url . '</parsed>'),
            $parsed
        );
    }

    public function provideCorrectContent()
    {
        $urls = [
            'https://example.com',
            'http://example.com',
            'https://example.com?foo=bar#123',
            'http://example.com?foo=bar#123',
        ];

        $contents = [
            [
                "%s",
            ],
            [
                "     %s",
            ],
            [
                "%s     ",
            ],
            [
                "     %s     ",
            ],
            [
                "\r\n%s",
            ],
            [
                "\r%s",
            ],
            [
                "\n%s",
            ],
            [
                "%s\r\n",
            ],
            [
                "%s\r",
            ],
            [
                "%s\n",
            ],
            [
                "\r\n%s\r\n",
            ],
            [
                "\r%s\r",
            ],
            [
                "\n%s\n",
            ],
            [
                "\r\n\r\n\r\n\r\n\r\n\r\n%s\r\n",
            ],

            // --


            [
                "<p>%s</p>",
            ],
            [
                "<p>     %s</p>",
            ],
            [
                "<p>%s     </p>",
            ],
            [
                "<p>     %s     </p>",
            ],
            [
                "<p>\r\n%s</p>",
            ],
            [
                "<p>\r%s</p>",
            ],
            [
                "<p>\n%s</p>",
            ],
            [
                "<p>%s\r\n</p>",
            ],
            [
                "<p>%s\r</p>",
            ],
            [
                "<p>%s\n</p>",
            ],
            [
                "<p>\r\n%s\r\n</p>",
            ],
            [
                "<p>\r%s\r</p>",
            ],
            [
                "<p>\n%s\n</p>",
            ],
            [
                "<p>\r\n\r\n\r\n\r\n\r\n\r\n%s\r\n</p>",
            ],
        ];

        $data = [];

        foreach ($urls as $url) {
            $data = array_merge($data, array_map(function ($item) use ($url) {
                return array_merge($item, [$url]);
            }, $contents));
        }

        return $data;
    }
}

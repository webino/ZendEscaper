<?php

namespace ZendTest\Escaper;

use PHPUnit\Framework\TestCase;
use Zend\Escaper\Escaper;
use Zend\Escaper\EscaperAwareTrait;

/**
 * Test EscaperAwareTraitTest
 */
class EscaperAwareTraitTest extends TestCase
{
    public function testEscaperAwareTrait()
    {
        $obj = new class {
            use EscaperAwareTrait;
        };

        $this->assertSame(
            '&lt;b&gt;s&lt;/b&gt;',
            $obj->escapeHtml('<b>s</b>')
        );

        $this->assertSame(
            '&#x27;&#x20;onmouseover&#x3D;&#x27;alert&#x28;&#x2F;s&#x2F;&#x29;&#x3B;',
            $obj->escapeHtmlAttr('\' onmouseover=\'alert(/s/);')
        );

        $this->assertSame(
            '%22%20onmouseover%3D%22alert%28%27s%27%29',
            $obj->escapeUrl('" onmouseover="alert(\'s\')')
        );

        $this->assertSame(
            'body\20 \7B \20 background\2D image\3A \20 url\28 \27 http\3A \2F \2F example\2E com\2F foo\2E jpg\3F \3C \2F style\3E \3C script\3E alert\28 1\29 \3C \2F script\3E \27 \29 \3B \20 \7D ',
            $obj->escapeCss('body { background-image: url(\'http://example.com/foo.jpg?</style><script>alert(1)</script>\'); }')
        );

        $this->assertSame(
            'bar\x26quot\x3B\x3B\x20alert\x28\x26quot\x3BMeow\x21\x26quot\x3B\x29\x3B\x20var\x20xss\x3D\x26quot\x3Btrue',
            $obj->escapeJs('bar&quot;; alert(&quot;Meow!&quot;); var xss=&quot;true')
        );
    }

    public function testEscaperAwareTraitCustom()
    {
        $obj = new class
        {
            use EscaperAwareTrait;
        };

        $escaper = $this->createMock(Escaper::class);
        $obj->setEscaper($escaper);

        $escaper->expects($this->once())->method('escapeHtml')->with('s')->willReturn('s');
        $obj->escapeHtml('s');

        $escaper->expects($this->once())->method('escapeHtmlAttr')->with('s')->willReturn('s');
        $obj->escapeHtmlAttr('s');

        $escaper->expects($this->once())->method('escapeUrl')->with('s')->willReturn('s');
        $obj->escapeUrl('s');

        $escaper->expects($this->once())->method('escapeCss')->with('s')->willReturn('s');
        $obj->escapeCss('s');

        $escaper->expects($this->once())->method('escapeJs')->with('s')->willReturn('s');
        $obj->escapeJs('s');
    }
}

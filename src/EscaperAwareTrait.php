<?php

namespace Zend\Escaper;

/**
 * Class EscaperAwareTrait
 */
trait EscaperAwareTrait
{
    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * @return Escaper
     */
    public function getEscaper()
    {
        $this->escaper or $this->escaper = new Escaper;
        return $this->escaper;
    }

    /**
     * @param Escaper $escaper
     * @return $this
     */
    public function setEscaper(Escaper $escaper)
    {
        $this->escaper = $escaper;
        return $this;
    }

    /**
     * Return escaped HTML string
     *
     * @param string $string
     * @return string
     */
    public function escapeHtml($string) : string
    {
        return $this->getEscaper()->escapeHtml((string) $string);
    }

    /**
     * Return escaped HTML attribute value
     *
     * @param string $string
     * @return string
     */
    public function escapeHtmlAttr($string) : string
    {
        return $this->getEscaper()->escapeHtmlAttr((string) $string);
    }

    /**
     * Return escaped URL subcomponent
     *
     * @param string $string
     * @return string
     */
    public function escapeUrl($string) : string
    {
        return $this->getEscaper()->escapeUrl((string) $string);
    }

    /**
     * Return escaped CSS
     *
     * @param string $string
     * @return string
     */
    public function escapeCss($string) : string
    {
        return $this->getEscaper()->escapeCss((string) $string);
    }

    /**
     * Return escaped Javascript
     *
     * @param string $string
     * @return string
     */
    public function escapeJs($string) : string
    {
        return $this->getEscaper()->escapeJs((string) $string);
    }
}

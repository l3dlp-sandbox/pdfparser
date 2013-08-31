<?php

namespace Smalot\PdfParser\Element;

use Smalot\PdfParser\Element;
use Smalot\PdfParser\Document;

/**
 * Class ElementString
 * @package Smalot\PdfParser\Element
 */
class ElementString extends Element
{
    /**
     * @param string   $value
     * @param Document $document
     */
    public function __construct($value, Document $document = null)
    {
        parent::__construct($value, null);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function equals($value)
    {
        return $value == $this->value;
    }

    /**
     * @param string   $content
     * @param Document $document
     * @param int      $offset
     *
     * @return bool|ElementString
     */
    public static function parse($content, Document $document = null, &$offset = 0)
    {
        if (preg_match('/^\s*\((?<name>.*?)\)/is', $content, $match)) {
            $name   = $match['name'];
            $offset = strpos($content, $name) + strlen($name) + 1; // 1 for ')'

            return new self($name, $document);
        }

        return false;
    }
}
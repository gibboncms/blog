<?php

namespace GibbonCms\Blog;

use GibbonCms\Blog\Interfaces\MarkdownConverter as MarkdownConverterInterface;
use League\CommonMark\CommonMarkConverter;

class MarkdownConverter implements MarkdownConverterInterface
{
    /**
     * @var \League\CommonMark\CommonMarkConverter
     */
    protected $commonmark;

    public function __construct()
    {
        $this->commonmark = new CommonMarkConverter;
    }

    /**
     * @param string $markdown
     * @return string
     */
    public function convert($markdown)
    {
        return $this->commonmark->convertToHtml($markdown);
    }
}

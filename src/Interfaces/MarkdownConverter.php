<?php

namespace GibbonCms\Blog\Interfaces;

interface MarkdownConverter
{
    /**
     * @param string $markdown
     * @return string
     */
    public function convert($markdown);
}

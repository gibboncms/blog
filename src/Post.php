<?php namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Entities\Entity;

class Post extends Entity
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $author;

    /**
     * @var string
     */
    public $body;

    /**
     * @return string
     */
    public function getRenderedBody()
    {
        return PostFactory::parseMarkdown($this->body);
    }
}

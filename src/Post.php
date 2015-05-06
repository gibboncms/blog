<?php

namespace GibbonCms\Blog;

use GibbonCms\Blog\Interfaces\MarkdownConverter as MarkdownConverterInterface;
use GibbonCms\Gibbon\Entity;

class Post extends Entity
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \GibbonCms\Blog\Interfaces\MarkdownConverter|null
     */
    protected $markdownConverter;

    /**
     * @param string $title
     * @param string $author
     * @param string $slug
     * @param string $body
     */
    public function __construct($title, $author, $slug, $body)
    {
        parent::__construct($slug);

        $this->title = $title;
        $this->author = $author;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param \GibbonCms\Blog\Interfaces\MarkdownConverter $markdownConverter
     * @return void
     */
    public function setMarkdownConverter(MarkdownConverterInterface $markdownConverter)
    {
        $this->markdownConverter = $markdownConverter;
    }

    /**
     * @return string
     */
    public function getHtmlBody()
    {
        if ($this->markdownConverter == null) {
            throw new \Exception("No markdown converter assigned to this entity");
        }

        return $this->markdownConverter->convert($this->body);
    }

    /**
     * @param string
     * @return void
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}

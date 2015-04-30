<?php

namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Factory;
use Symfony\Component\Yaml\Parser as Yaml;

class PostFactory extends Factory
{
    /**
     * @var \Symfony\Component\Yaml\Parser
     */
    protected $yaml;

    public function __construct()
    {
        $this->yaml = new Yaml;
    }

    /**
     * Transform raw data to an entity
     * 
     * @param array $data
     * @return \GibbonCms\Blog\Post
     */
    public function make($data)
    {
        list($rawMeta, $body) = explode("\n\n---\n\n", str_replace("\n\r", "\n", $data['data']), 2);

        $meta = $this->yaml->parse($rawMeta);

        return $this->createAndFill([
            'id'     => $data['id'],
            'slug'   => $data['slug'],
            'title'  => $meta['title'],
            'author' => $meta['author'],
            'body'   => $body,
        ]);
    }

    /**
     * Transform an entity to raw data
     * 
     * @param \GibbonCms\Blog\Post $entity
     * @return string
     */
    public function encode($entity)
    {

    }

    /**
     * Return the classname of the entity this factory makes
     * 
     * @return string
     */
    public static function makes()
    {
        return Post::class;
    }
}

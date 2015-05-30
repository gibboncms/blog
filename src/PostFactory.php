<?php

namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Factories\Factory;
use GibbonCms\Gibbon\Support\FactoryHelpers;

class PostFactory implements Factory
{
    use FactoryHelpers;

    /**
     * Transform raw data to an entity
     * 
     * @param array $data
     * @return \GibbonCms\Blog\Post
     */
    public function make($data)
    {
        $parts = $this->splitData($data['data'], ['meta', 'body']);

        $meta = self::parseYaml($parts['meta']);

        return $this->createAndFill([
            'id'     => $data['id'],
            'title'  => $meta['title'],
            'date'   => $data['date'],
            'data'   => isset($meta['data']) ? $meta['data'] : [],
            'body'   => $parts['body'],
        ]);
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

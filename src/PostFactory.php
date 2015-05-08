<?php namespace GibbonCms\Blog;

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
            'id'                => $data['id'],
            'title'             => $meta['title'],
            'author'            => $meta['author'],
            'body'              => $parts['body'],
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
        $contents = ''
            . $this->dumpToSimpleYaml([
                'title' => $entity->title,
                'author' => $entity->author,
            ])
            . $this->getDataSeparator()
            . $entity->body
        ;

        return $contents;
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

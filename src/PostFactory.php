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
        list($rawMeta, $body) = explode(
            $this->getDataSeparator(),
            str_replace("\n\r", "\n", $data['data']),
            2
        );

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
        $contents = '';

        $contents .= $this->dumpToYaml([
            'title' => $entity->getTitle(),
            'author' => $entity->getAuthor(),
        ]);
        
        $contents .= $this->getDataSeparator();

        $contents .= $entity->getBody();

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

    /**
     * Transform an associative array to yaml.
     * Not using symfony's yaml dumper for full control over the format.
     * 
     * @param array $array
     * @return string
     */
    protected function dumpToYaml($array)
    {
        $parts = [];

        foreach ($array as $key => $value) {
            $parts[] = "$key: $value";
        }

        $yaml = implode("\n", $parts);

        return $yaml;
    }

    /**
     * The data seperator string in raw entities
     * 
     * @return string
     */
    protected function getDataSeparator()
    {
        return "\n\n---\n\n";
    }
}

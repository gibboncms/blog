<?php

namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Cache;
use GibbonCms\Gibbon\EntityRepository;
use GibbonCms\Gibbon\Filesystem;

class Blog
{
    /**
     * @var \GibbonCms\Gibbon\Repository
     */
    protected $repository;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->repository = new EntityRepository(
            new Filesystem($directory),
            new Cache($directory . '/.cache'),
            new PostFactory
        );
    }

    /**
     * @param string $id
     * @return \GibbonCms\Blog\Post
     */
    public function getPost($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return void
     */
    public function build()
    {
        $this->repository->buildCache();
    }
}

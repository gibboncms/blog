<?php

namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Modules\Module;
use GibbonCms\Gibbon\Repositories\FileRepository;

class Blog implements Module
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
        $this->repository = new FileRepository(
            new PlainFilesystem($directory),
            new FileCache($directory . '/.cache'),
            new PostFactory
        );
    }

    /**
     * @param string $id
     * @return \GibbonCms\Blog\Post
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return \GibbonCms\Blog\Post[]
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @return void
     */
    public function setUp()
    {
        $this->repository->build();
    }
}

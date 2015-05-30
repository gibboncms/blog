<?php

namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\Filesystem;
use GibbonCms\Gibbon\Modules\Module;

class Blog implements Module
{
    /**
     * @var \GibbonCms\Gibbon\Repositories\Repository
     */
    protected $repository;

    /**
     * @param  \GibbonCms\Gibbon\Filesystems\Filesystem $filesystem
     * @param  string $directory
     * @param  \GibbonCms\Gibbon\Filesystems\FileCache $fileCache
     */
    public function __construct(Filesystem $filesystem, $directory, FileCache $fileCache)
    {
        $this->repository = new FileRepository($filesystem, $directory, $fileCache, new PostFactory);
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

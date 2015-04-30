<?php

namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Filesystem;

class Blog
{
    protected $repository;
    
    public function __construct($directory)
    {
        $this->repository = new Repository(
            new Filesystem($directory),
            new Cache($directory . '/.cache'),
            new PostFactory
        );
    }
}

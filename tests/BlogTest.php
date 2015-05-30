<?php

namespace GibbonCms\Blog\Test;

use GibbonCms\Blog\Blog;
use GibbonCms\Blog\Post;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Filesystems\FileCache;

class BlogTest extends TestCase
{
    function setUp()
    {
        $this->blog = new Blog(
            new PlainFilesystem($this->fixtures),
            'posts',
            new FileCache($this->fixtures.'/posts/.cache')
        );

        $this->blog->setUp();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Blog::class, $this->blog);
    }

    /** @test */
    function it_gets_a_post()
    {
        $this->assertInstanceOf(Post::class, $this->blog->find('my-first-post'));
    }

    /** @test */
    function it_gets_all_posts()
    {
        $this->assertCount(1, $this->blog->getAll());
    }
}

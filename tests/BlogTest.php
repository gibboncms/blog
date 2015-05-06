<?php

namespace GibbonCms\Blog\Tests;

use GibbonCms\Blog\Blog;
use GibbonCms\Blog\Post;

class BlogTest extends TestCase
{
    function setUp()
    {
        $this->blog = new Blog($this->fixtures . '/posts');
        $this->blog->build();
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(Blog::class, $this->blog);
    }

    /** @test */
    function it_gets_a_post()
    {
        $this->assertInstanceOf(Post::class, $this->blog->getPost(1));
    }
}

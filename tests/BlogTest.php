<?php namespace GibbonCms\Blog\Tests;

use GibbonCms\Blog\Blog;
use GibbonCms\Blog\Post;

class BlogTest extends TestCase
{
    function setUp()
    {
        $this->blog = new Blog($this->fixtures . '/posts');
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

<?php

namespace GibbonCms\Blog\Tests;

use GibbonCms\Blog\Post;
use GibbonCms\Blog\PostFactory;
use Reflection;

class PostFactoryTest extends TestCase
{
    function setUp()
    {
        $this->factory = new PostFactory;
    }

    /** @test */
    function it_is_initializable()
    {
        $this->assertInstanceOf(PostFactory::class, $this->factory);
    }

    /** @test */
    function it_makes_an_entity()
    {
        $data = [
            'id' => 1,
            'slug' => 'test-post',
            'data' => file_get_contents($this->fixtures . '/posts/1-my-first-post.md'),
        ];
        $post = $this->factory->make($data);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals(1, $post->getId());
        $this->assertEquals('test-post', $post->getSlug());
        $this->assertEquals('My First Post', $post->getTitle());
        $this->assertEquals('Sebastian De Deyne', $post->getAuthor());
        $this->assertRegexp('/## Hello world/', $post->getBody());
    }

    /** @test */
    function it_encodes_an_entity()
    {
        $data = [
            'id' => 1,
            'slug' => 'test-post',
            'data' => file_get_contents($this->fixtures . '/posts/1-my-first-post.md'),
        ];
        $post = $this->factory->make($data);

        $raw = $this->factory->encode($post);
        $this->assertEquals(file_get_contents($this->fixtures . '/posts/1-my-first-post.md'), $raw);
    }
}

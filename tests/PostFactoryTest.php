<?php

namespace GibbonCms\Blog\Test;

use DateTime;
use GibbonCms\Blog\Post;
use GibbonCms\Blog\PostFactory;

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
        $id = 'my-first-post';
        $date = new DateTime;
        $data = file_get_contents($this->fixtures . '/posts/2015-05-27-my-first-post.md');

        $post = $this->factory->make([
            'id' => $id,
            'date' => $date,
            'data' => $data,
        ]);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals('my-first-post', $post->id);
        $this->assertEquals($date, $post->date);
        $this->assertEquals('My First Post', $post->title);
        $this->assertEquals('Sebastian De Deyne', $post->data['author']);
        $this->assertRegexp('/## Hello world/', $post->body);
        $this->assertRegexp('/<h2>Hello world<\/h2>/', $post->render());
    }

    /** @tst */
    function it_encodes_an_entity()
    {
        $post = $this->factory->make([
            'id' => 'test-post',
            'data' => file_get_contents($this->fixtures . '/posts/my-first-post.md'),
        ]);

        $raw = $this->factory->encode($post);
        $this->assertEquals(file_get_contents($this->fixtures . '/posts/my-first-post.md'), $raw);
    }
}

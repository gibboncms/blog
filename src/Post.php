<?php

namespace GibbonCms\Blog;

use GibbonCms\Gibbon\Entities\Entity;

class Post extends Entity
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var array
     */
    public $data;

    /**
     * @var string
     */
    public $body;
}

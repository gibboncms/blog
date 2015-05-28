<?php

namespace GibbonCms\Blog;

use DateTime;
use GibbonCms\Gibbon\Repositories\FileRepository as BaseFileRepository;

class FileRepository extends BaseFileRepository
{
    /**
     * @param array $file
     * @return \GibbonCms\Gibbon\Entities\Entity|null
     */
    protected function parseFile($file)
    {
        if ($file['extension'] != 'md') {
            return null;
        }

        $parts = explode('-', $file['filename'], 4);
        $id = array_pop($parts);

        $date = DateTime::createFromFormat('Y-m-d', implode('-', $parts));

        $entity = $this->factory->make([
            'id'   => $id,
            'date' => $date,
            'data' => $this->filesystem->read($file['path']),
        ]);
        
        return $entity;
    }
}

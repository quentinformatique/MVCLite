<?php

namespace MvcLite\Engine\Entities;

use MvcLite\Engine\Entities\File;

class Image extends File
{
    public function __construct(string $name,
                                string $fullPath,
                                string $type,
                                string $temporaryName,
                                int $error,
                                int $size)
    {
        parent::__construct($name, $fullPath, $type, $temporaryName, $error, $size);

        // Empty constructor.
    }
}
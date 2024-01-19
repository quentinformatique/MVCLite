<?php

namespace MvcLite\Models;

use MvcLite\Models\Engine\Model;

class User extends Model
{
    /** User id. */
    private int $id;

    /** Username */
    private string $name;

    public function __construct(int $id, string $name)
    {
        parent::__construct();

        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int User id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string Username
     */
    public function getName(): string
    {
        return $this->name;
    }
}
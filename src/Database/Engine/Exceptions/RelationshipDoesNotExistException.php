<?php

namespace MvcLite\Database\Engine\Exceptions;

use MvcLite\Database\Engine\Database;
use MvcLite\Engine\MvcLiteException;

/**
 * MVCLite core exception.
 *
 * This exception must be thrown if database connection
 * attempt failed during database connection attempt or
 * SQL query running.
 *
 * @see Database
 * @author belicfr
 */
class RelationshipDoesNotExistException extends MvcLiteException
{
    public function __construct(string $relationship)
    {
        parent::__construct();

        $this->code = "MVCLITE_MODEL_RELATIONSHIP_NOT_EXISTS";
        $this->message = "<strong>$relationship</strong> relationship does not exist.";
    }
}
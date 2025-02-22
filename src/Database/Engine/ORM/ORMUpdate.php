<?php

namespace MvcLite\Database\Engine\ORM;

use MvcLite\Database\Engine\Database;
use MvcLite\Database\Engine\Exceptions\NegativeOrNullLimitException;
use MvcLite\Engine\DevelopmentUtilities\Debug;
use MvcLite\Models\Engine\Model;
use MvcLite\Models\Engine\ModelCollection;

/**
 * ORM updating query class.
 *
 * Allows to update an existing line using MVCLite ORM.
 *
 * @see ORMQuery
 * @author belicfr
 */
class ORMUpdate extends ORMQuery
{
    private const BASE_SQL_QUERY_TEMPLATE
        = "UPDATE %s";

    /** Updates to do. */
    private array $updates;

    /** Values given for updating. */
    private array $updatesValues;

    /** Given WHERE clauses. */
    private array $conditions;

    public function __construct(string $modelClass)
    {
        parent::__construct($modelClass);

        $this->updates = [];
        $this->conditions = [];

        $sqlQueryBase = sprintf(self::BASE_SQL_QUERY_TEMPLATE,
            ($this->getModelClass())::getTableName());

        $this->addSql($sqlQueryBase);
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }

    public function hasConditions(): bool
    {
        return count($this->getConditions());
    }

    /**
     * @return array Updates to do
     */
    public function getUpdates(): array
    {
        return $this->updates;
    }

    /**
     * @return bool If there is an update
     */
    public function hasUpdate(): bool
    {
        return count($this->getUpdates());
    }

    /**
     * @return array Values used for line updating
     */
    public function getUpdatesValues(): array
    {
        return $this->updatesValues;
    }

    /**
     * Appends an update to current ORM update query.
     *
     * @param string $column
     * @param mixed $value
     * @return $this Current ORM update query
     */
    public function addUpdate(string $column, mixed $value): ORMUpdate
    {
        $update = $this->hasUpdate()
            ? ", $column = ?"
            : "SET $column = ?";

        $this->addSql($update);
        $this->updates[] = $update;
        $this->updatesValues[] = $value;

        return $this;
    }

    /**
     * Add a where condition clause to current query.
     *
     * @param string $column Column concerned by condition
     * @param string $operatorOrValue Condition operator if there are three arguments;
     *                                else condition value
     * @param string|null $value Condition value if there are three arguments;
     *                           else NULL
     * @return $this Current ORM query instance
     */
    public function where(string $column, string $operatorOrValue, ?string $value = null): ORMUpdate
    {
        $sqlWhereClause = $this->prepareWhereClauseLine($column, $operatorOrValue, $value);
        $sqlWhereClause = $this->hasConditions()
            ? "AND $sqlWhereClause"
            : "WHERE $sqlWhereClause";

        $this->addSql($sqlWhereClause);
        $this->conditions[] = $sqlWhereClause;

        return $this;
    }

    public function orWhere(string $column, string $operatorOrValue, ?string $value = null): ORMUpdate
    {
        $sqlWhereClause = $this->prepareWhereClauseLine($column, $operatorOrValue, $value);
        $sqlWhereClause = $this->hasConditions()
            ? "OR $sqlWhereClause"
            : "WHERE $sqlWhereClause";

        $this->addSql($sqlWhereClause);
        $this->conditions[] = $sqlWhereClause;

        return $this;
    }

    private function prepareWhereClauseLine(string $column, $operatorOrValue, ?string $value = null): string
    {
        return $sqlWhereClause = $value === null
            ? "$column = $operatorOrValue"
            : "$column $operatorOrValue $value";
    }

    /**
     * Send generated SQL query by using Database class.
     */
    public function execute(): void
    {
        $query = Database::query($this->getSql(), ...$this->getUpdatesValues());
        $result = [];

        //
    }
}
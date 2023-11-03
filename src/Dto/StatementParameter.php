<?php

class StatementParameter
{
    /**
     * @var string
     */
    public $types;

    /**
     * @var array
     */
    public $values;

    /**
     * @param string $types
     * @param array $values
     */
    public function __construct($types, array $values)
    {
        $this->types = $types;
        $this->values = $values;
    }
}

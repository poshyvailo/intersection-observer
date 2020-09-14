<?php

declare(strict_types=1);

namespace App\Application\Classes;

class QueryParamValue
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function asInt(): int
    {
        return (int) $this->value;
    }
}

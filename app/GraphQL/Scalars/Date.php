<?php

namespace App\GraphQL\Scalars;

use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;

class Date extends ScalarType
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        parent::__construct([
            'name' => 'Date',
            'description' => 'A date string in YYYY-MM-DD format',
        ]);
    }

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     * @return string
     */
    public function serialize($value): string
    {
        // Jika nilai adalah DateTime, konversi ke format YYYY-MM-DD
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d');
        }

        // Validasi format jika string
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            throw new \InvalidArgumentException("Format date harus YYYY-MM-DD");
        }

        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value
     * @return string
     */
    public function parseValue($value): string
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            throw new \InvalidArgumentException("Format date harus YYYY-MM-DD");
        }

        return $value;
    }

    /**
     * Parses an externally provided literal value (inline in the query) to use as an input.
     *
     * @param \GraphQL\Language\AST\ValueNode $valueNode
     * @param array|null $variables
     * @return string
     * @throws Error
     */
    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: date harus berupa string', [$valueNode]);
        }

        return $this->parseValue($valueNode->value);
    }
}

<?php

namespace App\GraphQL\Scalars;

use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;

class DateTime extends ScalarType
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        parent::__construct([
            'name' => 'DateTime',
            'description' => 'A datetime string in YYYY-MM-DD HH:MM:SS format (24-hour)',
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
        // Pastikan nilai adalah instance DateTime atau string dengan format yang valid
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d H:i:s');
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $value)) {
            throw new \InvalidArgumentException("Format datetime harus YYYY-MM-DD HH:MM:SS");
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
        if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $value)) {
            throw new \InvalidArgumentException("Format datetime harus YYYY-MM-DD HH:MM:SS");
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
            throw new Error('Query error: datetime harus berupa string', [$valueNode]);
        }

        return $this->parseValue($valueNode->value);
    }
}

<?php declare(strict_types=1);

namespace LeafCms\Blog\Exceptions;

use Exception;

class NonUniqueSlugException extends Exception
{
    private const DEFAULT_MESSAGE = 'Slug is not unique.';

    public function __construct(string $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($message);
    }
}

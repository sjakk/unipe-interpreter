<?php

declare(strict_types=1);

namespace Unipe\Token;

final class Token
{
    public int $type;
    public string $literal;

    public function __construct(int $type, string $literal)
    {
        $this->type = $type;
        $this->literal = $literal;
    }
}
